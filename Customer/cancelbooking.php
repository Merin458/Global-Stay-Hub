<?php
session_start();
include_once("../dboperation.php");

if (!isset($_SESSION['Login_id'])) {
    echo "You must be logged in to cancel a booking.";
    exit;
}

$userid = $_SESSION['Login_id'];

// Check if request_id is provided
if (!isset($_GET['request_id']) || empty($_GET['request_id'])) {
    echo "Invalid booking request.";
    exit;
}

$request_id = $_GET['request_id'];

$obj = new dboperation();

// Check if this booking belongs to the logged-in user and is still requested
$sqlCheck = "SELECT status FROM tbl_homerequest WHERE request_id = '$request_id' AND student_id = '$userid'";
$result = $obj->executequery($sqlCheck);

if (mysqli_num_rows($result) === 0) {
    echo "Booking not found or you are not authorized to cancel it.";
    exit;
}

$row = mysqli_fetch_assoc($result);

if (strtolower($row['status']) != 'requested') {
    echo "Only requested bookings can be cancelled.";
    exit;
}

// Update booking status to 'cancelled'
$sqlCancel = "UPDATE tbl_homerequest SET status='cancelled' WHERE request_id='$request_id' AND student_id='$userid'";
$result2 = $obj->executequery($sqlCancel);

if ($result2) {
    header("Location: mybooking.php?msg=Booking cancelled successfully");
    exit;
} else {
    echo "Error cancelling booking. Please try again.";
}
?>