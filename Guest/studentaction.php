<?php
include_once("../dboperation.php");
$obj = new dboperation();

$name = $_POST['sname'];
$country = $_POST['countryname'];
$location = $_POST['locationname'];
$city = $_POST['cityname'];
$pin = $_POST['pin'];
$phoneno = $_POST['phone'];
$email = $_POST['mail'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$idproof = $_FILES['idproof']['name'];
$simage = $_FILES['simage']['name'];
$gender = $_POST['gender'];

// Automatically get current date
$regdate = date('Y-m-d');

move_uploaded_file($_FILES['idproof']['tmp_name'], '../uploads/' . $idproof);
move_uploaded_file($_FILES['simage']['tmp_name'], '../uploads/' . $simage);

$sql = "SELECT * FROM tbl_student WHERE student_name='$name'";
$res = $obj->executequery($sql);
$rows = mysqli_num_rows($res);

if ($rows > 0) {
    echo "<script>alert('Already Exists');window.location='student.php'</script>";
} else {
    $sql = "INSERT INTO tbl_student (student_name, gender, simage, id_proof, city_id, regdate, contact, email, status, username, password)
            VALUES ('$name', '$gender', '$simage', '$idproof', '$city', '$regdate', '$phoneno', '$email', 'requested', '$uname', '$pass')";
    $result = $obj->executequery($sql);

    if ($result) {
        echo "<script>alert('Details Added successfully!');window.location='login.php'</script>";

        $bodyContent = "Dear $uname,

Welcome to Global Stay Hub!

You’ve successfully registered your account. Explore available accommodations, connect with trusted house owners, and manage your stays with ease.

If this wasn’t you, please reset your password immediately or contact our support team.

Warm regards,  
The Global Stay Hub Team
";

        $mailtoaddress = $email;
        require('../phpmailer.php');

    } else {
        echo "<script>alert('Cannot add Details!');window.location='student.php'</script>";
    }
}
?>
