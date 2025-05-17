<!--TBE TANGINA-->


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Loans</title>
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
        opacity: 100%:
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

    /* Loan card styles */
    .loan-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .loan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .loan-status-active {
        background-color: #4CAF50;
    }
    
    .loan-status-pending {
        background-color: #FFC107;
    }
    
    .loan-status-completed {
        background-color: #2196F3;
    }

    .loan-type-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .loan-type-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .loan-type-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
</head>

<!--navbar-->
<body class="bg-light">
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
            <a class="nav-link" href="#">
                <img src="profile-icon-transparent.png" alt="Profile">
            </a>
        </div>    

    </div>
    </nav>
    <hr class="lower-hr">
    
    <!--header-->
<div class="header mt-5">
    <h1 class="mt-3"><b>My Loans</b></h1>
    <div class="breadcrumb">
      <span><a href="homepage.php"> Home </a></span> 
      <span class="mx-2"> / </span> 
      <span> My Loans </span>
    </div> 
  </div>

<div class="container mt-5">
    <!-- Loan Types Section -->
    <div class="loan-type-section mb-5">
        <h2 class="mb-4">Available Loan Types</h2>
        <div class="row">
            <?php
            // Display all loan types
            $sql_types = "SELECT loan_type_id, loan_type_name, description FROM fm_tbl_loantype";
            $result_types = $conn->query($sql_types);

            if ($result_types->num_rows > 0) {
                while ($type = $result_types->fetch_assoc()) {
                    $interest_rate = 0;
                    switch ($type['loan_type_id']) {
                        case 1: $interest_rate = 5; break;
                        case 2: $interest_rate = 6; break;
                        case 3: $interest_rate = 4; break;
                        case 4: $interest_rate = 3; break;
                        default: $interest_rate = 5; break;
                    }
                    
                    echo '
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card loan-type-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">' . $type['loan_type_name'] . '</h5>
                                <p class="card-text">' . $type['description'] . '</p>
                                <p class="card-text"><small class="text-muted">Interest Rate: ' . $interest_rate . '%</small></p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="application-form.php?loan_type=' . $type['loan_type_id'] . '" class="btn btn-outline-primary btn-sm">Apply Now</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col-12"><div class="alert alert-info">No loan types available at the moment.</div></div>';
            }
            ?>
        </div>
    </div>

    <!-- My Loans Section -->
    <h2 class="mb-4">My Active Loans</h2>
    <div class="row">
        <?php
        // Let's first get all loans without trying to join
        $sql = "SELECT * FROM fm_tbl_loan ORDER BY date_applied DESC";
        
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Manually determine loan type name and description
                $loan_type_name = "Unknown";
                $description = "No description available";
                
                // Check if the loan has a loan_type_id (if this column exists)
                if (isset($row['loan_type_id'])) {
                    // Try to get loan type info
                    $type_id = $row['loan_type_id'];
                    $type_query = "SELECT loan_type_name, description FROM fm_tbl_loantype WHERE loan_type_id = $type_id";
                    $type_result = $conn->query($type_query);
                    
                    if ($type_result && $type_result->num_rows > 0) {
                        $type_data = $type_result->fetch_assoc();
                        $loan_type_name = $type_data['loan_type_name'];
                        $description = $type_data['description'];
                    } else {
                        // Fallback values based on what should be in the database
                        switch ($type_id) {
                            case 1:
                                $loan_type_name = "Personal Loan";
                                $description = "Unsecured loan for personal needs";
                                break;
                            case 2:
                                $loan_type_name = "Auto Loan";
                                $description = "Loan for purchasing a vehicle";
                                break;
                            case 3:
                                $loan_type_name = "Housing Loan";
                                $description = "Loan for buying or building a house";
                                break;
                            case 4:
                                $loan_type_name = "Student Loan";
                                $description = "Loan for educational purposes";
                                break;
                            default:
                                $loan_type_name = "Loan Type " . $type_id;
                                $description = "Description not available";
                        }
                    }
                }
                // Determine loan status
                $status = "Completed";
                $status_class = "bg-primary";
                
                if (strtotime($row['date_approved']) > time()) {
                    $status = "Pending Approval";
                    $status_class = "bg-warning";
                } elseif (strtotime($row['date_disbursed']) > time()) {
                    $status = "Approved, Pending Disbursement";
                    $status_class = "bg-info";
                } elseif ($row['outstanding_balance'] > 0) {
                    $status = "Active";
                    $status_class = "bg-success";
                }
                
                // Format interest rate as percentage
                $interest_percent = number_format($row['interest_rate'] * 100, 2) . '%';
                
                echo '
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card loan-card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Loan #' . $row['loan_id'] . '</h5>
                            <span class="badge ' . $status_class . '">' . $status . '</span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="card-subtitle mb-2 text-muted">' . $loan_type_name . '</h6>
                                <p class="card-text small">' . $description . '</p>

                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Loan Amount</small>
                                    <strong>₱' . number_format($row['loan_amount'], 2) . '</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Interest Rate</small>
                                    <strong>' . $interest_percent . '</strong>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Date Applied</small>
                                    <span>' . date("M j, Y", strtotime($row['date_applied'])) . '</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Term</small>
                                    <span>' . $row['loan_term'] . ' months</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted d-block">Outstanding Balance</small>
                                    <h5 class="text-' . ($row['outstanding_balance'] > 0 ? 'danger' : 'success') . '">
                                        ₱' . number_format($row['outstanding_balance'], 2) . '
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between">
                                <a href="loan-details.php?id=' . $row['loan_id'] . '" class="btn btn-sm btn-outline-primary">View Details</a>
                                ' . ($row['outstanding_balance'] > 0 ? '<a href="make-payment.php?id=' . $row['loan_id'] . '" class="btn btn-sm btn-primary">Make Payment</a>' : '') . '
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning text-center">No active loan records found. Apply for a loan today!</div></div>';
        }
        ?>
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
</body>
</html>