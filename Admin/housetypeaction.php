<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$n=$_POST['housetypename'];
$sql= "select * from  tbl_housetype where house_type='$n'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Already Exists');window.location='housetype.php'</script>";
}else{
       $sql="INSERT INTO tbl_housetype (house_type) VALUES('$n')";
    $result=$obj->executequery($sql);
    
    if($result==1){
       echo "<script>alert('House Type Added successfully!');window.location='housetype.php' </script>";
}

else{
     echo "<script>alert('Cannot add this Housetype');window.location='housetype.php' </script";
}

}
}
?>