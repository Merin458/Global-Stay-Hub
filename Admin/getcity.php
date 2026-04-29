<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["locationid"])) {
	$city_id = $_POST["locationid"];

	// You can replace this code with a database query to retrieve the states for the selected country
	echo $sql = "select * from tbl_city where location_id=$city_id";
	$result = $obj->executequery($sql);
	$s = 1;
	?>
	<?php
	while($row=mysqli_fetch_array($result))
	{
		?>
<tr>
        <td><?php echo $s++; ?></td>
        <td><?php echo $row["city_name"]; ?></td>
       <td>
          <a href="cityedit.php?locationid=<?php echo $row["city_id"];?>" class="btn btn-primary">Edit</a>
          <a href="citydelete.php?locationid=<?php echo $row["city_id"];?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
        
      </tr>
      
      
	<?php
	}	
}
?>