<?php
include("../dboperation.php");
$obj=new dboperation();

if(isset($_GET["category_id"])) {
  $catid=$_GET["category_id"];

   $sql="select * from tbl_category where category_id=$catid";
  $res=$obj->executequery($sql);
  $display=mysqli_fetch_array($res);


  // Store the image filenames in an array
  $imageFiles = ["../uploads/" . $display["category_image"]];


   // Delete each image file from the array
  foreach ($imageFiles as $file) 
  {
    if (file_exists($file)) {
        unlink($file);
    }
  }
  
  $sql="delete from tbl_category where category_id=$catid";
  $res=$obj->executequery($sql);
 
  
  }

  echo "<script>alert('Deleted Successfully!!');window.location='category_view.php'</script>";

?>