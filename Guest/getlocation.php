<?php
	if(isset($_POST["countryid"])) 
	{
		$countryid= $_POST["countryid"];

		// You can replace this code with a database query to retrieve the states for the selected country
		include_once("../dboperation.php");
       $sql="select * from tbl_location where country_id=$countryid";
        $obj=new dboperation();
        $result=$obj->executequery($sql);
        $s=1;
?>

<?php
while($row=mysqli_fetch_array($result))
{
?>


<tr>
        <td><?php echo $s++; ?></td>
        <td><?php echo $row["location_name"]; ?></td>
       <td>
          <a href="locationedit.php?locationid=<?php echo $row["location_id"];?>" class="btn btn-primary">Edit</a>
          <a href="locationdelete.php?locationid=<?php echo $row["location_id"];?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
        
      </tr>
      
      
      
      <?php
}
	}
?>

		
	

