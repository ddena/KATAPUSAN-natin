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

    /* Loan Cards Styling */
    .section-header .text-muted {
        font-size: 0.95rem;
    }
    
    .loan-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .loan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .loan-indicator {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background-color: #1E3A8A;
        border-top-left-radius: 5px;
    }
    
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35em 0.8em;
    }
    
    .loan-amount-section {
        border-left: 3px solid #1E3A8A;
    }
    
    .section-title {
        color: #6c757d;
        letter-spacing: 1px;
    }
    
    .date-item:last-child {
        border-bottom: none;
    }
    
    .important-dates .fw-bold {
        font-size: 0.9rem;
    }
    
    /* Empty state styling */
    .alert-content {
        padding: 2rem 1rem;
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
            $sql = "SELECT * FROM fm_tbl_loan";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $interest_percent = number_format($row['interest_rate'] * 100, 2) . '%';
                    
                    // dates format
                    $date_applied = date("M j, Y", strtotime($row['date_applied']));
                    $date_approved = date("M j, Y", strtotime($row['date_approved']));
                    $date_disbursed = date("M j, Y", strtotime($row['date_disbursed']));

                    echo '
                    <div class="col-md-6 col-lg-4">
                        <div class="card loan-card h-100 border-0 shadow-sm">
                            <!-- Card Header with Loan ID and colored indicator -->
                            <div class="card-header border-0 bg-white position-relative pt-4 pb-2">
                                <div class="loan-indicator"></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">Loan #' . $row['loan_id'] . '</h5>
                                    <span class="status-badge badge bg-success rounded-pill">Completed</span>
                                </div>
                            </div>
                            
                            <!-- loan details -->
                            <div class="card-body pt-3">
                                <!-- Loan Amount and Interest Rate -->
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
                                
                                <!-- balance -->
                                <div class="outstanding-balance mt-4">
                                    <small class="text-muted d-block">Outstanding Balance</small>
                                    <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 text-success">
                                    ₱' . number_format($row['outstanding_balance'], 2) . '
                                </h4>
                                <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                </div>
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