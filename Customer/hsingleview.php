<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_GET['house_id'])) {
    $house_id = $_GET['house_id'];

    $sql = "SELECT 
            h.house_id,
            h.house_name AS property_name, 
            h.housedescription, 
            h.noofperson, 
            h.rate, 
            h.house_type, 
            h.himage,
            h.status,
            o.owner_name, 
            o.house_name AS owner_house_name, 
            o.email, 
            o.owner_image,
            o.pincode,
            o.phone
        FROM tbl_housedetails h 
        INNER JOIN tbl_houseowner o ON h.owner_id = o.owner_id 
        WHERE h.house_id = '$house_id'";

    $result = $obj->executequery($sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>House Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .carousel-inner img {
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.6s ease-in-out;
        }
        .carousel-inner img:hover {
            transform: scale(1.05);
        }
        .house-details, .owner-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            background: #fff;
            padding: 25px;
            margin-top: 20px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
        }
        .house-details:hover, .owner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
        }
        .owner-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #007bff;
        }
        .btn-book {
            margin-top: 15px;
            width: 100%;
            font-size: 18px;
            padding: 12px;
            font-weight: bold;
            border-radius: 8px;
        }
        .sold-badge {
            display: inline-block;
            background-color: red;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        /* Back Button */
        .back-btn {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background: #5a6268;
            color: white;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <?php if (!empty($row)) { ?>
        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <div class="row g-4">
            <!-- Left: House Info -->
            <div class="col-md-8">

                <!-- House Images Carousel -->
                <div id="houseCarousel" class="carousel slide shadow rounded overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php 
                        if (!empty($row['himage'])) {
                            $images = explode(",", $row['himage']);
                            $active = "active";
                            foreach ($images as $img) {
                                if (!empty($img)) {
                                    echo "
                                    <div class='carousel-item $active'>
                                        <img src='../uploads/$img' class='d-block w-100' alt='House Image'>
                                    </div>";
                                    $active = "";
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#houseCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#houseCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <?php 
                        if (!empty($images)) {
                            foreach ($images as $index => $img) {
                                $active = $index === 0 ? "active" : "";
                                echo "<button type='button' data-bs-target='#houseCarousel' data-bs-slide-to='$index' class='$active'></button>";
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- House Details -->
                <div class="house-details">
                    <?php if(strtolower($row['status']) == 'sold out') { ?>
                        <div class="sold-badge">Sold Out</div>
                    <?php } ?>

                    <h2><?php echo $row['property_name']; ?></h2>
                    <p><i class="fa-solid fa-align-left text-primary"></i> <strong>Description:</strong> <?php echo $row['housedescription']; ?></p>
                    <p><i class="fa-solid fa-house text-success"></i> <strong>Type:</strong> <?php echo ucfirst($row['house_type']); ?></p>
                    <p><i class="fa-solid fa-users text-warning"></i> <strong>No. of Persons:</strong> <?php echo $row['noofperson']; ?></p>
                    <p><i class="fa-solid fa-dollar-sign text-danger"></i> <strong>Rate:</strong> $<?php echo $row['rate']; ?></p>
                    <p><i class="fa-solid fa-circle-info text-secondary"></i> <strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>

                    <?php if(strtolower($row['status']) == 'sold out') { ?>
                        <button class="btn btn-secondary btn-book" disabled>
                            <i class="fa-solid fa-calendar-check"></i> Sold Out
                        </button>
                    <?php } else { ?>
                        <a href="booking.php?house_id=<?php echo $row['house_id']; ?>&noofperson=<?php echo $row['noofperson'];?>" class="btn btn-primary btn-book">
                            <i class="fa-solid fa-calendar-check"></i> Book Now
                        </a>
                    <?php } ?>

                    <a href="house_gallery.php?hid=<?php echo $row['house_id']; ?>" class="btn btn-outline-dark btn-book">
                        <i class="fa-solid fa-images"></i> View Gallery
                    </a>
                </div>
            </div>

            <!-- Right: Owner Info -->
            <div class="col-md-4">
                <div class="owner-card text-center">
                    <?php if (!empty($row['owner_image'])) { ?>
                        <img src="../uploads/<?php echo $row['owner_image']; ?>" alt="Owner Image">
                    <?php } else { ?>
                        <img src="https://via.placeholder.com/120" alt="Owner Image">
                    <?php } ?>
                    <h4><?php echo $row['owner_name']; ?></h4>
                    <p><i class="fa-solid fa-map-marker-alt text-danger"></i> <strong>Address:</strong> <?php echo $row['owner_house_name']; ?></p>
                    <p><i class="fa-solid fa-map-pin text-success"></i> <strong>Pin Code:</strong> <?php echo $row['pincode']; ?></p>
                    <p><i class="fa-solid fa-phone text-primary"></i> <strong>Phone:</strong> <a href="tel:<?php echo $row['phone']; ?>"><?php echo $row['phone']; ?></a></p>
                    <p><i class="fa-solid fa-envelope text-warning"></i> <strong>Email:</strong> <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger">House details not found.</div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
