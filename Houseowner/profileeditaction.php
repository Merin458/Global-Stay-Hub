<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['Login_id'])) {
    echo "<script>alert('You must be logged in!');window.location='../login.php';</script>";
    exit;
}

$ownerid = $_SESSION['Login_id'];

// Get posted data
$name    = $_POST['owner_name'];
$email   = $_POST['email'];
$phone   = $_POST['phone'];
$pincode = $_POST['pincode'];

// Handle profile image upload
$profile_img = null;
if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_img']['tmp_name'];
    $fileName = $_FILES['profile_img']['name'];
    $fileSize = $_FILES['profile_img']['size'];
    $fileType = $_FILES['profile_img']['type'];

    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedfileExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $uploadFileDir = '../uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }
        $newFileName = "owner_" . $ownerid . "_" . time() . "." . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profile_img = $newFileName;
        }
    }
}

// Build update query
if ($profile_img) {
    $sql = "UPDATE tbl_houseowner 
            SET owner_name='$name', email='$email', phone='$phone', pincode='$pincode', profile_img='$profile_img' 
            WHERE owner_id='$ownerid'";
} else {
    $sql = "UPDATE tbl_houseowner 
            SET owner_name='$name', email='$email', phone='$phone', pincode='$pincode' 
            WHERE owner_id='$ownerid'";
}

if ($obj->executequery($sql)) {
    echo "<script>alert('Profile updated successfully!');window.location='hprofileedit.php';</script>";
} else {
    echo "<script>alert('Something went wrong, please try again.');window.location='hprofileedit.php';</script>";
}
?>
