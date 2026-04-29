<?php
session_start();
include_once('header.php');
include("../dboperation.php");
$obj = new dboperation();

$owner_id = $_SESSION['Login_id'];
$result = $obj->executequery("SELECT * FROM tbl_houseowner WHERE owner_id='$owner_id'");
$row = mysqli_fetch_assoc($result);
?>

<div class="container mt-5 mb-5">

  <!-- 🔹 Back Button -->
  <div class="mb-3 text-start">
    <a href="houseregistration.php" class="btn btn-secondary rounded-pill px-4 py-2 shadow-sm">
      ← Back
    </a>
  </div>

  <!-- 🔹 Profile Card -->
  <div class="card shadow-sm p-4" style="background-color: #f0f0f0; border: none;">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-4">
      
      <!-- Profile Image -->
      <div class="text-center">
        <img src="../uploads/<?php echo $row['owner_image']; ?>" 
             alt="Profile Picture" 
             style="width:250px; height:250px; object-fit:cover; border-radius:50%; border:4px solid #6c757d;">
      </div>

      <!-- Profile Info -->
      <div style="line-height:1.8; color:#333;">
        <h2 class="fw-bold mb-3" style="font-size:24px;">👋 Welcome, <?php echo $row['owner_name']; ?></h2>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
        <p><strong>Pincode:</strong> <?php echo $row['pincode']; ?></p>

        <!-- Action Buttons -->
        <div class="mt-4 d-flex flex-wrap gap-3">
          <a href="hprofileedit.php" 
             class="btn btn-outline-dark rounded-pill px-4 py-2 shadow-sm">
             ✏️ Edit Profile
          </a>
          <a href="houseregistration.php" 
             class="btn btn-outline-secondary rounded-pill px-4 py-2 shadow-sm">
             🏠 Add House
          </a>
          <a href="hchangepassword.php" 
             class="btn btn-outline-warning rounded-pill px-4 py-2 shadow-sm text-dark">
             🔒 Change Password
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
body {
  background-color: #e9ecef; /* Soft gray background */
}

/* Button hover effects */
.btn:hover {
  transform: translateY(-2px);
  transition: 0.3s ease;
}

/* Adjust card shadow and text contrast */
.card {
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>

<?php include('footer.php'); ?>
