<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['university_id'];
    $University_name=$_POST['universityname'];
    if($id=='')
    {
    $sql1="UPDATE tbl_university set university_name='$University_name'where university_id=$id";
    $result=$obj->executequery($sql1);
    }
    else
    {
        $sql="UPDATE tbl_university set university_name='$University_name' where university_id=$id";
    $result=$obj->executequery($sql);
    }
    if ($result == 1){
     echo "<script>alert('Saved Succesfully');window.location='universityview.php' </script>";
    }
    else{
     echo "<script>alert('Registration failed');window.location='unioversityview.php' </script>";
    }
}
?>