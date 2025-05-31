<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);

// payment submission
if ($_POST && isset($_POST['make_payment'])) {
    $loan_id = intval($_POST['loan_id']);
    $payment_amount = floatval($_POST['payment_amount']);
    $payment_date = date('Y-m-d');

    // insert payment
    $insert_payment = "INSERT INTO fm_tbl_payment (loan_id, payment_amount, payment_date) 
                       VALUES ($loan_id, $payment_amount, '$payment_date')";
    
    if ($conn->query($insert_payment) === TRUE) {
        // update balance
        $update_balance = "UPDATE fm_tbl_loan 
                           SET outstanding_balance = outstanding_balance - $payment_amount 
                           WHERE loan_id = $loan_id";
        $conn->query($update_balance);

       // insert logs
        $id = $_SESSION['user_id'];
        $log_action = "Made a Payment of ₱" . number_format($payment_amount, 2) . " for Loan ID #$loan_id";
        $logssql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$id', '$log_action', NOW())";
        $conn->query($logssql);

        $success_message = "Payment of ₱" . number_format($payment_amount, 2) . " has been successfully processed!";
        } else {
            $error_message = "Error processing payment. Please try again.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Loans - Payment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /*navbar css*/
    .upper-hr{
        border-top: 30px solid #1E3A8A;
        width: 100%;
        margin: 0;
        opacity: 100%; 
    }

    .navbar-brand img{
        height: 150px;
        width: auto;
        max-width: 250px;
        object-fit: contain;
    }

    .navbar-brand img:hover{
        transform: scale(1.05); 
        opacity: 0.85; 
    }

    .navbar{
        padding: 0;
        margin: 0;
    }

    .navbar .container{
        padding: 0;
    }

    .nav-link{
        color: #1E3A8A;
    }

    .nav-link:hover{
        color: #1E3A8A;
        text-decoration: underline;
        text-decoration-color: #1E3A8A;
    }

    .nav-link img{
        height: 35px;
        width: auto;
    }

    .nav-link:hover img{
        transform: scale(1.1); 
        opacity: 0.8; 
    }

    .profile-icon{
        margin-left: auto;
        padding: 20px;
    }

    .lower-hr{
        border-top: 1px solid #000000;
        width: 100%;
        margin: 0;
        opacity: 100%;
    }

    /*header css*/
    .header {
      background-color: #1f3b8b;
      color: white;
      padding: 20px 40px;
    }

    .header h1 {
      margin: 0;
    }

    .breadcrumb {
      color: #cbd5e1;
      font-size: 14px;
    }

    .breadcrumb a {
      color: #a0c4ff;
      text-decoration: none;
    }

    .breadcrumb a:hover{
        color: #a0c4ff;
        text-decoration: underline;
        text-decoration-color:rgb(227, 234, 255);
    }

    /*loan cards css*/
    .loan-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
    }
    
    .loan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .loan-card .card-header {
        border-left: 4px solid #1E3A8A;
    }

    .status-badge.paid {
        background-color: #28a745 !important;
    }

    .status-badge.not-paid {
        background-color: #dc3545 !important;
    }

    .status-badge.partial {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .payment-btn {
        background: linear-gradient(45deg, #1E3A8A, #3B82F6);
        border: none;
        transition: all 0.3s ease;
    }

    .payment-btn:hover {
        background: linear-gradient(45deg, #1E40AF, #2563EB);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
    }

    .payment-btn:disabled {
        background: #6c757d;
        transform: none;
        box-shadow: none;
    }

    /*footer css*/
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    footer {
      background-color: #f8f8f8;
      padding: 40px;
      border-top: 1px solid #ccc;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: flex-start;
    }
    
    .footer-column {
      flex: 1;
      margin: 10px;
      min-width: 200px;
    }

    .footer-column h5 {
      margin-top: 0;
      margin-bottom: 15px;
    }

    .footer-column ul {
      list-style: none;
      padding-left: 0;
    }

    .footer-column ul li {
      margin-bottom: 10px;
    }
    
    .footer-column ul li a {
      text-decoration: none;
      color: #333;
    }

    .footer-logo img{
      height: 200px;
      width: auto;
      max-width: 100%;
      object-fit: contain;
    }

    .subscribe {
      margin-top: 20px;
    }

    .subscribe input[type="email"] {
      padding: 8px;
      width: 70%;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .subscribe button {
      padding: 8px 15px;
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 4px;
    }

    .contact-info i {
      margin-right: 8px;
    }

    .social-icons i {
      margin-right: 10px;
      font-size: 20px;
    }

    .footer-bottom {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid #ccc;
      margin-top: 20px;
      font-size: 14px;
    }

    .footer-divider {
      border: none;
      border-top: 1px solid #ccc;
      margin-top: 40px;
      margin-bottom: 20px;
    }
</style>
</head>

<body class="bg-light">
<!--navbar-->
<hr class="upper-hr">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid px-5">
            <a class="navbar-brand d-flex align-items-center me-3" href="homepage.php">
                <img src="fundifyme-transparent.png" alt="Fundify Me">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto text-center gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="homepage.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="application-form.php">APPLY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="my-loans.php">MY LOANS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="payment-history.php">PAYMENT HISTORY</a>
                </li>
            </ul>
        </div> 

        <div class="profile-icon d-flex justify-content-end">
            <a class="nav-link" href="user-navbar.php">
                <img src="profile-icon-transparent.png" alt="Profile">
            </a>
        </div>    
    </div>
    </nav>

    <hr class="lower-hr">

<!--alerts-->
<?php if (isset($success_message)) { ?>
<div class="container mt-4">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo $success_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php } ?>

<?php if (isset($error_message)) { ?>
<div class="container mt-4">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?php echo $error_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php } ?>

<div class="header mt-5">
    <h1 class="mt-3"><b>My Loans</b></h1>
    <div class="breadcrumb">
      <span><a href="homepage.php"> Home </a></span> 
      <span class="mx-2"> / </span> 
      <span> My Loans </span>
    </div> 
  </div>

<div class="container my-5">
    <!-- loan types -->
    <div class="loan-types-wrapper">
        <div class="section-header mb-4">
            <h2 class="fw-bold text-dark">Explore Our Loan Options</h2>
            <p class="text-muted">Find the perfect financing solution for your needs.</p>
            <div class="separator"></div>
        </div>
        
        <div class="row g-4">
            <?php
            // loan types
            $sql_types = "SELECT loan_type_id, loan_type_name, description FROM fm_tbl_loantype";
            $result_types = $conn->query($sql_types);

            if ($result_types->num_rows > 0) {
                while ($type = $result_types->fetch_assoc()) {
                    $interest_rate = 0;
                    $icon = '';
                    $bgClass = '';
                    
                    switch ($type['loan_type_id']) {
                        case 1: 
                            $interest_rate = 5; 
                            $icon = 'fa-solid fa-user-tag';
                            $bgClass = 'bg-primary bg-opacity-10';
                            $features = ['Flexible repayment terms', 'No collateral required', 'Quick approval process'];
                            break;
                        case 2: 
                            $interest_rate = 6; 
                            $icon = 'fa-solid fa-car';
                            $bgClass = 'bg-success bg-opacity-10';
                            $features = ['Competitive rates', 'Up to 80% financing', 'Extended payment terms'];
                            break;
                        case 3: 
                            $interest_rate = 4; 
                            $icon = 'fa-solid fa-home';
                            $bgClass = 'bg-info bg-opacity-10';
                            $features = ['Long-term financing', 'Multiple property types', 'Flexible down payment options'];
                            break;
                        case 4: 
                            $interest_rate = 3; 
                            $icon = 'fa-solid fa-graduation-cap';
                            $bgClass = 'bg-warning bg-opacity-10';
                            $features = ['Low interest rates', 'Grace period after graduation', 'No early payment penalties'];
                            break;
                        default: 
                            $interest_rate = 5; 
                            $icon = 'fa-solid fa-coins';
                            $bgClass = 'bg-secondary bg-opacity-10';
                            $features = ['Competitive rates', 'Flexible terms', 'Quick processing'];
                            break;
                    }
                    
                    echo '
                    <div class="col-md-6 col-lg-3">
                        <div class="card loan-card h-100 border-0 shadow-sm">
                            <div class="card-body p-0">
                                <div class="loan-card-header ' . $bgClass . ' p-4 text-center">
                                    <div class="icon-wrapper mb-3">
                                        <i class="' . $icon . ' fa-2x"></i>
                                    </div>
                                    <h5 class="card-title mb-1">' . $type['loan_type_name'] . '</h5>
                                    <div class="interest-rate mb-0">
                                        <span class="display-6 fw-bold text-primary">' . $interest_rate . '%</span>
                                        <span class="text-muted">interest rate</span>
                                    </div>
                                </div>
                                
                                <div class="loan-card-content p-4">
                                    <p class="card-text mb-3">' . $type['description'] . '</p>
                                    
                                    <div class="features-list">
                                        <p class="text-muted mb-2 small fw-bold">Key Features:</p>
                                        <ul class="list-unstyled">';
                                        
                                        foreach ($features as $feature) {
                                            echo '<li class="mb-2"><i class="fas fa-check-circle text-success me-2 small"></i>' . $feature . '</li>';
                                        }
                                        
                                        echo '
                                        </ul>
                                    </div>
                                    
                                    <div class="loan-details mt-3 pt-3 border-top">
                                        <div class="d-flex justify-content-between small">
                                            <span class="text-muted">Loan ID:</span>
                                            <span class="fw-bold">#' . $type['loan_type_id'] . '</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col-12"><div class="alert alert-info p-4 shadow-sm border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                        <div>
                            <h5 class="mb-1">No Loans Available</h5>
                            <p class="mb-0">There are currently no loan types available in our system. Please check back later.</p>
                        </div>
                    </div>
                </div></div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- my loans -->
<div class="container my-5">
    <div class="loans-section">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">My Active Loans</h2>
                <p class="text-muted">Manage your current loan portfolio.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM fm_tbl_loan ORDER BY date_applied DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // determine loan status based on outstanding balance
                    $outstanding = floatval($row['outstanding_balance']);
                    $original_amount = floatval($row['loan_amount']);
                    
                    if ($outstanding <= 0) {
                        $status = "Fully Paid";
                        $statusClass = "bg-success";
                        $statusIcon = "fas fa-check-circle";
                        $balanceTextClass = "text-success";
                    } elseif ($outstanding >= $original_amount) {
                        $status = "Not Paid";
                        $statusClass = "bg-danger";
                        $statusIcon = "fas fa-exclamation-circle";
                        $balanceTextClass = "text-danger";
                    } else {
                        $status = "Partially Paid";
                        $statusClass = "bg-warning";
                        $statusIcon = "fas fa-clock";
                        $balanceTextClass = "text-warning";
                    }

                    $payment_percentage = $original_amount > 0 ? (($original_amount - $outstanding) / $original_amount) * 100 : 0;
                    $interest_percent = number_format($row['interest_rate'] * 100, 2) . '%';
                    
                    // dates format
                    $date_applied = date("M j, Y", strtotime($row['date_applied']));
                    $date_approved = date("M j, Y", strtotime($row['date_approved']));
                    $date_disbursed = date("M j, Y", strtotime($row['date_disbursed']));

                    echo '
                    <div class="col-md-6 col-lg-4">
                        <div class="card loan-card h-100 border-0 shadow-sm">
                            <!--loan id and status -->
                            <div class="card-header border-0 bg-white position-relative pt-4 pb-2">
                                <div class="loan-indicator"></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">Loan #' . $row['loan_id'] . '</h5>
                                    <span class="status-badge badge ' . $statusClass . ' rounded-pill">
                                        <i class="' . $statusIcon . ' me-1"></i>' . $status . '
                                    </span>
                                </div>
                            </div>
                            
                            <!-- loan details -->
                            <div class="card-body pt-3">
                                <!--loan amount and interest rate-->
                                <div class="loan-amount-section p-3 mb-4 bg-light rounded-3">
                                    <div class="row align-items-center">
                                        <div class="col-7">
                                            <small class="text-muted">Loan Amount</small>
                                            <h4 class="mb-0 text-primary">₱' . number_format($row['loan_amount'], 2) . '</h4>
                                        </div>
                                        <div class="col-5 text-end">
                                            <small class="text-muted">Interest Rate</small>
                                            <h5 class="mb-0">' . $interest_percent . '</h5>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--payment progress bar-->
                                <div class="payment-progress mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Payment Progress</small>
                                        <small class="fw-bold">' . round($payment_percentage) . '%</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: ' . $payment_percentage . '%"></div>
                                    </div>
                                </div>
                                
                                <!-- dates -->
                                <div class="important-dates mb-3">
                                    <h6 class="section-title small fw-bold mb-3">IMPORTANT DATES</h6>
                                    <div class="date-item d-flex justify-content-between py-2 border-bottom">
                                        <span class="text-muted small">Date Applied</span>
                                        <span class="fw-bold">' . $date_applied . '</span>
                                    </div>
                                    <div class="date-item d-flex justify-content-between py-2 border-bottom">
                                        <span class="text-muted small">Date Approved</span>
                                        <span class="fw-bold">' . $date_approved . '</span>
                                    </div>
                                    <div class="date-item d-flex justify-content-between py-2">
                                        <span class="text-muted small">Date Disbursed</span>
                                        <span class="fw-bold">' . $date_disbursed . '</span>
                                    </div>
                                </div>
                                
                                <!-- loan term -->
                                <div class="loan-term mb-3">
                                    <div class="d-flex justify-content-between py-2 border-top border-bottom">
                                        <span class="text-muted">Term Duration</span>
                                        <span class="fw-bold">' . $row['loan_term'] . ' months</span>
                                    </div>
                                </div>
                                
                                <!--outstanding balance-->
                                <div class="outstanding-balance mt-4 mb-3">
                                    <small class="text-muted d-block">Outstanding Balance</small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0 ' . $balanceTextClass . '">
                                            ₱' . number_format($outstanding, 2) . '
                                        </h4>
                                        <i class="' . $statusIcon . ' ' . str_replace('bg-', 'text-', $statusClass) . ' fs-4"></i>
                                    </div>
                                </div>
                                
                                <!-- Payment Button -->
                                <div class="d-grid mt-4">';
                    
                    if ($outstanding > 0) {
                        echo '<button class="btn btn-primary payment-btn" data-bs-toggle="modal" data-bs-target="#paymentModal" 
                                      onclick="setPaymentDetails(' . $row['loan_id'] . ', ' . $outstanding . ')">
                                  <i class="fas fa-credit-card me-2"></i>Make Payment
                              </button>';
                    } else {
                        echo '<button class="btn btn-success" disabled>
                                  <i class="fas fa-check me-2"></i>Loan Paid Off
                              </button>';
                    }
                    
                    echo '      </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '
                <div class="col-12">
                    <div class="alert alert-info text-center p-4 shadow-sm border-0">
                        <div class="alert-content">
                            <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                            <h5>No Active Loan Records</h5>
                            <p class="text-muted mb-0">You currently don\'t have any active loans in our system.</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- payment modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="paymentModalLabel">
                    <i class="fas fa-credit-card me-2"></i>Make a Payment
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="row">

                        <!-- payment details -->
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Loan Details</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Loan ID:</small>
                                        <span class="fw-bold ms-2" id="modalLoanId">-</span>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Outstanding Balance:</small>
                                        <span class="fw-bold text-danger ms-2" id="modalBalance">₱0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- payment form -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paymentAmount" class="form-label">Payment Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" class="form-control" id="paymentAmount" name="payment_amount" 
                                           step="0.01" min="0.01" required>
                                </div>
                                <div class="form-text">Amount to Be Paid</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Payment Method</label>
                                <select class="form-select" id="paymentMethod" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="cash">Cash</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="gcash">GCash</option>
                                    <option value="paymaya">PayMaya</option>
                                    <option value="credit_card">Credit Card</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-secondary" 
                                        onclick="payFullAmount()">Pay Full Amount</button>
                                <button type="button" class="btn btn-outline-primary" 
                                        onclick="payMinimum()">Pay Minimum (₱500.00)</button>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- summary of payments -->
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>Payment Summary
                        </h6>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Payment Amount:</small><br>
                                <span class="fw-bold" id="summaryAmount">₱0.00</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Remaining Balance:</small><br>
                                <span class="fw-bold" id="summaryRemaining">₱0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="make_payment" class="btn btn-primary">
                        <i class="fas fa-check me-2"></i>Process Payment
                    </button>
                </div>
                
                <input type="hidden" name="loan_id" id="hiddenLoanId">
            </form>
        </div>
    </div>
</div>

<!--footer-->
<hr class="footer-divider">

<footer>
    <div class="footer-container mt-5">
      <div class="footer-column logo-column">
        <div class="footer-logo">
          <img src="fundifyme-transparent.png" alt="Logo">
        </div>
        <div class="subscribe mb-5">
          <p><strong>Loan Now</strong></p>
          <input type="email" placeholder="Enter your Email">
          <button class="mt-3 px-5">Loan Now</button>
        </div>
      </div>

      <div class="footer-column">
        <h5>Information</h5>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">More Search</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h5>Helpful Links</h5>
        <ul>
          <li><a href="#">Services</a></li>
          <li><a href="#">Supports</a></li>
          <li><a href="#">Terms and Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h5>Our Services</h5>
        <ul>
          <li><a href="#">Loan Application</a></li>
          <li><a href="#">Loan Status Tracking</a></li>
          <li><a href="#">Flexible Payment Options</a></li>
          <li><a href="#">Financial Assistance</a></li>
          <li><a href="#">Member Support</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h5>Contact Us</h5>
        <div class="contact-info">
          <p><i class="fas fa-phone"></i> +63 912 345 6789</p>
          <p><i class="fas fa-envelope"></i> support@fundifyme.ph</p>
        </div>
        <div class="social-icons">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-linkedin"></i>
          <i class="fab fa-twitter"></i>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      Copyright @ 2025. All Rights Reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

<script>
let currentLoanId = 0;
let currentBalance = 0;

function setPaymentDetails(loanId, balance) {
    currentLoanId = loanId;
    currentBalance = balance;
    
    document.getElementById('modalLoanId').textContent = loanId;
    document.getElementById('modalBalance').textContent = '₱' + balance.toLocaleString('en-US', {minimumFractionDigits: 2});
    document.getElementById('hiddenLoanId').value = loanId;
    
    // form reset
    document.getElementById('paymentAmount').value = '';
    document.getElementById('paymentMethod').value = '';
    updateSummary();
}

function payFullAmount() {
    document.getElementById('paymentAmount').value = currentBalance.toFixed(2);
    updateSummary();
}

function payMinimum() {
    const minimumPayment = Math.min(500, currentBalance);
    document.getElementById('paymentAmount').value = minimumPayment.toFixed(2);
    updateSummary();
}

function updateSummary() {
    const paymentAmount = parseFloat(document.getElementById('paymentAmount').value) || 0;
    const remainingBalance = Math.max(0, currentBalance - paymentAmount);
    
    document.getElementById('summaryAmount').textContent = '₱' + paymentAmount.toLocaleString('en-US', {minimumFractionDigits: 2});
    document.getElementById('summaryRemaining').textContent = '₱' + remainingBalance.toLocaleString('en-US', {minimumFractionDigits: 2});
}

// updates summary when payment amount changes
document.getElementById('paymentAmount').addEventListener('input', updateSummary);

// validation of payment amount 
document.getElementById('paymentAmount').addEventListener('input', function() {
    const value = parseFloat(this.value);
    if (value > currentBalance) {
        this.setCustomValidity('Payment amount cannot exceed outstanding balance');
    } else if (value <= 0) {
        this.setCustomValidity('Payment amount must be greater than 0');
    } else {
        this.setCustomValidity('');
    }
});
</script>

</body>
</html>
