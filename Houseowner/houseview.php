<?php
session_start();
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();
$s = 1;
$ownerid = $_SESSION["Login_id"];
$sql = "SELECT * FROM tbl_housedetails WHERE owner_id='$ownerid'";
$res = $obj->executequery($sql);
?>

<style>
/* 🔹 Table Styling */
.table {
    border-collapse: collapse !important;
    width: 100%;
}

.table th, .table td {
    border: 1px solid #dee2e6 !important;
    padding: 12px;
    vertical-align: middle;
}

.table thead th {
    background-color: #f8f9fa;
    font-weight: 600;
    text-align: center;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* 🔹 Thumbnail styling */
.img-thumb {
    width: 100px;
    height: 70px;
    border-radius: 6px;
    object-fit: cover;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* 🔹 Back Button Styling */
.back-btn {
    display: inline-block;
    background-color: #6c757d; /* Grayish tone */
    color: white;
    padding: 10px 22px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}
.back-btn:hover {
    background-color: #5a6268;
    text-decoration: none;
    color: white;
    transform: translateY(-1px);
}
</style>

<div class="wrapper" style="display: flex; flex-direction: column; min-height: 100vh;">

    <div class="content" style="flex: 1;">
        <div class="container-fluid" style="margin-top: 70px;">
            <div class="row">
                <div class="col-md-12">

                    <!-- 🔹 Back Button -->
                    <div class="mb-3">
                        <a href="houseregistration.php" class="back-btn">⬅ Back</a>
                    </div>

                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h3 class="mb-0">🏠 Your House Details</h3>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="data_table" class="table table-bordered table-hover text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>House Name</th>
                                        <th>Description</th>
                                        <th>No Of Persons</th>
                                        <th>Rate ($)</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($display = mysqli_fetch_array($res)) { ?>
                                        <tr>
                                            <td><?php echo $s++; ?></td>
                                            <td><?php echo $display["house_name"]; ?></td>
                                            <td style="text-align: left;"><?php echo $display["housedescription"]; ?></td>
                                            <td><?php echo $display["noofperson"]; ?></td>
                                            <td>$<?php echo number_format($display["rate"]); ?></td>
                                            <td>
                                                <?php 
                                                    $images = explode(',', $display["himage"]);
                                                    $firstImage = trim($images[0]);
                                                    if (!empty($firstImage)) {
                                                        echo '<img src="../uploads/' . $firstImage . '" class="img-thumb">';
                                                    } else {
                                                        echo '<span>No Image</span>';
                                                    }
                                                ?>
                                                <br>
                                                <a href="housegallery.php?house_id=<?php echo $display['house_id']; ?>" 
                                                   class="btn btn-sm btn-info mt-2">View More</a>
                                            </td>
                                            <td><?php echo $display["house_type"]; ?></td>
                                            <td>
                                                <a href="houseedit.php?house_id=<?php echo $display['house_id']; ?>" 
                                                   class="btn btn-sm btn-primary" 
                                                   onclick="return confirm('Are you sure want to edit?');">
                                                   ✏️ Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a href="housedelete.php?house_id=<?php echo $display['house_id']; ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure want to delete?');">
                                                   🗑️ Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>

    <?php include('footer.php'); ?>

</div>
