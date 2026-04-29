
<?php
include_once("../dboperation.php");
$obj = new dboperation();


if (isset($_POST["locationid"])) {
    $location_id = $_POST["locationid"];

    
    $sql = "SELECT * FROM tbl_city WHERE location_id='$location_id'";
    $result = $obj->executequery($sql);

    
        echo '<option value="">---Select City---</option>';
        while($row = mysqli_fetch_array($result)) {
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    } 

?>
