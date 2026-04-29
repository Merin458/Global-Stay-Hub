<?php
function generateRandomString($length = 10) 
{
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $randomString = substr(str_shuffle($characters), 0, $length);

   return $randomString;
}
?>

<?php
include_once("../dboperation.php");
$obj=new dboperation();
$uname=$_POST["txtusername"];


$sql="select * from tbl_student where username='$uname'";
$result=$obj->executequery($sql);
$display=mysqli_fetch_array($result);
$row=mysqli_num_rows($result);
$sql1="select * from tbl_houseowner where username='$uname'";
$result1=$obj->executequery($sql1);
$display1=mysqli_fetch_array($result1);
$row1=mysqli_num_rows($result1);

if($row == 0 && $row1 == 0) 
{
     echo "<script>alert('Entered username is wrong....');window.location='forgotpw.php' </script>"; 
}

else
{
    if ($row > 0) {
        $randomString = generateRandomString();
        $sql2 = "update tbl_student set password='$randomString' where username='$uname'";
        $result = $obj->executequery($sql2);
        $bodyContent = "Dear $uname, Your New Password is: $randomString";
        $mailtoaddress = $display["email"];
        require('../phpmailer.php');
    } 

   
    else if ($row1 > 0) {
        $randomString = generateRandomString();
      $sql3 = "update tbl_houseowner set pw='$randomString' where username='$uname'";
        $result = $obj->executequery($sql3);
        //   echo "<script>alert('Your password has been successfully reset. A new password has been sent to your email. Please check your inbox.');window.location='Login.php' </script>";
        $bodyContent = "Dear $uname, Your New Password is: $randomString";
        $mailtoaddress = $display1["email"];
        require('../phpmailer.php');
    }

    //   echo "<script>window.location='Login.php'</script>";
}
?>