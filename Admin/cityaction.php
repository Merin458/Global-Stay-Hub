<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $locationname=$_POST['locationname'];
    $cityname=$_POST['cityname'];   
  
    $sqlquery="SELECT * FROM tbl_city where city_name='$cityname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='city.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_city (city_name,location_id) VALUES('$cityname','$locationname')";

        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          echo "<script>alert('Registration Succesfully!!');window.location='cityview.php'</script>";
    
        }
        else
        {
        echo "<script>alert('Registration Failed!!');window.location='location.php'</script>";
}
}
}
?>