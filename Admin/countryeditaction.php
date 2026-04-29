<?php
include("../dboperation.php");
$obj = new dboperation();

// Check if form submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $country_id = $_POST['country_id'];
    $country_name = $_POST['country_name'];

    // Validate country name
    if(empty($country_name)){
        echo "<script>alert('Country name cannot be empty!'); window.history.back();</script>";
        exit;
    }

    // Handle flag upload
    if(isset($_FILES['country_flag']) && $_FILES['country_flag']['name'] != ""){
        $file_name = time().'_'.$_FILES['country_flag']['name'];
        $file_tmp = $_FILES['country_flag']['tmp_name'];
        $target = "../Uploads/".$file_name;

        if(move_uploaded_file($file_tmp, $target)){
            // Update name + flag
            $sql = "UPDATE tbl_country SET country_name='$country_name', country_flag='$file_name' WHERE country_id='$country_id'";
        } else {
            echo "<script>alert('Failed to upload flag!'); window.history.back();</script>";
            exit;
        }
    } else {
        // Update only country name
        $sql = "UPDATE tbl_country SET country_name='$country_name' WHERE country_id='$country_id'";
    }

    $obj->executequery($sql);
    echo "<script>alert('Country updated successfully!'); window.location.href='countryview.php';</script>";
    exit;
}
?>
