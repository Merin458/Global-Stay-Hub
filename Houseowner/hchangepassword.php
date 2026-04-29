<?php
session_start();
include("../dboperation.php");
$obj = new dboperation();

$owner_id = $_SESSION['Login_id'];
$result = $obj->executequery("SELECT * FROM tbl_houseowner WHERE owner_id='$owner_id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <style>
    /* Page Background */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f4f8;
        margin: 0;
        padding: 0;
    }

    /* Center the form container */
    .change-password-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    /* Card styling */
    .change-password-card {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 40px 30px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .change-password-card:hover {
        transform: translateY(-5px);
    }

    /* Heading */
    .change-password-card h2 {
        text-align: center;
        color: #2d3748;
        font-size: 28px;
        margin-bottom: 30px;
    }

    /* Form labels */
    .change-password-card label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #4a5568;
    }

    /* Input fields */
    .change-password-card input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #cbd5e0;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .change-password-card input[type="password"]:focus {
        outline: none;
        border-color: #3182ce;
        box-shadow: 0 0 5px rgba(49,130,206,0.5);
    }

    /* Buttons */
    .change-password-card .btn {
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .change-password-card .btn-cancel {
        background-color: #e2e8f0;
        color: #2d3748;
    }

    .change-password-card .btn-cancel:hover {
        background-color: #cbd5e0;
    }

    .change-password-card .btn-submit {
        background-color: #f6ad55;
        color: #1a202c;
        margin-left: 10px;
    }

    .change-password-card .btn-submit:hover {
        background-color: #ed8936;
    }

    /* Flex container for buttons */
    .change-password-card .button-group {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    /* Responsive */
    @media screen and (max-width: 480px) {
        .change-password-card {
            padding: 30px 20px;
        }
    }
  </style>
</head>
<body>

<div class="change-password-container">
  <div class="change-password-card">
    <h2>Change Password</h2>
    <form action="hpwaction.php" method="POST">
      <input type="hidden" name="owner_id" value="<?php echo $owner_id; ?>">

      <label>Current Password</label>
      <input type="password" name="current_password" placeholder="Enter current password" required>

      <label>New Password</label>
      <input type="password" name="new_password" placeholder="Enter new password" required>

      <label>Confirm New Password</label>
      <input type="password" name="confirm_password" placeholder="Confirm new password" required>

      <div class="button-group">
        <a href="profile.php" class="btn btn-cancel">Cancel</a>
        <button type="submit" class="btn btn-submit">Change</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
