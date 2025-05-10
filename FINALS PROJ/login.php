<?php

$login_error = false;

$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbase, $port);

// new

$login_error = false;
$login_success = false;

if(isset($_POST['sub'])){
  $username = $_POST['LIusername'];
  $password = md5($_POST['LIpassword']); 

  $sql = "SELECT * FROM fm_tbl_users WHERE username = '$username' AND password = '$password'";
  $result = $conn -> query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $role = $user['role'];
    $member_id = $user['member_id'];

    session_start();

    $_SESSION['username'] = $LIusername;
    $_SESSION['role'] = $role;
    $_SESSION['member_id'] = $member_id;

    if ($role == 'Admin') {
      header('Location: admin_dashboard.php'); 
    } elseif ($role == 'Employee') {
      header('Location: employee_dashboard.php'); 
    } else {
      header('Location: homepage.php'); 
  }
      exit(); // Make sure to stop further script execution
  }   else {
  
    $login_error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fundify Me Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    .login-container {
      height: 100vh;
    }
    .left-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      padding: 2rem;
    }
    .left-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .right-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 4rem;
    }
    h4 {
      font-weight: bold;
      margin-bottom: 1rem;
    }
    label {
      font-weight: 500;
      margin-top: 1rem;
    }
    .btn-login {
      background-color: #1E3A8A;
      color: white;
      border: none;
      margin-top: 1.5rem;
      padding: 0.75rem;
      width: 100%;
    }
    .btn-login:hover {
      background-color:#16307a;
    }
  </style>
</head>

<body>
<div class="container-fluid login-container">
  <div class="row h-100">
    <div class="col-md-6 left-container p-0">
      <img src="login-photo3.png" alt="Login Image">
    </div>

    <div class="col-md-6 right-container">
      <div class="row mb-2">
        <div class="col">
          <h3><b>Login</b></h3>
          <p class="text-muted">Welcome to FundifyMe! Please login to your account.</p>
        </div>
      </div>

      <form action="login.php" method="post">
        <div class="row mb-3">
          <div class="col">
            <label for="LIusername">Username</label>
            <input type="text" class="form-control" id="LIusername" name="LIusername" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col">
            <label for="LIpassword">Password</label>
            <input type="password" class="form-control" id="LIpassword" name="LIpassword" required>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <input type="submit" name="sub" class="btn btn-login" value="Login" id="sub">
          </div>
        </div>
      </form>

      <div class="row mt-3">
        <div class="col text-center">
          <small class="text-muted">New User? <a href="signup.php" class="text-primary">Sign-Up</a></small>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if ($login_error == true) {
  echo '
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: "error",
      title: "Login Failed",
      text: "Invalid username or password."
    });
  </script>';
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

