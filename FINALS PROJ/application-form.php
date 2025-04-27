<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

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

    /*application form css*/
    .form-container {
      display: flex;
      gap: 20px;
      padding: 40px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .form-card {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      width: 600px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .form-card h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .form-card p {
      font-size: 13px;
      color: #555;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .flex-pair {
     display: flex;
     gap: 10px;
    }

    .flex-pair .form-group {
     flex: 1;
    }

    label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 5px;
    }

    input, select {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      background-color: #f9f9f9;
    }

    .submit-btn {
      background-color: #2C2C2C;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 65px;
      margin: 20px auto 0;
      display: block;
      text-align: center;
    }

    .submit-btn:hover {
      background-color: #16307a;
    }

    .required {
      color: red;
    }

    /*footer css*/

    footer {
      background-color: #f8f8f8;
      margin-top: 30px;
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
      border-top: 1px solid #ccc;
      font-size: 14px;
    }

    .footer-divider {
      border: none;
      border-top: 1px solid #ccc;
      margin-top: 40px;
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
                    <a class="nav-link fw-bold" href="#">APPLY</a>
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

<!--header-->
<div class="header mt-5">
    <h1 class="mt-3"><b>Application Form</b></h1>
    <div class="breadcrumb">
      <span>Home</span> 
      <span class="mx-2"> / </span> 
      <a href="#"> Loan Apply Form </a>
    </div> 
  </div>

<!--application form-->
  <div class="form-container">
    <div class="form-card">
      <h3><b>Personal Details</b></h3>
      <p>Fill out the form to submit your loan request. Do not leave blank fields.</p>

      <div class="row">
        <div class="col form-group">
          <label>First Name</label>
          <input type="text" name="AFfirstname" id="" value="">
        </div>
        <div class="col form-group">
          <label>Middle Name</label>
          <input type="text" name="AFmiddlename" id="" value="">
        </div>
        <div class="col form-group">
          <label>Surname</label>
          <input type="text" name="AFsurname" id="" value="">
        </div>
      </div>

      <div class="form-group">
        <label>Member ID</label>
        <input type="text" name="AFmemberid" id="" value="">
      </div>

      <div class="row">
        <div class="col form-group">
          <label>Email</label>
          <input type="email" name="AFemail" id="" value="">
        </div>
        <div class="col form-group">
          <label>Contact Number</label>
          <input type="text" name="AFcontactnum" id="" value="">
        </div>
      </div>
      
      <div class="form-group">
        <label>Address</label>
        <input type="text" placeholder="Street Address, Subdivision, City, Province, Country" name="AFaddress" id="" value="">
      </div>

      <h3><b>Loan Details</b></h3>
      <p>Fill out the form to submit your loan request. Do not leave blank fields.</p>

      <div class="form-group">
        <label>Loan Type</label>
        <select>
          <option selected disabled>Select Loan Type</option>
          <option>Personal Loan</option>
          <option>Auto Loan</option>
          <option>Housing Loan</option>
          <option>Student Loan</option>
        </select>
      </div>

      <div class="row">
        <div class="col form-group">
          <label>Loan Amount</label>
          <input type="text" name="AFloanamount" id="" value="">
        </div>
        <div class="col form-group">
          <label>Interest Rate</label>
          <input type="text" name="AFinterestrate" id="" value="">
        </div>
      </div>

      <div class="form-group">
        <label>Loan Term</label>
        <select>
          <option selected disabled>Select Term</option>
          <option>6 months</option>
          <option>12 months</option>
          <option>24 months</option>
        </select>
      </div>
    </div>

    <!--application dates and payment -->
    <div class="form-card">
      <h3><b>Application Dates</b></h3>
      <p>Fill out the form to submit your loan request. Do not leave blank fields.</p>

      <div class="form-group">
        <label>Date Applied</label>
        <input type="date" name="AFdateapplied" id="" value="">
      </div>
      <div class="form-group">
        <label>Date Approved <span class="required">*</span></label>
        <input type="date" name="AFdateapproved" id="" value="">
      </div>
      <div class="form-group">
        <label>Date Disbursed <span class="required">*</span></label>
        <input type="date" name="AFdatedisbursed" id="" value="">
      </div>

      <h3><b>Payment Details</b></h3>
      <p>Fill out the form to submit your loan request. Do not leave blank fields.</p>

      <div class="form-group">
        <label>Payment Terms</label>
        <select>
          <option selected disabled>Select Terms</option>
          <option>Monthly</option>
          <option>Quarterly</option>
        </select>
      </div>

      <div class="form-group">
        <label>Outstanding Balance</label>
        <input type="text" name="AFoutstandingbalance" id="" value="">
      </div>

      <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="apply" class="btn btn-dark btn-block w-100" value="Apply Now" id=sub>
        </div>
    </div>

</form>
</div>

  <!--footer tbe-->
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
     <p class="mt-3">Copyright @ 2025. All Rights Reserved.</p> 
    </div>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>

<?php
?>
