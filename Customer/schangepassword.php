<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

// Check if user is logged in
if (!isset($_SESSION['Login_id'])) {
    echo "<script>alert('❌ You must be logged in to change password.'); window.location.href='login.php';</script>";
    exit;
}

$student_id = intval($_SESSION['Login_id']);

// Fetch current password hash
$sql = "SELECT password FROM tbl_student WHERE student_id='$student_id'";
$result = $obj->executequery($sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('❌ User not found!'); window.location.href='studentprofile.php';</script>";
    exit;
}

// Handle password update
if (isset($_POST['update'])) {
    $current_pass = trim($_POST['current_password']);
    $new_pass = trim($_POST['new_password']);
    $confirm_pass = trim($_POST['confirm_password']);

    // Verify current password (assuming plain text, but hashed is recommended)
    if ($current_pass !== $row['password']) {
        echo "<script>alert('❌ Current password is incorrect!');</script>";
    } elseif ($new_pass !== $confirm_pass) {
        echo "<script>alert('❌ New password and confirm password do not match!');</script>";
    } elseif (strlen($new_pass) < 6) {
        echo "<script>alert('❌ New password must be at least 6 characters long!');</script>";
    } else {
        // Update password
        $update_sql = "UPDATE tbl_student SET password='$new_pass' WHERE student_id='$student_id'";
        $obj->executequery($update_sql);
        echo "<script>alert('✅ Password updated successfully!'); window.location.href='studentprofile.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password - Global Stay Hub</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<style>
    body {
        background: #f4f7fc;
        font-family: 'Poppins', sans-serif;
    }
    .password-card {
        max-width: 500px;
        margin: 70px auto;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        padding: 30px;
    }
    .btn-custom {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 500;
    }
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>
<script>
function validatePasswordForm() {
    let valid = true;

    const newPass = document.getElementById('new_password').value.trim();
    const confirmPass = document.getElementById('confirm_password').value.trim();

    // Clear previous errors
    document.getElementById('errorMsg').innerText = '';

    if (newPass.length < 4) {
        document.getElementById('errorMsg').innerText = '❌ New password must be at least 4 characters long.';
        valid = false;
    } else if (newPass !== confirmPass) {
        document.getElementById('errorMsg').innerText = '❌ New password and confirm password do not match.';
        valid = false;
    }

    return valid;
}
</script>
</head>
<body>

<div class="container">
    <div class="password-card">
        <h3 class="text-center mb-4">Change Password</h3>
        <form method="POST" onsubmit="return validatePasswordForm();">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>

            <div id="errorMsg" class="error-message text-center mb-3"></div>

            <div class="text-center">
                <button type="submit" name="update" class="btn btn-primary btn-custom">Update Password</button>
                <a href="studentprofile.php" class="btn btn-secondary btn-custom">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
