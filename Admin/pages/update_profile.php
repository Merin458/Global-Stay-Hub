<?php
session_start();
include('../dboperation.php');
$obj = new dboperation();

if (!isset($_SESSION["Login_id"])) {
    echo "<script>alert('User not logged in'); window.location='../login.php';</script>";
    exit;
}

$login_id = $_SESSION["Login_id"];

// Fetch form values safely
$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$phone   = trim($_POST['phone']);
$address = trim($_POST['address']);

// Basic validation
if ($name == "" || $email == "" || $phone == "" || $address == "") {
    echo "<script>alert('All fields are required'); window.history.back();</script>";
    exit;
}

// Update query
$q = "
UPDATE owner_registration 
SET 
    name = '$name',
    email = '$email',
    phone = '$phone',
    address = '$address'
WHERE login_id = '$login_id'
";

// Run query
$result = $obj->executequery($q);

// Check result
if ($result) {
    echo "<script>alert('Profile Updated Successfully'); window.location='profile.php';</script>";
} else {
    echo "<script>alert('Error updating profile'); window.history.back();</script>";
}
?>
