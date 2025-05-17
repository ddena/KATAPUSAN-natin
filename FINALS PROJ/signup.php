<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);

include "emailverify.php";

$signup_success = false;
$signup_error = false;

  if(isset($_POST['sub'])){
    $SUfullname = $_POST['fullname'];
    $SUusername = $_POST['username'];
    $SUemail = $_POST['email'];
    $SUpassword = md5($_POST['password']);
    $role = "User";

    // newly added (otp + logs)

    $SUotp = rand(000000, 999999); // otp 
    $SUstatus = "Pending";

    $insertsql = "INSERT INTO fm_tbl_users (full_name, username, email, password, role, otp, status) VALUES ('$SUfullname', '$SUusername', '$SUemail', '$SUpassword', '$role', '$SUotp', '$SUstatus')";


    if ($conn->query($insertsql) === TRUE) {
        $signup_success = true;
      } else {
        $signup_error = true;
      }

      // logs
    $ccid = $_SESSION['user_id']; 
    $logssql = "Insert into fm_tbl_logs (user_id, action, datetime) VALUES ('" .$id. "', 'Signed Up', NOW())";
    $conn->query($logssql);
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: url('signup-bg.png') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      display: flex;
      width: 800px;
      height: 500px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    .left {
      flex: 1;
      background-color: #1E3A8A;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 15px;
    }

    .left h1 {
      margin-bottom: 5px;
      font-size: 36px;
    }

    .right {
      flex: 1;
      background-color: #ffffff;
      padding: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .right h4 {
      color:rgb(0, 0, 0);
      margin-bottom: 10px;
    }

    .form-container {
      width: 100%;
    }

    .row {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .col {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 5px;
      color: #1E3A8A;
      font-size: 14px;
    }

    input, select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .submit-btn {
      margin-top: 10px;
      background-color: #FACC15;
      color:rgb(0, 0, 0);
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #eab308;
    }

    .footer-text {
      margin-top: 17px;
      font-size: 13px;
      text-align: center;
    }

    .footer-text a {
      color: #1E3A8A;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="left">
    <h1>Hello!</h1>
    <p>Want to create an account?</p>
  </div>

  <div class="right">
    <h4>Sign-Up</h4>
    <form action="signup.php" method="POST" class="form-container">
      <div class="row">
        <div class="col">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" placeholder="First Name, Middle Name, Last Name" required>
        </div>

        <div class="col">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>

        <div class="col">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="col">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="col">
          <button type="submit" name="sub" class="submit-btn" id="sub">Create Account</button>
        </div>
      </div>
    </form>
    <p class="footer-text">Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>

<?php
if ($signup_success == true) {
  send_verification($SUfullname, $SUemail, $SUotp);
  echo '
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: "success",
      title: "Account Created!",
      text: "You can now login.",
      confirmButtonText: "OK"
    });
  </script>';
}

if ($signup_error == true) {
  echo '
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: "error",
      title: "Signup Failed",
      text: "Something went wrong. Try again."
    });
  </script>';
}
?>

</body>
</html>

