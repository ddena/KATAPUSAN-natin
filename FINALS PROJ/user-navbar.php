<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);

    // user info
    $sql_users = "SELECT user_id, full_name, email FROM fm_tbl_users";
    $users_result = $conn->query($sql_users);

    // member info
    $sql_members = "SELECT contant_information, address FROM fm_tbl_member";
    $members_result = $conn->query($sql_members);

    $users = array();
    $members = array();

    if ($users_result && $users_result->num_rows > 0) {
        while ($row = $users_result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    if ($members_result && $members_result->num_rows > 0) {
        while ($row = $members_result->fetch_assoc()) {
            $members[] = $row;
        }
    }

    $currentIndex = 0;
    if (isset($_GET['index'])) {
    $currentIndex = intval($_GET['index']);
    }
    
    if ($currentIndex < 0 || $currentIndex >= count($users)) {
        $currentIndex = 0;
    }
    
    $currentUser = null;
    $currentMember = null;

    if (isset($users[$currentIndex])) {
        $currentUser = $users[$currentIndex];
    }
    if (isset($members[$currentIndex])) {
        $currentMember = $members[$currentIndex];
    }

    $prevIndex = 0;
    $nextIndex = 0;

    if ($currentIndex > 0) {
        $prevIndex = $currentIndex - 1;
    } else {
        $prevIndex = count($users) - 1;
    }

    if ($currentIndex < count($users) - 1) {
        $nextIndex = $currentIndex + 1;
    } else {
        $nextIndex = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

    /*display css*/

    .user-avatar {
        font-size: 4rem;
        color: #0d6efd;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 rounded-3">
                <div class="card-header bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?index=<?= $prevIndex; ?>" class="btn btn-light btn-sm">
                            <i class="bi bi-chevron-left"></i> Previous
                        </a>
                        <h4 class="mb-0">User Information</h4>
                        <a href="?index=<?= $nextIndex; ?>" class="btn btn-light btn-sm">
                            Next <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <?php if ($currentUser && $currentMember) { ?>
                    <div class="card-body p-4">
                        <div class="text-center mb-4 py-3">
                            <i class="bi bi-person-circle user-avatar mb-3"></i>
                            <h3 class="fw-bold"><?= htmlspecialchars($currentUser['full_name']); ?></h3>
                            <span class="badge bg-secondary">ID: <?= htmlspecialchars($currentUser['user_id']); ?></span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="card h-100 bg-light border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="bi bi-envelope-fill text-primary me-2"></i>Email
                                        </h5>
                                        <p class="card-text"><?= htmlspecialchars($currentUser['email']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card h-100 bg-light border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="bi bi-telephone-fill text-primary me-2"></i>Contact Information
                                        </h5>
                                        <p class="card-text"><?= htmlspecialchars($currentMember['contant_information']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card h-100 bg-light border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>Address
                                        </h5>
                                        <p class="card-text"><?= htmlspecialchars($currentMember['address']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-center p-3 border-top">
                        <div class="text-muted">
                            <small>Showing user <?= ($currentIndex + 1); ?> of <?= count($users); ?></small>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card-body text-center p-5">
                        <i class="bi bi-exclamation-circle text-warning display-1 mb-3"></i>
                        <h4>No User Data Available</h4>
                        <p class="text-muted">No users or member information found in the database.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>