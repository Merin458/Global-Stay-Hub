<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['city_id'];
    $city_name=$_POST['cityname'];
    if($id=='')
    {
    $sql1="UPDATE tbl_city set city_name='$city_name'where city_id=$id";
    $result=$obj->executequery($sql1);
    }
    else
    {
        $sql="UPDATE tbl_city set city_name='$city_name' where city_id=$id";
    $result=$obj->executequery($sql);
    }
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='cityview.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='cityview.php' </script>";
    }
}
?>