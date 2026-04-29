<?php
include('header.php');
include('../dboperation.php');
$obj = new dboperation();

$owner_id = $_GET['owner_id'];

$sql = "SELECT * FROM tbl_houseowner WHERE owner_id='$owner_id'";
$res = $obj->executequery($sql);
$display = mysqli_fetch_array($res);

// Get city name
$cityid = $display["city_id"];
$city_sql = "SELECT city_name FROM tbl_city WHERE city_id='$cityid'";
$city_res = $obj->executequery($city_sql);
$city_name = '';
if ($city_row = mysqli_fetch_array($city_res)) {
    $city_name = $city_row["city_name"];
}

// Status info
$status = $display['status']; // requested, Accepted, Rejected
$disabled_class = ($status == 'Accepted' || $status == 'Rejected') ? "disabled-btn" : "";

// Href for Accept/Reject based on actual DB status
$href_accept = ($status == 'requested') ? "howneraccept.php?owner_id=".$display['owner_id'] : "#";
$href_reject = ($status == 'requested') ? "hownerreject.php?owner_id=".$display['owner_id'] : "#";

// Status badge color
$status_badge = "badge-secondary"; // requested
if($status == "Accepted") $status_badge = "badge-success";
if($status == "Rejected") $status_badge = "badge-danger";
?>

<style>
body {
    background: #f5f7fb;
}
.main-content {
    background: linear-gradient(135deg, #f5f7fb 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: 10px;
}
.profile-container {
    max-width: 900px;
    margin-left: -8%;
    margin-right: auto;
}
.profile-card {
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    padding: 40px 30px;
    background: #fff;
    transition: all 0.3s ease;
}
.profile-card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}
.profile-picture {
    width: 180px;
    height: 180px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #007bff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.disabled-btn {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}
.btn-action {
    width: 180px;
    font-size: 1.2rem;
    font-weight: 600;
    height: 60px;
    transition: all 0.3s ease;
    border-radius: 10px;
}
.btn-action:hover {
    transform: translateY(-3px);
}
.profile-info p {
    margin-bottom: 8px;
    font-size: 1rem;
}
h3, h4, h5 {
    font-weight: 600;
    color: #333;
}
.page-header {
    text-align: left;
    margin-bottom: 20px;
    margin-left: 37%;
}
</style>

<div class="main-content">
    <div class="profile-container">
        <div class="page-header">
            <h3>House Owner Profile</h3>
        </div>

        <div class="profile-card text-center">
            <!-- Profile Image & Status -->
            <div class="mb-4">
                <img src="../uploads/<?php echo $display["owner_image"]; ?>" 
                     class="profile-picture mb-3" 
                     alt="Owner Image">
                <h4 class="mb-1"><?php echo $display["owner_name"]; ?></h4>
                <p class="text-muted mb-2">House Owner</p>
                <span class="badge <?php echo $status_badge; ?> py-2 px-3 mb-3"><?php echo $status; ?></span>
            </div>

            <!-- Profile Details -->
            <div class="profile-info text-start mx-auto" style="max-width: 650px;">
                <h5 class="mb-3 text-center">Profile Details</h5>
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Full Name:</strong> <?php echo $display["owner_name"]; ?></div>
                    <div class="col-md-6"><strong>House Name:</strong> <?php echo $display["house_name"]; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Email:</strong> <?php echo $display["email"]; ?></div>
                    <div class="col-md-6"><strong>Phone:</strong> <?php echo $display["phone"]; ?></div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12"><strong>Location:</strong> <?php echo $city_name; ?></div>
                </div>
            </div>

            <!-- ID Proof -->
            <h5 class="mb-3 mt-4 text-center">ID Proof</h5>
            <div class="text-center mb-4">
                <img src="../uploads/<?php echo $display["idproof"]; ?>" 
                     alt="ID Proof" 
                     style="max-width: 100%; max-height: 300px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?php echo $href_accept; ?>"
                   class="btn btn-success btn-lg btn-action <?php echo $disabled_class; ?>"
                   onclick="<?php echo ($status == 'requested') ? "return confirm('Are you sure want to Accept?');" : "return false;"; ?>">
                   Accept
                </a>

                <a href="<?php echo $href_reject; ?>"
                   class="btn btn-danger btn-lg btn-action <?php echo $disabled_class; ?>"
                   onclick="<?php echo ($status == 'requested') ? "return confirm('Are you sure want to Reject?');" : "return false;"; ?>">
                   Reject
                </a>
            </div>

        </div> <!-- profile-card -->
    </div> <!-- profile-container -->
</div>

<?php
include('footer.php');
?>
