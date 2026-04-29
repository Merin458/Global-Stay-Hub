<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $hname       = $_POST['hname'];
    $description = $_POST['desc'];
    $noofperson  = $_POST['hnopersons'];
    $rate        = $_POST['rate'];
    $type        = $_POST['city'];
    $ownerid     = $_SESSION["Login_id"];

    if ($type == "city") {
        $id = $_POST['cityname'];
    } else {
        $id = $_POST['universityname'];
    }

    // --- Handle multiple image uploads ---
    $uploadedImages = [];
    if (!empty($_FILES['himages']['name'][0])) {  // check at least 1 file uploaded
        foreach ($_FILES['himages']['name'] as $key => $val) {
            if (!empty($val)) {
                $filename = time() . "_" . basename($val);
                $targetPath = "../uploads/" . $filename;
                if (move_uploaded_file($_FILES['himages']['tmp_name'][$key], $targetPath)) {
                    $uploadedImages[] = $filename;
                }
            }
        }
    }

    // Convert array to comma-separated string
    $imagesString = implode(",", $uploadedImages);

    // --- Check if house already exists ---
    $sqlquery = "SELECT * FROM tbl_housedetails WHERE house_name='$hname'";
    $result   = $obj->executequery($sqlquery);
    $rows     = mysqli_num_rows($result);

    if ($rows == 1) {
        echo "<script>alert('Already Exist!!');window.location='houseregistration.php'</script>";
    } else {
        $sqlquery1 = "INSERT INTO tbl_housedetails
        (house_name, housedescription, noofperson, rate, himage, owner_id, status, house_type, id) 
        VALUES 
        ('$hname','$description','$noofperson','$rate','$imagesString','$ownerid','Available','$type','$id')";

        $result1 = $obj->executequery($sqlquery1);

        if ($result1 == 1) {
            echo "<script>alert('Registration Successfully!!');window.location='houseview.php'</script>";
        } else {
            echo "<script>alert('Registration Failed!!');window.location='houseview.php'</script>";
        }
    }
}
?>
