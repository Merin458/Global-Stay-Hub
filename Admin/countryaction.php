<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$n=$_POST['countryname'];
$photo=$_FILES['flag']['name'];
move_uploaded_file($_FILES['flag']['tmp_name'], '../uploads/' .$photo);
$sql= "select * from  tbl_country where country_name='$n'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Country Already Exists');window.location='country.php'</script>";
}else{
       $sql="INSERT INTO tbl_country (country_name,country_flag) VALUES('$n','$photo')";
    $result=$obj->executequery($sql);
    
    if($result==1){
       echo "<script>alert('Country Name Added successfully!');window.location='country.php' </script>";
}

else{
     echo "<script>alert('Cannot add Your Country!');window.location='country.php' </script";
}

}
}
?>