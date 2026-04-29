<?php
include_once("../dboperation.php");
$obj = new dboperation();

$id = $_GET['owner_id'];
if ($id == '') {
    echo "<script>alert('Invalid Owner ID');window.location='houseownerview.php'</script>";
    exit;
}

// 1️⃣ Fetch owner details to send email
$sql = "SELECT owner_name, email FROM tbl_houseowner WHERE owner_id = $id";
$res = $obj->executequery($sql);
$data = mysqli_fetch_assoc($res);

$owner_name = $data['owner_name'];
$email = $data['email'];

// 2️⃣ Update status to Accepted
$sql2 = "UPDATE tbl_houseowner SET status='Accepted' WHERE owner_id=$id";
$result = $obj->executequery($sql2);

if ($result == 1) {

    // 3️⃣ Email Body
    $subject = "Your Account Has Been Approved - Global Stay Hub";
    $message = "
    Dear $owner_name,

    Congratulations! Your House Owner account has been approved by the admin.

    You can now log in and start adding your accommodation details.

    Warm regards,
    Global Stay Hub Team
    ";

    // 4️⃣ Send Email
    require('../phpmailer.php');

    mail($email, $subject, $message);

    // 5️⃣ Redirect AFTER sending mail
    echo "<script>alert('Accepted Successfully');window.location='houseownerview.php'</script>";

} else {
    echo "<script>alert('Something Went Wrong');window.location='houseownerview.php'</script>";
}
?>
