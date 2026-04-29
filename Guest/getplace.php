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
		<option value="">---Select State---</option>

<?php
while($row=mysqli_fetch_array($result))
{
?>

<option value="<?php echo $row["location_id"]; ?>"><?php echo $row["location_name"]; ?></option>
      
      
      <?php
}
	}
?>

		
	

