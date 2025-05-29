<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);
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
    
<!--header-->
<div class="header mt-5">
    <h1 class="mt-3"><b>Payment History</b></h1>
    <div class="breadcrumb">
      <span><a href="homepage.php"> Home </a></span> 
      <span class="mx-2"> / </span> 
      <span> Payment History </span>
    </div> 
</div>

<!--display-->
<div class="container mt-5 mb-5">
    <div class="mb-4 p-3 bg-white rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-0 text-primary">Your Active Loans</h4>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM fm_tbl_loan ORDER BY date_applied DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Determine loan status
                $outstanding = floatval($row['outstanding_balance']);
                $original_amount = floatval($row['loan_amount']);
                
                if ($outstanding <= 0) {
                    $status = "Fully Paid";
                    $statusClass = "paid";
                    $statusIcon = "fas fa-check-circle";
                } elseif ($outstanding >= $original_amount) {
                    $status = "Not Paid";
                    $statusClass = "not-paid";
                    $statusIcon = "fas fa-exclamation-circle";
                } else {
                    $status = "Partially Paid";
                    $statusClass = "partial";
                    $statusIcon = "fas fa-clock";
                }

                $payment_percentage = (($original_amount - $outstanding) / $original_amount) * 100;
                
                echo '
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0 loan-card">
                        <!-- Card header with loan ID and status -->
                        <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom border-2 border-primary py-3">
                            <h5 class="mb-0 fs-6 text-primary">
                                <i class="fas fa-file-contract me-2"></i>Loan #' . $row['loan_id'] . '
                            </h5>
                            <span class="badge status-badge ' . $statusClass . ' rounded-pill">
                                <i class="' . $statusIcon . ' me-1"></i>' . $status . '
                            </span>
                        </div>
                        
                        <!-- Card body with loan details -->
                        <div class="card-body">
                            <!-- Outstanding balance highlighted -->
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                                <div>
                                    <p class="text-muted mb-0 small">Outstanding Balance</p>
                                    <h4 class="mb-0 ' . ($outstanding <= 0 ? 'text-success' : 'text-danger') . '">₱' . number_format($outstanding, 2) . '</h4>
                                </div>
                                <div class="ms-auto">
                                    <div class="text-center">
                                        <div class="progress mb-2" style="height: 8px; width: 60px;">
                                            <div class="progress-bar bg-success" style="width: ' . $payment_percentage . '%"></div>
                                        </div>
                                        <small class="text-muted">' . round($payment_percentage) . '%</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Loan details -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Original Amount</span>
                                    <span class="fw-bold">₱' . number_format($row['loan_amount'], 2) . '</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Interest Rate</span>
                                    <span class="fw-bold">' . $row['interest_rate'] . '%</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Term</span>
                                    <span class="fw-bold">' . $row['loan_term'] . ' months</span>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Date Applied</span>
                                    <span class="fw-bold">' . date("M j, Y", strtotime($row['date_applied'])) . '</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '
            <div class="col-12">
                <div class="alert alert-info text-center p-4">
                    <i class="fas fa-info-circle me-2 fs-4"></i>
                    <p class="mb-0">You don\'t have any loans yet.</p>
                    <p class="text-muted small mt-2">
                        <a href="application-form.php" class="text-decoration-none">Apply for a loan</a> to get started.
                    </p>
                </div>
            </div>';
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