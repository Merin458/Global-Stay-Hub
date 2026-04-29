<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["countryid"])) {
	$countryid = $_POST["countryid"];

	// You can replace this code with a database query to retrieve the states for the selected country
	echo $sql = "select * from tbl_location where country_id=$countryid";
	$result = $obj->executequery($sql);
	$s = 1;
	?>
	<option value="">---SELECT STATE---</option>

	<?php
	while ($row = mysqli_fetch_array($result)) {
		?>
		

		<option value="<?php echo $row["location_id"]; ?>"><?php echo $row["location_name"]; ?></option>


		<?php
	}
}
?>