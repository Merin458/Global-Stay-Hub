<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();
$username = $_POST["username"];
$password = $_POST["password"];


$sqlquery = "select * from tbl_adminlogin where username='$username' and password='$password'";
$result= $obj->executequery($sqlquery);
if (mysqli_num_rows($result) == 1) {
   $row = mysqli_fetch_array($result);
   $_SESSION["User_Name"] = $username;
   $_SESSION["Login_id"] = $row["loginid"];


   header("location:..\Admin\adminindex.php");
}
$sqlquery1 = "select * from tbl_houseowner where username='$username' and status='Accepted' and pw='$password'";
$result1 = $obj->executequery($sqlquery1);
if (mysqli_num_rows($result1) == 1) {
      $row1 = mysqli_fetch_array($result1);
      $_SESSION["User_Name"] = $username;
      $_SESSION["Login_id"] = $row1["owner_id"];
      header("location:..\Houseowner\houseregistration.php");
   } 

   $sqlquery1 = "select * from tbl_student where username='$username' and status='requested' and password='$password'";
$result1 = $obj->executequery($sqlquery1);
if (mysqli_num_rows($result1) == 1) {
      $row1 = mysqli_fetch_array($result1);
      $_SESSION["User_Name"] = $username;
      $_SESSION["Login_id"] = $row1["student_id"];
      header("location:..\Customer\searchhouse.php");
   } 
   // else {
      // Uncomment the following lines if you want to handle invalid login attempts
      // if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result1) == 0) {


else {
   
         // Invalid login, display an error message
         echo "<script>alert('Invalid Username/Password!!'); window.location='login.php'</script>";
      }
   // }

?>
