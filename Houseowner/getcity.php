<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["locationid"])) {
	$locid = $_POST["locationid"];

	// You can replace this code with a database query to retrieve the states for the selected country
	echo $sql = "select * from tbl_city where location_id=$locid";
	$result = $obj->executequery($sql);
	$s = 1;
	?>
	<option value="">---SELECT CITY---</option>

	<?php
	while ($row = mysqli_fetch_array($result)) {
		?>
		

		<option value="<?php echo $row["city_id"]; ?>"><?php echo $row["city_name"]; ?></option>


		<?php
	}
}
?>