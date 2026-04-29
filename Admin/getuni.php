<?php
if (isset($_POST["cityid"])) {
    $cityid = $_POST["cityid"];

    include_once("../dboperation.php");
    // Correct table name spelling if needed: tbl_university
    $sql = "SELECT * FROM tbl_university WHERE city_id = $cityid";
    $obj = new dboperation();
    $result = $obj->executequery($sql);
    $s = 1;

    // Output table rows if universities exist
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $s++; ?></td>
            <td><?php echo $row["university_name"]; ?></td>
            <td>
                <a href="universityedit.php?uniid=<?php echo $row["university_id"]; ?>" class="btn btn-primary">Edit</a>
                <a href="universitydelete.php?uniid=<?php echo $row["university_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php
    }
    // If no universities found, show a message
    if (mysqli_num_rows($result) == 0) {
        ?>
        <tr>
            <td colspan="3" style="text-align:center;">No universities found for this city.</td>
        </tr>
        <?php
    }
}
?>