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
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1E3A8A 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .otp-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 450px;
            margin: 2rem auto;
            transition: transform 0.3s ease;
        }
        
        .otp-container:hover {
            transform: translateY(-5px);
        }
        
        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1E3A8A, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .otp-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .otp-input:focus {
            outline: none;
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }
        
        .btn-verify {
            background: linear-gradient(135deg, #1E3A8A, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 12px 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a6fd8, #6a42a0);
        }
        
        .resend-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .resend-link:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @media (max-width: 576px) {
            .otp-container {
                margin: 1rem;
                max-width: none;
            }
            
            .otp-input {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
        <form action="otp-dashboard.php" method="post" class="w-100">
            <div class="otp-container p-4 fade-in">
                <div class="text-center">
                    <div class="icon-wrapper">
                        <i class="fas fa-shield-alt text-white fa-2x"></i>
                    </div>
                    
                    <h2 class="text-dark fw-bold mb-2">
                        Verify Your Account
                    </h2>
                    
                    <p class="text-muted mb-0">
                        We've sent a 6-digit verification code to your email address.
                        <br>
                        <small>Please enter it below to continue.</small>
                    </p>
                </div>

                <div class="otp-inputs">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                </div>

                <input type="hidden" id="ccotp" name="ccotp" value="">

                <div class="text-center mb-3">
                    <button type="submit" name="sub" class="btn btn-verify btn-primary w-100">
                        <i class="fas fa-check-circle me-2"></i>
                        Verify Code
                    </button>
                </div>

                <div class="text-center">
                    <a href="#" class="resend-link" onclick="showResendMessage()">
                        <i class="fas fa-redo me-1"></i>
                        Resend verification code
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // all otp inputs 
        const otpInputs = document.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('ccotp');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
            
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                
                updateHiddenInput();
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        
        function updateHiddenInput() {
            const otpValue = Array.from(otpInputs).map(input => input.value).join('');
            hiddenInput.value = otpValue;
        }
        
        function showResendMessage() {
            Swal.fire({
                icon: 'success',
                title: 'Code Sent!',
                text: 'A new verification code has been sent to your email.',
                timer: 2000,
                showConfirmButton: false
            });
        }
        
        otpInputs[0].focus();
    </script>

    <?php

    if(isset($_POST['sub'])){
    $otpinput = $_POST['ccotp'];

    $otpsql = "SELECT * FROM fm_tbl_users WHERE otp = '".$otpinput."'";
    $result = $conn->query($otpsql);

    if ($result -> num_rows == 1) {
        $updatessql = "Update fm_tbl_users set status = 'Active', otp=NULL where otp='".$otpinput."'";
        $conn->query($updatessql);

        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Account Activated",
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = "login.php";
        })
        </script>
        <?php
        
    } else {
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Invalid OTP",
            showConfirmButton: false,
            timer: 2000
        });
        </script>


        <?php
    }  
}

?>
</body>
</html>
