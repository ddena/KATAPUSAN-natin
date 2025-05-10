<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_accounts_cc";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if (isset($_POST['submit'])) {
    $borrower_id = $_POST['borrower_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    $date_applied = date('Y-m-d');
    $status = "Pending";

    // Save member info
    $insert_member = "INSERT INTO fm_tbl_member (
        borrower_id, first_name, middle_name, surname, email, contact_number, address
    ) VALUES (
        '$borrower_id', '$first_name', '$middle_name', '$surname', '$email', '$contact_number', '$address'
    )";
    $conn->query($insert_member);

    // Save loan application
    $insert_loan = "INSERT INTO fm_tbl_loan (
        borrower_id, loan_type_id, loan_amount, loan_date, status, date_approved, date_imbursed
    ) VALUES (
        '$borrower_id', '$loan_type', '$loan_amount', '$date_applied', '$status', NULL, NULL
    )";
    $conn->query($insert_loan);

    echo "Loan application submitted successfully!";
}
?>

