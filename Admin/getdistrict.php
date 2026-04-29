<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["locationid"])) {
	$districtid = $_POST["locationid"];

	// You can replace this code with a database query to retrieve the states for the selected country
	echo $sql = "select * from tbl_district where location_id=$districtid";
	$result = $obj->executequery($sql);
	$s = 1;
	?>
<option value="">--Select District--</option>
	<?php
while($row=mysqli_fetch_array($result))
{
?>


<option value="<?php echo $row["district_id"]; ?>"><?php echo $row["district_name"]; ?></option>
      
      
      
      <?php
}
	}
?>