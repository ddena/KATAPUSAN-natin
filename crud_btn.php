<?php 
require_once "connection.php";

//BORROWER
if (isset($_POST['action']) && $_POST['action'] == 'add_borrower') {
    $member_name = $_POST['member_name'];
    $email = $_POST['email'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];

    $bwr_add = "INSERT INTO tbl_members (member_name, email, contact_information, address)
                VALUES ('$member_name', '$email', '$contact_information', '$address')";

    $conn->query($bwr_add);
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
    header("Location: ad_borrower.php?status=borrower_edited");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_borrower') {
    $member_id = $_POST['member_id'];

    $bwr_delete = " DELETE FROM tbl_members WHERE member_id = $member_id";
    $conn->query($bwr_delete);
    header("Location: ad_borrower.php?status=borrower_deleted");
    exit();


}


?>