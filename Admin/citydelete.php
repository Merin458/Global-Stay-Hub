<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["cityid"])) {
  $locid=$_GET["cityid"];

   $sql="SELECT * from tbl_city where city_id=$locid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);
   
  $sql="DELETE from tbl_city where city_id=$locid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='cityview.php'</script>";

?>