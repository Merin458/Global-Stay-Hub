<?php
session_start();
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();

if (!isset($_GET['house_id'])) {
    echo "<script>alert('House not specified!');window.location='houseview.php'</script>";
    exit;
}

$house_id = $_GET['house_id'];
$sql = "SELECT house_name, himage FROM tbl_housedetails WHERE house_id='$house_id'";
$res = $obj->executequery($sql);
$house = mysqli_fetch_array($res);

$images = explode(',', $house['himage']);
?>

<div class="container mt-5">
    <div class="card shadow-sm p-4" style="background-color: #f0f0f0; border: none;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0" style="color: #333;"><?php echo $house['house_name']; ?> - Gallery</h3>
            <a href="houseregistration.php" class="btn btn-outline-dark rounded-pill px-4 py-2">
                ← Back
            </a>
        </div>

        <!-- Gallery -->
        <div class="gallery">
            <?php foreach ($images as $img) { 
                $img = trim($img);
                if (!empty($img)) { ?>
                    <div class="gallery-item">
                        <img src="../uploads/<?php echo $img; ?>" alt="House Image">
                    </div>
            <?php } } ?>
        </div>
    </div>
</div>

<style>
body {
    background-color: #e9ecef; /* Light gray page background */
}

/* Masonry-style gallery */
.gallery {
    column-count: 4;
    column-gap: 15px;
}

.gallery-item {
    break-inside: avoid;
    margin-bottom: 15px;
    overflow: hidden;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.gallery-item img {
    width: 100%;
    display: block;
    object-fit: cover;
    transition: transform 0.3s ease-in-out;
}

.gallery-item img:hover {
    transform: scale(1.08);
}

/* Responsive adjustments */
@media (max-width: 1200px) { .gallery { column-count: 3; } }
@media (max-width: 768px) { .gallery { column-count: 2; } }
@media (max-width: 480px) { .gallery { column-count: 1; } }

/* Button hover style */
.btn-outline-dark:hover {
    background-color: #343a40;
    color: #fff;
    transition: 0.3s;
}
</style>

<?php include('footer.php'); ?>
