<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["cityid"])) {
	$cityid = $_POST["cityid"];

	// You can replace this code with a database query to retrieve the states for the selected country
	echo $sql = "select * from tbl_university where city_id=$cityid";
	$result = $obj->executequery($sql);
	$s = 1;
	?>
	<option value="">--SELECT--</option>

	<?php
	while ($row = mysqli_fetch_array($result)) {
		?>
		

		<option value="<?php echo $row["university_id"]; ?>"><?php echo $row["university_name"]; ?></option>


		<?php
	}
}
?>