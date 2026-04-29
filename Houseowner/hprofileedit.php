<?php
session_start();
include('header.php');
include('../dboperation.php');
$obj = new dboperation();

$owner_id = $_SESSION['Login_id'];

// Fetch current owner details
$sql = "SELECT * FROM tbl_houseowner WHERE owner_id='$owner_id'";
$res = $obj->executequery($sql);
$row = mysqli_fetch_assoc($res);
?>

<style>
    body {
        background-color: #f4f6fb;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .center-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        border-radius: 14px;
        border: none;
        background: #fff;
        width: 100%;
        max-width: 520px;
        margin: 0 auto;
    }
    .card-body {
        padding: 32px 28px 28px 28px;
    }
    .form-group {
        margin-bottom: 22px;
    }
    label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }
    .form-control {
    width: 100%;              /* Full width */
    max-width: 450px;         /* Optional: Limit max width */
    border-radius: 8px;
    border: 1px solid #ced4da;
    box-shadow: none;
    transition: border-color 0.2s;
    padding: 12px 16px;       /* More padding */
    font-size: 1rem;
    background: #f9fafb;
    display: block;
}

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,.08);
        background: #fff;
    }
    .btn-primary {
        background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
        border: none;
        border-radius: 8px;
        padding: 10px 28px;
        font-weight: 500;
        color: #fff;
        transition: background 0.2s;
        margin-right: 10px;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
    }
    .btn-light {
        border-radius: 8px;
        padding: 10px 28px;
        background: #f1f3f7;
        color: #333;
        border: 1px solid #e0e3ea;
        font-weight: 500;
        transition: background 0.2s;
    }
    .btn-light:hover {
        background: #e2e6ea;
    }
    .preview-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 12px;
        object-fit: cover;
    }
</style>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4" style="font-size:22px; font-weight:bold; color:#2d3748;">
                ✏️ Edit Profile
            </h3>

            <form action="profileeditaction.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="owner_name">Name</label>
                    <input type="text" name="owner_name" id="owner_name" 
                           class="form-control" 
                           value="<?php echo $row['owner_name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" 
                           class="form-control" 
                           value="<?php echo $row['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" 
                           class="form-control" 
                           value="<?php echo $row['phone']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pincode" id="pincode" 
                           class="form-control" 
                           value="<?php echo $row['pincode']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="owner_image">Profile Image</label><br>
                    <?php if (!empty($row['owner_image'])) { ?>
                        <img src="../uploads/<?php echo $row['owner_image']; ?>" 
                             alt="Profile Image" class="preview-img"><br>
                    <?php } ?>
                    <input type="file" name="owner_image" id="owner_image" class="form-control">
                </div>

                <input type="hidden" name="owner_id" value="<?php echo $row['owner_id']; ?>">

                <button type="submit" class="btn btn-primary" name="update">Save Changes</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='hprofile.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
