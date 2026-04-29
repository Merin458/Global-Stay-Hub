<?php
session_start();
include('../dboperation.php');
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $houseid     = $_POST['house_id'];
    $housename   = $_POST['housename'];
    $desc        = $_POST['desc'];
    $noofperson  = $_POST['noofperson'];
    $rate        = $_POST['rate'];

    // Fetch old images from DB
    $sql_old = "SELECT himage FROM tbl_housedetails WHERE house_id='$houseid'";
    $res_old = $obj->executequery($sql_old);
    $row_old = mysqli_fetch_assoc($res_old);
    $old_images = $row_old ? $row_old['himage'] : '';

    $uploaded_files = [];

    // Handle multiple image uploads
    if (!empty($_FILES['himage']['name'][0])) {
        $files = $_FILES['himage'];

        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] == 0) {
                $filename = time() . '_' . basename($files['name'][$i]);
                $targetPath = "../uploads/" . $filename;

                if (move_uploaded_file($files['tmp_name'][$i], $targetPath)) {
                    $uploaded_files[] = $filename;
                }
            }
        }

        // If new images uploaded, merge with old images
        if (!empty($uploaded_files)) {
            $all_images = $uploaded_files;
            if (!empty($old_images)) {
                $all_images = array_merge(explode(",", $old_images), $uploaded_files);
            }
            $images_str = implode(",", $all_images);
        } else {
            $images_str = $old_images; // keep old if nothing uploaded
        }
    } else {
        $images_str = $old_images; // keep old if nothing uploaded
    }

    // Update query
    $sql = "UPDATE tbl_housedetails 
            SET house_name='$housename',
                housedescription='$desc',
                noofperson='$noofperson',
                rate='$rate',
                himage='$images_str'
            WHERE house_id='$houseid'";

    if ($obj->executequery($sql)) {
        echo "<script>alert('House details updated successfully!'); window.location.href='houseview.php';</script>";
    } else {
        echo "<script>alert('Error updating house details.'); window.location.href='houseedit.php?house_id=$houseid';</script>";
    }
}
?>
