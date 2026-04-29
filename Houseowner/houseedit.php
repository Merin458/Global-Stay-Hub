<?php
include('header.php');
include('../dboperation.php');
$obj=new dboperation();

if(isset($_GET["house_id"])) {
    $houseid=$_GET["house_id"];
    $sql="select * from tbl_housedetails where house_id='$houseid'";
    $res=$obj->executequery($sql);
    $display=mysqli_fetch_array($res);
}
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
        max-width: 420px;
        margin: 0 auto;
    }
    .card-body {
        padding: 32px 28px 28px 28px;
    }
    .add-category-box {
        background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 6px;
        padding: 10px 16px;
        text-align: left;
        margin: 0 0 18px 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        letter-spacing: 1px;
        border: 1.5px solid #007bff;
        width: 100%;
        box-sizing: border-box;
        display: block;
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
        border-radius: 8px;
        border: 1px solid #ced4da;
        box-shadow: none;
        transition: border-color 0.2s;
        padding: 10px 14px;
        font-size: 1rem;
        background: #f9fafb;
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
        height: 80px;
        border-radius: 4px;
        margin-bottom: 10px;
        object-fit: cover;
    }
</style>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <div class="add-category-box">
                Edit Your House Details
            </div>
            <form action="houseeditaction.php" method="post" class="forms-sample" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="housename"> Edit House Name</label>
                    <input type="text" name="housename" class="form-control" id="housename" placeholder="Name" value="<?php echo $display["house_name"];?>">
                    
                    <label for="desc"> Edit House Description</label>
                    <input type="text" name="desc" class="form-control" id="desc" placeholder="Description" value="<?php echo $display["housedescription"];?>">
                    
                    <label for="noofperson"> Edit No.Of Persons</label>
                    <input type="text" name="noofperson" class="form-control" id="noofperson" placeholder="No of Persons" value="<?php echo $display["noofperson"];?>">
                    
                    <label for="rate"> Edit Rate</label>
                    <input type="text" name="rate" class="form-control" id="rate" placeholder="Rate" value="<?php echo $display["rate"];?>">
                    
                    <label for="himage"> Edit House Images</label><br>
                    <?php
                        // Split images (stored as comma separated in DB)
                        $images = !empty($display["himage"]) ? explode(",", $display["himage"]) : [];
                        if (!empty($images[0])) {
                            echo '<img src="../uploads/'.$images[0].'" alt="image" class="preview-img">';
                        }
                    ?>
                    <input type="file" name="himage[]" class="form-control" id="himage" multiple>
                    
                    <input type="hidden" name="house_id" value="<?php echo $display["house_id"];?>">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='houseview.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php
include ('footer.php');
?>
