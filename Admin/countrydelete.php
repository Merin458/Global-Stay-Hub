<?php
include("../dboperation.php");
$obj = new dboperation();

// Check if country id is provided
if(!isset($_GET['id'])){
    echo "<script>alert('No country selected!'); window.location.href='countryview.php';</script>";
    exit;
}

$country_id = $_GET['id'];

// Fetch the country to get the flag file name
$result = $obj->executequery("SELECT country_flag FROM tbl_country WHERE country_id='$country_id'");
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $flag_file = "../Uploads/".$row['country_flag'];

    // Delete the flag file if it exists
    if(file_exists($flag_file)){
        unlink($flag_file);
    }

    // Delete the country from database
    $obj->executequery("DELETE FROM tbl_country WHERE country_id='$country_id'");
    echo "<script>alert('Country deleted successfully!'); window.location.href='countryview.php';</script>";
} else {
    echo "<script>alert('Country not found!'); window.location.href='countryview.php';</script>";
}
?>
