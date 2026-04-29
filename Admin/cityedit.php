<?php
include('header.php');
include('../dboperation.php');
$obj = new dboperation();

// Initialize variables
$display = ['city_name' => '', 'city_id' => ''];

// Accept both ?city_id=3 and ?locationid=3 for safety
if (isset($_GET["city_id"]) || isset($_GET["locationid"])) {
    $cid = isset($_GET["city_id"]) ? $_GET["city_id"] : $_GET["locationid"];
    $sql = "SELECT * FROM tbl_city WHERE city_id='$cid'";
    $res = $obj->executequery($sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $display = mysqli_fetch_array($res);
    }
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
</style>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <div class="add-category-box">
                Edit City
            </div>

            <form action="cityeditaction.php" method="post" class="forms-sample" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Edit City Name</label>
                    <input type="text" name="cityname" class="form-control" id="exampleInputName1"
                        placeholder="Enter City Name" 
                        value="<?php echo htmlspecialchars($display['city_name']); ?>" required>

                    <input type="hidden" name="city_id" value="<?php echo htmlspecialchars($display['city_id']); ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='city.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php 
include('footer.php');
?>
