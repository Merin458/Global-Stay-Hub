<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['Login_id'])) {
    echo "You must be logged in to edit your profile.";
    exit;
}

$student_id = $_SESSION['Login_id'];

// Fetch current student details
$sql = "SELECT * FROM tbl_student WHERE student_id='$student_id'";
$result = $obj->executequery($sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Profile not found!";
    exit;
}

// Update profile on form submit
if (isset($_POST['update'])) {
    $name = $_POST['student_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];

    // Handle profile picture upload
    $filename = $row['simage']; // keep old pic if not updated
    if (!empty($_FILES['simage']['name'])) {
        $filename = time() . "_" . $_FILES['simage']['name'];
        $filepath = "../uploads/" . $filename;
        move_uploaded_file($_FILES['simage']['tmp_name'], $filepath);
    }

    $update_sql = "UPDATE tbl_student 
                   SET student_name='$name', email='$email', contact='$contact', gender='$gender', simage='$filename' 
                   WHERE student_id='$student_id'";
    $obj->executequery($update_sql);

    echo "<script>alert('Profile updated successfully!'); window.location.href='studentprofile.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - Global Stay Hub</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #f4f7fc;
      font-family: 'Poppins', sans-serif;
    }
    .edit-card {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      border-radius: 1.2rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 35px;
    }
    .form-control {
      border-radius: 10px;
      padding: 10px;
    }
    .btn-custom {
      border-radius: 25px;
      padding: 10px 25px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="edit-card">
    <h3 class="text-center mb-4">Edit Profile</h3>
    <form method="POST" enctype="multipart/form-data">
      
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="student_name" class="form-control" value="<?php echo $row['student_name']; ?>" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="contact" class="form-control" value="<?php echo $row['contact']; ?>" required>
      </div>

      <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-control" required>
          <option value="Male" <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
          <option value="Female" <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
          <option value="Other" <?php if($row['gender']=="Other") echo "selected"; ?>>Other</option>
        </select>
      </div>

      <div class="form-group">
        <label>Profile Picture</label><br>
        <img src="../uploads/<?php echo $row['simage']; ?>" width="100" height="100" style="border-radius:50%; margin-bottom:10px;"><br>
        <input type="file" name="simage" class="form-control-file">
      </div>

      <div class="text-center">
        <button type="submit" name="update" class="btn btn-primary btn-custom">Update Profile</button>
        <a href="studentprofile.php" class="btn btn-secondary btn-custom">Cancel</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
