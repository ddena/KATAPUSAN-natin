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

$alertMessage = '';
$alertType = '';

if (isset($_POST['apply'])) {
    // get form inputs
    $full_name = $_POST['AFfullname'];
    $email = $_POST['AFemail'];
    $contact = $_POST['AFcontactnum'];
    $address = $_POST['AFaddress'];
    $loan_type_id = $_POST['AFloantype'];
    $loan_term = $_POST['AFloanterm'];
    $payment_terms = $_POST['AFpaymentterms'];

    // valid id photo
    $imagepath = "fm-images/".basename($_FILES['upload_img']['name']); 
    move_uploaded_file($_FILES['upload_img']['tmp_name'], $imagepath);

    // insert member info into fm_tbl_member
    $sql_member = "INSERT INTO fm_tbl_member (member_name, contant_information, address, img_path)
                   VALUES ('$full_name', '$contact', '$address', '$imagepath')";
    if ($conn->query($sql_member) === TRUE) {
        $member_id = $conn->insert_id;
    } else {
        $alertType = 'error';
        $alertMessage = 'Error inserting member: ' . $conn->error;
    }

    if (!$alertMessage) {
        // get loan type details
        $sql_loan_type = "SELECT loan_type_name FROM fm_tbl_loantype WHERE loan_type_id = $loan_type_id";
        $result = $conn->query($sql_loan_type);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $loan_type_name = $row['loan_type_name'];
        } else {
            $alertType = 'error';
            $alertMessage = 'Invalid loan type selected.';
        }
    }

    if (!$alertMessage) {
        // set amount and interest based on loan_type_id
        switch ($loan_type_id) {
            case 1:
                $loan_amount = 20000;
                $interest_rate = 0.05;
                break;
            case 2:
                $loan_amount = 50000;
                $interest_rate = 0.06;
                break;
            case 3:
                $loan_amount = 100000;
                $interest_rate = 0.04;
                break;
            case 4:
                $loan_amount = 15000;
                $interest_rate = 0.03;
                break;
            default:
                $loan_amount = 10000;
                $interest_rate = 0.05;
                break;
        }

        $total_amount_due = $loan_amount + ($loan_amount * $interest_rate);
        $date_applied = date("Y-m-d");
        $date_approved = date("Y-m-d", strtotime("+3 days"));
        $date_disbursed = date("Y-m-d", strtotime("+5 days"));

        $sql_loan = "INSERT INTO fm_tbl_loan 
                    (loan_amount, interest_rate, loan_term, date_applied, date_approved, date_disbursed, outstanding_balance, borrower_id)
                    VALUES 
                    ('$loan_amount', '$interest_rate', '$loan_term', '$date_applied', '$date_approved', '$date_disbursed', '$total_amount_due', '$member_id')";

        if ($conn->query($sql_loan) === TRUE) {
            $alertType = 'success';
            $alertMessage = 'Loan application and payment record submitted successfully!';
        } else {
            $alertType = 'error';
            $alertMessage = 'There was an issue with your loan submission. Please try again.';
        }
    }
}
?>

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

    /*valid id*/
    .upload-section {
      border: 2px dashed #ddd;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      margin: 20px 0;
      background-color: #fafafa;
    }

    .upload-section.dragover {
      border-color: #1E3A8A;
      background-color: #f0f4ff;
    }

    .upload-section h4 {
      color: #1E3A8A;
      margin-bottom: 10px;
    }

    .upload-section p {
      color: #666;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .file-input-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
    }

    .file-input-wrapper input[type=file] {
      position: absolute;
      left: -9999px;
    }

    .file-input-btn {
      background-color: #1E3A8A;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
      border: none;
      font-size: 14px;
    }

    .file-input-btn:hover {
      background-color: #16307a;
    }

    .preview-container {
      margin-top: 20px;
    }

    .preview-image {
      max-width: 300px;
      max-height: 200px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border: 2px solid #ddd;
    }

    .file-info {
      margin-top: 10px;
      padding: 10px;
      background-color: #e8f4f8;
      border-radius: 6px;
      font-size: 12px;
      color: #333;
    }

    .remove-file {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
      margin-left: 10px;
    }

    .remove-file:hover {
      background-color: #c82333;
    }

    /*footer css*/
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

    @media (max-width: 768px) {
      .form-card {
        width: 100%;
        margin: 0 10px;
      }
      
      .preview-image {
        max-width: 250px;
      }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <h1 class="mt-3"><b>Application Form</b></h1>
  <div class="breadcrumb">
    <span><a href="homepage.php"> Home </a></span> 
    <span class="mx-2"> / </span> 
    <span> Loan Apply Form </span>
  </div> 
</div>

<!--application form-->
<div class="form-container">
  <div class="form-card">
    <h3><b>Personal Details</b></h3>
    <p>Fill out the form to submit your loan request. Do not leave blank fields.</p>

    <form action="application-form.php" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label>Full Name <span class="required">*</span></label>
      <input type="text" name="AFfullname" required placeholder="First Name, Middle Name, Last Name">
    </div>

    <div class="row">
      <div class="col form-group">
        <label>Email <span class="required">*</span></label>
        <input type="email" name="AFemail" required>
      </div>

      <div class="col form-group">
        <label>Contact Number <span class="required">*</span></label>
        <input type="tel" name="AFcontactnum">
      </div>
    </div>
    
    <div class="form-group">
      <label>Address <span class="required">*</span></label>
      <input type="text" placeholder="Street Address, Subdivision, City, Province, Country" name="AFaddress" required>
    </div>

    <h3><b>Loan Details</b></h3>
    <p>Select your preferred loan type and terms.</p>

    <div class="form-group">
      <label>Loan Type <span class="required">*</span></label>
      <select name="AFloantype" required>
        <option value="" selected disabled>Select Loan Type</option>
        <option value="1">Personal Loan (5% interest)</option>
        <option value="2">Auto Loan (6% interest)</option>
        <option value="3">Housing Loan (4% interest)</option>
        <option value="4">Student Loan (3% interest)</option>
      </select>
    </div>

    <div class="form-group">
      <label>Loan Term <span class="required">*</span></label>
      <select name="AFloanterm" required>
        <option value="" selected disabled>Select Term</option>
        <option value="6">6 months</option>
        <option value="12">12 months</option>
        <option value="24">24 months</option>
      </select>
    </div>

    <h3><b>Payment Details</b></h3>
    <p>Choose your preferred payment schedule.</p>

    <div class="form-group">
      <label>Payment Terms <span class="required">*</span></label>
      <select name="AFpaymentterms" required>
        <option value="" selected disabled>Select Terms</option>
        <option value="Monthly">Monthly</option>
        <option value="Quarterly">Quarterly</option>
      </select>
    </div>

    <!--valid id upload section-->
    <h3><b>Valid ID Upload</b></h3>
    <p>Please upload a clear photo of your valid government-issued ID.</p>
    
    <div class="upload-section" id="uploadArea">
      <h4><i class="fas fa-cloud-upload-alt"></i> Upload Valid ID</h4>
      <p>Drag and drop your ID photo here, or click to browse</p>
      <p><small>Accepted formats: JPG, JPEG, PNG (Max size: 5MB)</small></p>
      
      <div class="file-input-wrapper">
        <input type="file" name="upload_img" id="fileInput" accept="image/*" required onchange="previewImage(event)">
        <label for="fileInput" class="file-input-btn">
          <i class="fas fa-folder-open"></i> Choose File
        </label>
      </div>
    </div>

    <div class="preview-container" id="previewContainer" style="display: none;">
      <img id="preview_img" class="preview-image" alt="ID Preview">
      <div class="file-info">
        <button type="button" class="remove-file" onclick="removeFile()">
          <i class="fas fa-times"></i> Remove
        </button>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">  
          <input type="submit" name="apply" class="btn btn-dark btn-block w-100" value="Apply Now" id="submitBtn">
      </div>
    </div>
    </form>
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
        <li><a href="application-form.php">Loan Application</a></li>
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

<?php
if ($alertMessage) {
    echo "<script>
        Swal.fire({
            icon: '$alertType',
            title: '" . ucfirst($alertType) . "',
            text: '$alertMessage',
            confirmButtonText: 'Okay'
        }).then(() => {";

    if ($alertType === 'success') {
        echo "window.location.href = 'application-form.php';";
    }

    echo "});
    </script>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var preview = document.getElementById("preview_img");
        var previewContainer = document.getElementById("previewContainer");
        var uploadArea = document.getElementById("uploadArea");
        
        if (file) {
            preview.src = URL.createObjectURL(file);
            previewContainer.style.display = 'block';
            uploadArea.style.display = 'none';
        }
    }
    
    function removeFile() {
        document.getElementById("fileInput").value = '';
        document.getElementById("preview_img").src = '';
        document.getElementById("previewContainer").style.display = 'none';
        document.getElementById("uploadArea").style.display = 'block';
    }
    
    // click to upload
    document.getElementById('uploadArea').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
</script>

</body>
</html>