<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["locationid"])) {
  $locid=$_GET["locationid"];

   $sql="SELECT * from tbl_location where location_id=$locid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);
   
  $sql="DELETE from tbl_location where location_id=$locid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='locationview.php'</script>";

?>