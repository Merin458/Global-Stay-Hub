<?php
session_start();
include('../../dboperation.php');
$obj = new dboperation();

if (!isset($_SESSION["Login_id"])) {
    echo "<script>alert('Admin not logged in'); window.location='../login.php';</script>";
    exit;
}

$login_id = $_SESSION["Login_id"];

// Form data
$current = $_POST['current_password'];
$new     = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

// Empty check
if ($current == "" || $new == "" || $confirm == "") {
    echo "<script>alert('All fields are required'); window.history.back();</script>";
    exit;
}

// New password match check
if ($new !== $confirm) {
    echo "<script>alert('New passwords do not match'); window.history.back();</script>";
    exit;
}

// Fetch current password from DB
$q1 = "SELECT password FROM tbl_adminlogin WHERE loginid='$login_id'";
$res = $obj->executequery($q1);
$row = mysqli_fetch_assoc($res);

if (!$row) {
    echo "<script>alert('Database error'); window.history.back();</script>";
    exit;
}

$db_password = $row['password'];

// Current password check
if ($current !== $db_password) {
    echo "<script>alert('Current password is incorrect'); window.history.back();</script>";
    exit;
}

// Update password
$q2 = "UPDATE tbl_adminlogin SET password='$new' WHERE loginid='$login_id'";
$update = $obj->executequery($q2);

if ($update) {
    echo "<script>alert('Password changed successfully'); window.location='profile.html';</script>";
} else {
    echo "<script>alert('Error updating password'); window.history.back();</script>";
}
?>
