<?php
include_once("../dboperation.php");
$obj = new dboperation();

$name = $_POST['honame'];
$hname = $_POST['hname'];
$country = $_POST['countryname'];
$location = $_POST['locationname'];
$city = $_POST['cityname'];
$pin = $_POST['pin'];
$phoneno = $_POST['phone'];
$email = $_POST['mail'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];

$idproof = $_FILES['idproof']['name'];
$himage = $_FILES['himage']['name'];

// Upload files
move_uploaded_file($_FILES['idproof']['tmp_name'], '../uploads/' . $idproof);
move_uploaded_file($_FILES['himage']['tmp_name'], '../uploads/' . $himage);

// AUTO registration date (today)
$regdate = date("Y-m-d");

// Check if owner already exists
$sql = "SELECT * FROM tbl_houseowner WHERE owner_name='$name'";
$res = $obj->executequery($sql);
$rows = mysqli_num_rows($res);

if ($rows > 0) {
    echo "<script>alert('Owner already exists!');window.location='houseowner.php'</script>";
} else {

    $sql = "INSERT INTO tbl_houseowner 
            (owner_name, house_name, city_id, pincode, idproof, phone, email, owner_image, reg_date, username, pw, status) 
            VALUES 
            ('$name', '$hname', '$city', '$pin', '$idproof', '$phoneno', '$email', '$himage', '$regdate', '$uname', '$pass', 'requested')";

    $result = $obj->executequery($sql);

    if ($result) {
        echo "<script>alert('Details Added Successfully!');window.location='waiting.php'</script>";
    } else {
        echo "<script>alert('Failed to Add Details!');window.location='houseowner.php'</script>";
    }
}

?>
