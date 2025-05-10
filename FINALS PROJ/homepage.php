<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

    /*banner css*/
    .banner-photo{
        background-color: rgba(16, 15, 15, 0.6);
    }

    .btn-custom-blue{
        background-color: #1E3A8A;
        color: white;
        border: none;
        font-size: 15px;
        padding: 10px 40px;
    }

    .btn-custom-blue:hover {
        background-color: #1E40AF;
        color: white;              
        opacity: 1;                
    }

    .banner-wrapper{
        height: 90vh; 
        overflow: hidden;
    }

    .object-fit-cover{
        object-fit: cover;
    }

    .banner-text{
        margin-top: 200px;
    }

    /*how to css*/
    .loan-steps{
        background-color: #1E3A8A;
    }

    .step-1{
        width: fit-content;
    }

    .step-2{
        width: fit-content;
    }

    .step-3{
        width: fit-content;
    }

    .left-text-2{
        color: #444242;
    }

    /*query css tbf*/
    .query-background{
      background-color: #FACC15; 
      padding: 2rem 0;
    }

    .query-content{
      background-color: white;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .btn-custom {
      background-color: #1E3A8A;
      font-weight: 500;
      padding: 10px 40px;
    }

    .btn-custom:hover {
      background-color: #1E40AF;
    }

    .custom-image {
      width: 100%;
      max-width: 350px;
      height: auto;
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
                    <a class="nav-link fw-bold" href="#">MY LOANS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">PAYMENT HISTORY</a>
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

<!--banner-->
<header>
  <div class="position-relative banner-wrapper mt-3">
    <img src="banner-pic.JPG" alt="Banner" class="w-100 h-100 object-fit-cover">
    <div class="banner-photo position-absolute top-0 start-0 w-100 h-100">
      <div class="d-flex justify-content-start align-items-center h-100 ps-5">
        <div class="banner-text text-white">
          <h1 class="mb-3">Need Financial Assistance? <br> Apply for a Loan Today.</h1>
          <h6 class="mb-3 fw-light">Take control of your finances with a quick and hassle-free loan application. <br> Whether it's for education, personal needs, or emergencies, we've got you <br> covered!</h6>
          <a class="btn-custom-blue btn btn-lg fw-light" href="application-form.php" role="button">Apply Now!</a>
        </div>
      </div>
    </div>
  </div>
</header>

<!--how to get a loan-->
<section class="loan-steps container-fluid py-5 px-3 mt-5">
  <div class="container">
    <div class="row g-4 align-items-start">
      
      <!--left -->
      <div class="col-lg-6">
        <div class="bg-white rounded-4 p-4 shadow-sm">
          <h1 class="fw-bold mt-3 mb-4">How to get a loan?</h1>
          <p>
            To apply for a loan, members need a valid ID, updated contact details, and a completed application form.
            Approval involves verifying borrower details, loan type, and outstanding balances. The entire process is designed to ensure responsible lending and borrowing. Once approved, funds are disbursed as agreed. Timely payments help maintain good standing.
          </p>
          <h2 class="left-text-2 fw-bold mt-4 mb-3">Eligibility for loan</h2>
          <p class="mt-4 mb-4">
            For loan eligibility, applicants must be between 21 and 65 years old and must be either a Filipino citizen or a foreign resident with a valid permit. A stable source of income—whether from employment or business—is required, along with essential documents such as a valid ID, proof of income, and credit history. Depending on the loan type, a guarantor or collateral may also be required to complete the application.
          </p>
        </div>
      </div>

      <!--right-->
      <div class="col-lg-6">
        <div class="d-flex flex-column gap-4">
          
          <!--step 1-->
          <div class="bg-white rounded-5 p-4 shadow-sm">
            <div class="step-1 small bg-dark text-white px-3 py-2 rounded-top rounded-bottom mb-2 mx-3">Step 1</div>
            <h4 class="fw-bold mx-3">Submit an application</h4>
            <p class="mb-0 mx-3">Fill out the loan application form with your details.</p>
          </div>

          <!--step 2-->
          <div class="bg-white rounded-5 p-4 shadow-sm">
            <div class="step-2 small bg-dark text-white px-3 py-2 rounded-top rounded-bottom mb-2 mx-3">Step 2</div>
            <h4 class="fw-bold mx-3">Get approved</h4>
            <p class="mb-0 mx-3">Our admin reviews and approves your loan request.</p>
          </div>

          <!--step 3-->
          <div class="bg-white rounded-5 p-4 shadow-sm">
            <div class="step-3 small bg-dark text-white px-3 py-2 rounded-top rounded-bottom mb-2 mx-3">Step 3</div>
            <h4 class="fw-bold mx-3">Receive funds</h4>
            <p class="mb-0 mx-3">Loan is disbursed once you're approved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--query section-->
<div class="query-background mt-5">
  <div class="container">
    <div class="query-content row align-items-center">

      <!--text -->
      <div class="col-md-6 mb-4 mb-md-0 mx-5">
        <h1 class="fw-bold mt-2 mx-5">Any other questions?</h1>
        <p class="mt-4 mx-5">If you need help with your loan, you can check how to apply, track your loan status, understand repayment schedules, and review eligibility requirements. We also prioritize your privacy and security.</p>
        <p class="mt-2 mx-5">For further assistance, feel free to contact our support team.</p>
        <button class="btn btn-custom mt-3 mx-5 text-light">Ask the operator a question</button>
      </div>

      <!--image tbf-->
      <div class="col-md-4 d-flex justify-content-center align-items-center">
        <img src="phone-picture.png" alt="Phone Icon" class="img-fluid custom-image">
      </div>
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

<?php 

?>
