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
    <title>Payment History</title>
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

    /*display css*/
     .payment-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
    }
    
    .payment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .payment-card .card-header {
        border-left: 4px solid #1E3A8A;
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
                <h4 class="mb-0 text-primary">Your Payment Records</h4>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end gap-2">
                    <select class="form-select form-select-sm" style="max-width: 150px;">
                        <option selected>All Time</option>
                        <option>Last Month</option>
                        <option>Last 3 Months</option>
                        <option>This Year</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM fm_tbl_payment ORDER BY payment_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $status = "Completed";
                $statusClass = "success";
                
                echo '
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0 payment-card">
                        <!-- Card header with payment ID and date -->
                        <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom border-2 border-primary py-3">
                            <h5 class="mb-0 fs-6 text-primary">
                                <i class="fas fa-receipt me-2"></i>Payment #' . $row['payment_id'] . '
                            </h5>
                            <span class="badge bg-' . $statusClass . ' rounded-pill">' . $status . '</span>
                        </div>
                        
                        <!-- Card body with payment info -->
                        <div class="card-body">
                            <!-- Payment amount highlighted -->
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                                <div>
                                    <p class="text-muted mb-0 small">Amount Paid</p>
                                    <h4 class="mb-0 text-success">₱' . number_format($row['payment_amount'], 2) . '</h4>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-check-circle fs-3 text-success"></i>
                                </div>
                            </div>
                            
                            <!-- Payment details -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Loan ID</span>
                                    <span class="fw-bold">' . $row['loan_id'] . '</span>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Date</span>
                                    <span class="fw-bold">' . date("F j, Y", strtotime($row['payment_date'])) . '</span>
                                </div>
                            </div>
                            
                            <!-- Action buttons -->
                            <div class="d-flex justify-content-between mt-4">
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '
            <div class="col-12">
                <div class="alert alert-warning text-center p-4">
                    <i class="fas fa-exclamation-circle me-2 fs-4"></i>
                    <p class="mb-0">No payment records found.</p>
                    <p class="text-muted small mt-2">Once you make a payment, it will appear here.</p>
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

