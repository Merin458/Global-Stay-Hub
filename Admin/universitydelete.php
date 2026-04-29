<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["uniid"])) {
  $universityid=$_GET["uniid"];

   $sql="SELECT * from tbl_university where university_id=$universityid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);
   
  $sql="DELETE from tbl_university where university_id=$universityid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='universityview.php'</script>";

?>
