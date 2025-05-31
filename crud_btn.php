<?php 
session_start();
require_once "connection.php";


if ($_SESSION['role'] === 'Admin') {
//BORROWER
if (isset($_POST['action']) && $_POST['action'] == 'add_borrower') {
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];

    $bwr_add = "INSERT INTO tbl_members (member_name, email, contact_information, address)
                VALUES ('$member_name', '$email', '$contact_information', '$address')";

    $conn->query($bwr_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Borrower', NOW())";
    $conn->query($logsql);
    
    header("Location: ad_borrower.php?status=borrower_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_borrower') {
    $member_id = $_POST['member_id'];
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];

    $bwr_edit = "UPDATE tbl_members 
                 SET member_name = '$member_name',
                     email = '$email',
                     contact_information = '$contact_information',
                     address = '$address'
                 WHERE member_id = $member_id";

    $conn->query($bwr_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Borrower', NOW())";
    $conn->query($logsql);

    header("Location: ad_borrower.php?status=borrower_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_borrower') {
    $member_id = $_POST['member_id'];

    $bwr_delete = " DELETE FROM tbl_members WHERE member_id = $member_id";
    $conn->query($bwr_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Borrower', NOW())";
    $conn->query($logsql);

    header("Location: ad_borrower.php?status=borrower_deleted");
    exit();
}

//LOAN
if (isset($_POST['action']) && $_POST['action'] == 'add_loan') {
    
    $borrower_id = $_POST['borrower_id'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_term = $_POST['loan_term'];
    $date_applied = $_POST['date_applied'];
    $date_approved = $_POST['date_approved'];
    $date_disbursed = $_POST['date_disbursed'];
    $outstanding_balance = $_POST['outstanding_balance'];

    $loan_add = "INSERT INTO tbl_loan (borrower_id, loan_amount, interest_rate, loan_term, date_applied, date_approved, date_disbursed, outstanding_balance)
             VALUES ('$borrower_id', '$loan_amount', '$interest_rate', '$loan_term', '$date_applied', '$date_approved', '$date_disbursed', '$outstanding_balance')";

    $conn->query($loan_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_loan.php?status=loan_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_loan') {
    $loan_id = $_POST['loan_id'];
    $borrower_id = $_POST['borrower_id'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_term = $_POST['loan_term'];
    $date_applied = $_POST['date_applied'];
    $date_approved = $_POST['date_approved'];
    $date_disbursed = $_POST['date_disbursed'];
    $outstanding_balance = $_POST['outstanding_balance'];

    $loan_edit = "UPDATE tbl_loan
             SET loan_amount = '$loan_amount',
                 interest_rate = '$interest_rate',
                 loan_term = '$loan_term',
                 date_applied = '$date_applied',
                 date_approved = '$date_approved',
                 date_disbursed = '$date_disbursed',
                 outstanding_balance = '$outstanding_balance'
             WHERE loan_id = $loan_id";

    $conn->query($loan_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_loan.php?status=loan_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_loan') {
    $loan_id = $_POST['loan_id'];

    $loan_delete = " DELETE FROM tbl_loan WHERE loan_id = $loan_id";
    $conn->query($loan_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_loan.php?status=loan_deleted");
    exit();
}

//PAYMENTS
if (isset($_POST['action']) && $_POST['action'] == 'add_payment') {
    
    $loan_id = $_POST['loan_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];

    $payment_add = "INSERT INTO tbl_payment (loan_id, payment_amount, payment_date)
             VALUES ('$loan_id', '$payment_amount', '$payment_date')";

    $conn->query($payment_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Payment Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_payments.php?status=payment_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_payment') {
    $payment_id = $_POST['payment_id'];
    $loan_id = $_POST['loan_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];

    $payment_edit = "UPDATE tbl_payment
             SET loan_id = '$loan_id',
                 payment_amount = '$payment_amount',
                 payment_date = '$payment_date'
             WHERE payment_id = $payment_id";

    $conn->query($payment_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_payments.php?status=payment_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_payment') {
    $payment_id = $_POST['payment_id'];

    $payment_delete = " DELETE FROM tbl_payment WHERE payment_id = $payment_id";
    $conn->query($payment_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Payment Record', NOW())";
    $conn->query($logsql);

    header("Location: ad_payments.php?status=payment_deleted");
    exit();
}

//USER
if (isset($_POST['action']) && $_POST['action'] == 'add_user') {
    
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    $user_add = "INSERT INTO tbl_user (full_name, username, email, password, role, status)
             VALUES ('$full_name', '$username', '$email', '$password', '$role', '$status')";

    $conn->query($user_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a New User', NOW())";
    $conn->query($logsql);

    header("Location: ad_users.php?status=user_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_user') {
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    $user_edit = "UPDATE tbl_user
             SET full_name = '$full_name',
                 username = '$username',
                 email = '$email',
                 password = '$password',
                 role = '$role',
                 status = '$status'
             WHERE user_id = $user_id";

    $conn->query($user_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a User', NOW())";
    $conn->query($logsql);

    header("Location: ad_users.php?status=user_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_user') {
    $user_id = $_POST['user_id'];

    $user_delete = " DELETE FROM tbl_user WHERE user_id = $user_id";
    $conn->query($user_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a User', NOW())";
    $conn->query($logsql);

    header("Location: ad_users.php?status=user_deleted");
    exit();
}

//LOGS
if (isset($_POST['action']) && $_POST['action'] == 'add_log') {
    
    $log_id = $_POST['log_id'];
    $user_id = $_POST['user_id'];
    $action = $_POST['actions'];
    $datetime = $_POST['datetime'];

    $logs_add = "INSERT INTO tbl_logs (log_id, user_id, action, datetime)
             VALUES ('$log_id', '$user_id', '$action', '$datetime')";

    $conn->query($logs_add);

    header("Location: ad_logs.php?status=log_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_log') {

    $log_id = $_POST['log_id'];
    $user_id = $_POST['user_id'];
    $action = $_POST['actions'];
    $datetime = $_POST['datetime'];

    $payment_edit = "UPDATE tbl_logs
             SET user_id = '$user_id',
                 action = '$action',
                 datetime = '$datetime'
             WHERE log_id = $log_id";

    $conn->query($payment_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Log Entry', NOW())";
    $conn->query($logsql);

    header("Location: ad_logs.php?status=log_edited");
    exit();
}


if (isset($_POST['action']) && $_POST['action'] == 'delete_log') {
    $log_id = $_POST['log_id'];

    $log_delete = " DELETE FROM tbl_logs WHERE log_id = $log_id";
    $conn->query($log_delete);

    header("Location: ad_logs.php?status=log_deleted");
    exit();
}
}


//EMPLOYEE

if ($_SESSION['role'] === 'Employee') {
    //BORROWER
if (isset($_POST['action']) && $_POST['action'] == 'add_borrower') {
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];

    $bwr_add = "INSERT INTO tbl_members (member_name, email, contact_information, address)
                VALUES ('$member_name', '$email', '$contact_information', '$address')";

    $conn->query($bwr_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Borrower', NOW())";
    $conn->query($logsql);
    
    header("Location: em_borrower.php?status=borrower_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_borrower') {
    $member_id = $_POST['member_id'];
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];

    $bwr_edit = "UPDATE tbl_members 
                 SET member_name = '$member_name',
                     email = '$email',
                     contact_information = '$contact_information',
                     address = '$address'
                 WHERE member_id = $member_id";

    $conn->query($bwr_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Borrower', NOW())";
    $conn->query($logsql);

    header("Location: em_borrower.php?status=borrower_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_borrower') {
    $member_id = $_POST['member_id'];

    $bwr_delete = " DELETE FROM tbl_members WHERE member_id = $member_id";
    $conn->query($bwr_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Borrower', NOW())";
    $conn->query($logsql);

    header("Location: em_borrower.php?status=borrower_deleted");
    exit();
}

//LOAN
if (isset($_POST['action']) && $_POST['action'] == 'add_loan') {
    
    $borrower_id = $_POST['borrower_id'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_term = $_POST['loan_term'];
    $date_applied = $_POST['date_applied'];
    $date_approved = $_POST['date_approved'];
    $date_disbursed = $_POST['date_disbursed'];
    $outstanding_balance = $_POST['outstanding_balance'];

    $loan_add = "INSERT INTO tbl_loan (borrower_id, loan_amount, interest_rate, loan_term, date_applied, date_approved, date_disbursed, outstanding_balance)
             VALUES ('$borrower_id', '$loan_amount', '$interest_rate', '$loan_term', '$date_applied', '$date_approved', '$date_disbursed', '$outstanding_balance')";

    $conn->query($loan_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: em_loan.php?status=loan_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_loan') {
    $loan_id = $_POST['loan_id'];
    $borrower_id = $_POST['borrower_id'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_term = $_POST['loan_term'];
    $date_applied = $_POST['date_applied'];
    $date_approved = $_POST['date_approved'];
    $date_disbursed = $_POST['date_disbursed'];
    $outstanding_balance = $_POST['outstanding_balance'];

    $loan_edit = "UPDATE tbl_loan
             SET loan_amount = '$loan_amount',
                 interest_rate = '$interest_rate',
                 loan_term = '$loan_term',
                 date_applied = '$date_applied',
                 date_approved = '$date_approved',
                 date_disbursed = '$date_disbursed',
                 outstanding_balance = '$outstanding_balance'
             WHERE loan_id = $loan_id";

    $conn->query($loan_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: em_loan.php?status=loan_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_loan') {
    $loan_id = $_POST['loan_id'];

    $loan_delete = " DELETE FROM tbl_loan WHERE loan_id = $loan_id";
    $conn->query($loan_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: em_loan.php?status=loan_deleted");
    exit();
}

//PAYMENTS
if (isset($_POST['action']) && $_POST['action'] == 'add_payment') {
    
    $loan_id = $_POST['loan_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];

    $payment_add = "INSERT INTO tbl_payment (loan_id, payment_amount, payment_date)
             VALUES ('$loan_id', '$payment_amount', '$payment_date')";

    $conn->query($payment_add);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Added a Payment Record', NOW())";
    $conn->query($logsql);

    header("Location: em_payments.php?status=payment_added");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_payment') {
    $payment_id = $_POST['payment_id'];
    $loan_id = $_POST['loan_id'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];

    $payment_edit = "UPDATE tbl_payment
             SET loan_id = '$loan_id',
                 payment_amount = '$payment_amount',
                 payment_date = '$payment_date'
             WHERE payment_id = $payment_id";

    $conn->query($payment_edit);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Edited a Loan Record', NOW())";
    $conn->query($logsql);

    header("Location: em_payments.php?status=payment_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_payment') {
    $payment_id = $_POST['payment_id'];

    $payment_delete = " DELETE FROM tbl_payment WHERE payment_id = $payment_id";
    $conn->query($payment_delete);

    $user_id = $_SESSION['user_id'];
    $logsql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('$user_id', 'Deleted a Payment Record', NOW())";
    $conn->query($logsql);

    header("Location: em_payments.php?status=payment_deleted");
    exit();
}

}
?>
