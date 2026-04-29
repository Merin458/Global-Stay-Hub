<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["districtid"])) {
  $did=$_GET["districtid"];

   $sql="SELECT * from tbl_district where district_id=$did";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);
   
  $sql="DELETE from tbl_district where district_id=$did";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='districtview.php'</script>";
2
?>
