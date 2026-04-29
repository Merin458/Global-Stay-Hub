
<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $locationname=$_POST['locationname'];
    $districtname=$_POST['districtname'];   
  
 $sqlquery="SELECT * FROM tbl_district where district_name='$districtname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='district.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_district (district_name,location_id) VALUES('$districtname','$locationname')";

        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
        echo "<script>alert('Registration Succesfully!!');window.location='district.php'</script>";
    
        }
        else
        {
         echo "<script>alert('Registration Failed!!');window.location='district.php'</script>";
}
}
}
?>