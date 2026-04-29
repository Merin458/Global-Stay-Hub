<?php
session_start();
include('header.php');
include_once("../dboperation.php");

$obj = new dboperation();

if (!isset($_SESSION['Login_id'])) {
    echo "You must be logged in to see your profile.";
    exit;
}

$student_id = $_SESSION['Login_id'];

// Fetch student details
$sql = "SELECT * FROM tbl_student WHERE student_id='$student_id'";
$result = $obj->executequery($sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Profile not found!";
    exit;
}

$row = mysqli_fetch_assoc($result);
$imagePath = !empty($row['simage']) ? "../uploads/".$row['simage'] : "../images/default.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile - Global Stay Hub</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #f4f7fc;
      font-family: 'Poppins', sans-serif;
    }
    .profile-card {
      max-width: 650px;
      margin: 60px auto;
      background: #fff;
      border-radius: 1.2rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 40px 30px;
      text-align: center;
      position: relative;
    }
    .profile-pic {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #ddd;
      margin-bottom: 15px;
    }
    .greeting {
      font-size: 1.4rem;
      font-weight: 600;
      color: #333;
    }
    .profile-name {
      font-size: 1.8rem;
      font-weight: bold;
      color: #2c3e50;
    }
    .profile-details {
      margin-top: 20px;
      text-align: left;
    }
    .profile-details th {
      width: 35%;
      color: #555;
    }
    .btn-custom {
      border-radius: 30px;
      padding: 8px 20px;
      font-weight: 500;
    }
    .back-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      background: #6c757d;
      color: white;
      border-radius: 30px;
      padding: 6px 16px;
      font-size: 14px;
      transition: 0.3s;
    }
    .back-btn:hover {
      background: #5a6268;
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="profile-card">
    <a href="searchhouse.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>

    <img src="<?php echo $imagePath; ?>" class="profile-pic" alt="Profile Picture">

    <p class="greeting">Hi, <span class="profile-name"><?php echo htmlspecialchars($row['student_name']); ?></span> 👋</p>
    <p class="text-muted mb-4"><?php echo htmlspecialchars($row['email']); ?></p>

    <div class="profile-details">
      <table class="table table-borderless">
        <tr><th><i class="fas fa-phone"></i> Phone</th><td><?php echo htmlspecialchars($row['contact']); ?></td></tr>
        <tr><th><i class="fas fa-venus-mars"></i> Gender</th><td><?php echo htmlspecialchars($row['gender']); ?></td></tr>
      </table>
    </div>

    <div class="mt-3">
      <a href="sprofileedit.php" class="btn btn-primary btn-custom"><i class="fas fa-user-edit"></i> Edit Profile</a>
      <a href="schangepassword.php" class="btn btn-secondary btn-custom"><i class="fas fa-key"></i> Change Password</a>
    </div>
  </div>
</div>

</body>
</html>
<?php include('footer.php'); ?>
