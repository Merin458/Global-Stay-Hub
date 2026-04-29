<?php
session_start();
include("../dboperation.php");
$obj = new dboperation();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner_id = $_POST['owner_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new passwords match
    if($new_password !== $confirm_password){
        echo "<script>alert('New password and confirm password do not match!'); window.history.back();</script>";
        exit;
    }

    // Fetch current password from DB (plain text)
    $result = $obj->executequery("SELECT pw FROM tbl_houseowner WHERE owner_id='$owner_id'");
    $row = mysqli_fetch_assoc($result);

    // Verify current password (plain text)
    if($current_password !== $row['pw']){
        echo "<script>alert('Current password is incorrect!'); window.history.back();</script>";
        exit;
    }

    // Update password in DB
    $obj->executequery("UPDATE tbl_houseowner SET pw='$new_password' WHERE owner_id='$owner_id'");

    echo "<script>alert('Password changed successfully!'); window.location.href='hprofile.php';</script>";
    exit;
}
?>
