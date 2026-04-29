<?php
include_once("../dboperation.php");
$obj=new dboperation();
if(isset($_POST['submit']))
{
$n=$_POST['categoryname'];
// $image=$_FILES['Category_image']['name'];
// move_uploaded_file($_FILES['Category_image']["tmp_name"],"../uploads/".$image);
$d=$_POST['category_description'];
$photo=$_FILES['photo']['name'];
move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/' .$photo);
$sql= "select * from  tbl_category where category_name='$n'";
$res=$obj-> executequery($sql);
$rows=mysqli_num_rows($res);
if($rows > 0){
     echo"<script>alert('Already Exists');window.location='category.php'</script>";
}else{
       $sql="INSERT INTO tbl_category (category_name,category_description,category_image) VALUES('$n','$d','$photo')";
    $result=$obj->executequery($sql);
    
    if($result==1){
       echo "<script>alert('Description Added successfully!');window.location='category.php' </script>";
}

else{
     echo "<script>alert('Cannot add Description!');window.location='category.php' </script";
}

}
}
?>