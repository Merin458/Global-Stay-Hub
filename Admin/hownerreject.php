<?php
include_once("../dboperation.php");
$obj = new dboperation();

$id = $_GET['owner_id'];
if ($id == '') {
    echo "<script>alert('Invalid Owner ID');window.location='houseownerview.php'</script>";
    exit;
}

$sql = "UPDATE tbl_houseowner SET status='Rejected' WHERE owner_id=$id";
$result = $obj->executequery($sql);

if ($result == 1) {
    echo "<script>alert('Rejected Successfully');window.location='houseownerview.php'</script>";
} else {
    echo "<script>alert('Something Went Wrong');window.location='houseownerview.php'</script>";
}
?>