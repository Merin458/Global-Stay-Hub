<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $cname=$_POST['countryname'];
    $lname=$_POST['locationname'];
    $cityname=$_POST['cityname'];
    $uname=$_POST['universityname'];
    


  
    $sqlquery="SELECT * FROM tbl_university where city_id='$cityname' AND university_name='$uname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='university.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_university (city_id,university_name) VALUES('$cityname','$uname')";

        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          echo "<script>alert('Registration Succesfully!!');window.location='university.php'</script>";
    
        }
        else
        {
        echo "<script>alert('Registration Failed!!');window.location='university.php'</script>";
}
}
}
?>