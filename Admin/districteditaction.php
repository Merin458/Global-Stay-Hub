<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['district_id'];
    $District_name=$_POST['districtname'];
    if($id=='')
    {
    $sql1="UPDATE tbl_district set district_name='$District_name'where district_id=$id";
    $result=$obj->executequery($sql1);
    }
    else
    {
        $sql="UPDATE tbl_district set district_name='$District_name' where district_id=$id";
    $result=$obj->executequery($sql);
    }
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='districtview.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='districtview.php' </script>";
    }
}
?>