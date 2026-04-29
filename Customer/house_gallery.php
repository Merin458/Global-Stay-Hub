<?php
include_once("../dboperation.php");
$obj = new dboperation();

// sanitize incoming id
$house_id = isset($_GET['hid']) ? intval($_GET['hid']) : null;

$images = [];
$house_name = "Gallery";
$error = "";

if ($house_id) {
    $sql = "SELECT himage, house_name FROM tbl_housedetails WHERE house_id='$house_id' LIMIT 1";
    $result = $obj->executequery($sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $house_name = !empty($row['house_name']) ? $row['house_name'] : $house_name;

        if (!empty($row['himage'])) {
            // split, trim and remove empty entries
            $images = array_filter(array_map('trim', explode(",", $row['himage'])));
        }
    } else {
        $error = "House not found.";
    }
} else {
    $error = "No house selected.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($house_name); ?> - Gallery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <style>
        body { background-color: #f7f7f8; }
        .gallery-container { margin-top: 30px; }
        .gallery-item {
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 26px rgba(0,0,0,0.15);
        }
        .gallery-item:hover img { transform: scale(1.08); }
    </style>
</head>
<body>

<div class="container gallery-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fa-solid fa-images text-primary"></i>
            &nbsp; <?php echo htmlspecialchars(ucfirst($house_name)); ?> - Gallery
        </h2>
        <div>
            <!-- Back to house details (if we have house_id) or home -->
            <?php if ($house_id) : ?>
                <a href="hsingleview.php?house_id=<?php echo $house_id; ?>" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Back to Details
                </a>
            <?php else: ?>
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <?php
        if (!empty($images)) {
            foreach ($images as $img) {
                // safety: skip if file name empty
                if (empty($img)) continue;

                // escape file name for output (but keep path)
                $img_esc = htmlspecialchars($img);
                $img_path = "../uploads/" . $img_esc;

                echo "
                <div class='col-lg-4 col-md-6'>
                    <div class='gallery-item'>
                        <a href='{$img_path}' data-lightbox='house-gallery' data-title='" . htmlspecialchars($house_name) . "'>
                            <img src='{$img_path}' alt='House Image'>
                        </a>
                    </div>
                </div>";
            }
        } else {
            if (empty($error)) {
                echo "<div class='col-12'><div class='alert alert-info'>No images available for this property.</div></div>";
            }
        }
        ?>
    </div>

    <div class="text-center mt-4">
        <?php if ($house_id): ?>
            <a href="searchhouse.php" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to Home
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

</body>
</html>
