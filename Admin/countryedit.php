<?php
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();

// Get country id from URL
if(!isset($_GET['id'])){
    echo "<script>alert('No country selected!'); window.location.href='countryview.php';</script>";
    exit;
}

$country_id = $_GET['id'];

// Fetch country data
$result = $obj->executequery("SELECT * FROM tbl_country WHERE country_id='$country_id'");
if(mysqli_num_rows($result) == 0){
    echo "<script>alert('Country not found!'); window.location.href='countryview.php';</script>";
    exit;
}

$country = mysqli_fetch_assoc($result);

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $country_name = $_POST['country_name'];

    // Handle flag upload
    if(isset($_FILES['country_flag']) && $_FILES['country_flag']['name'] != ""){
        $file_name = time().'_'.$_FILES['country_flag']['name'];
        $file_tmp = $_FILES['country_flag']['tmp_name'];
        $target = "../Uploads/".$file_name;
        move_uploaded_file($file_tmp, $target);

        // Update with new flag
        $sql = "UPDATE tbl_country SET country_name='$country_name', country_flag='$file_name' WHERE country_id='$country_id'";
    } else {
        // Update only name
        $sql = "UPDATE tbl_country SET country_name='$country_name' WHERE country_id='$country_id'";
    }

    $obj->executequery($sql);
    echo "<script>alert('Country updated successfully!'); window.location.href='countryview.php';</script>";
    exit;
}
?>

<div class="container" style="margin-top:50px; max-width:600px;">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="mb-4">Edit Country</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-semibold">Country Name</label>
                <input type="text" name="country_name" class="form-control" value="<?php echo $country['country_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Country Flag</label><br>
                <img src="../Uploads/<?php echo $country['country_flag']; ?>" alt="flag" style="width:80px; height:55px; object-fit:cover; border-radius:6px; margin-bottom:10px;"><br>
                <input type="file" name="country_flag" class="form-control">
                <small class="text-muted">Upload a new flag to replace the existing one.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="countryview.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Country</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
