<?php
require_once("../dboperation.php");
$obj = new dboperation();
$id = $_POST["id"];
$type = $_POST['type'];

// Fetch all houses regardless of status
$sqlquery1 = "SELECT 
    h.house_id,
    h.house_name AS property_name,
    h.housedescription,
    h.himage,
    h.rate,
    h.status,
    o.owner_id,
    o.owner_name,
    o.house_name AS owner_address
FROM tbl_housedetails h
INNER JOIN tbl_houseowner o ON o.owner_id = h.owner_id
WHERE h.house_type='$type' 
AND h.id='$id'";
$result1 = $obj->executequery($sqlquery1);
?>

<div class="container my-5">
    <div class="row">
        <?php while ($display = mysqli_fetch_array($result1)) { 
            $images = explode(',', $display['himage']);
            $first_img = trim($images[0]);

            // Determine badge color and button type based on status
            $status = strtolower(trim($display['status']));
            if($status == 'sold out') {
                $badge_class = 'bg-danger';
                $badge_text = 'Sold Out';
                $is_sold_out = true;
            } else {
                $badge_class = 'bg-success';
                $badge_text = 'Available';
                $is_sold_out = false;
            }
        ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 h-100" style="transition:0.3s; border-radius:15px; overflow:hidden;">
                
                <div class="position-relative">
                    <!-- Property Image -->
                    <?php if ($first_img) { ?>
                        <img src="../Uploads/<?php echo $first_img; ?>" class="card-img-top" alt="Property Image" style="height:250px; object-fit:cover;">
                    <?php } else { ?>
                        <img src="../Uploads/default.jpg" class="card-img-top" alt="Property Image" style="height:250px; object-fit:cover;">
                    <?php } ?>

                    <!-- Status Badge -->
                    <span class="badge <?php echo $badge_class; ?> position-absolute top-0 start-0 m-3 p-2 px-3" style="font-size:14px; border-radius:20px;">
                        <?php echo $badge_text; ?>
                    </span>
                    
                    <!-- Rate Badge -->
                    <span class="badge bg-primary position-absolute bottom-0 end-0 m-3 p-2 px-3" style="font-size:14px; border-radius:20px;">
                        $<?php echo number_format($display['rate']); ?>
                    </span>
                </div>

                <!-- Property Content -->
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold"><?php echo $display['property_name']?></h5>
                    <p class="text-muted mb-3"><?php echo substr($display['housedescription'], 0, 80) . '...'; ?></p>
                    
                    <!-- Button: View More or Sold Out -->
                    <?php if ($is_sold_out) { ?>
                        <button class="btn btn-outline-secondary rounded-pill px-4" disabled>Sold Out</button>
                    <?php } else { ?>
                        <a href="hsingleview.php?house_id=<?php echo $display['house_id']; ?>" 
                           class="btn btn-outline-primary rounded-pill px-4">
                           View More
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
