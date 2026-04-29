<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["house_id"])) {
  $houseid=$_GET["house_id"];

   $sql="SELECT * from tbl_housedetails where house_id=$houseid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);
   
  $sql="DELETE from tbl_housedetails where house_id=$houseid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='houseview.php'</script>";

?>
