<?php
include('header.php');
include('../dboperation.php');
$db = new dboperation();
$country_query = "SELECT country_id, country_name FROM tbl_country";
$country_result = $db->executequery($country_query);
?>

<style>
    body {
        background-color: #f4f6fb;
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        align-items: flex-start;
    }

    .center-container {
        display: flex;
        justify-content: center;
        padding-top: 60px;
        padding-bottom: 40px;
    }

    .card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border-radius: 14px;
        border: none;
        background: #fff;
        width: 100%;
        max-width: 420px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card-body {
        padding: 32px 28px 28px 28px;
        width: 100%;
        box-sizing: border-box;
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
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
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, .08);
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

    .error {
        color: red;
        font-size: 0.9rem;
        margin-top: 4px;
        display: none;
    }
</style>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <div class="add-category-box">
                Location Registration
            </div>
            <form action="locationaction.php" method="post" class="forms-sample" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="countrySelect">Country</label>
                    <select name="countryname" class="form-control" id="countrySelect">
                        <option value="">Select Country</option>
                        <?php while($display = mysqli_fetch_array($country_result)) { ?>
                            <option value="<?php echo $display["country_id"] ?>"> <?php echo $display["country_name"] ?> </option>
                        <?php } ?>
                    </select>
                    <span class="error" id="countryError">Please select a country.</span>
                </div>

                <div class="form-group">
                    <label for="location">Select State</label>
                    <input type="text" name="locationname" class="form-control" id="location" placeholder="Enter Your State">
                    <span class="error" id="stateError">Please Enter State.</span>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='location.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
function validateForm() {
    let isValid = true;

    // Country Validation
    let country = document.getElementById("countrySelect").value;
    let countryError = document.getElementById("countryError");
    if (country === "") {
        countryError.style.display = "block";
        isValid = false;
    } else {
        countryError.style.display = "none";
    }

    // State Validation
    let state = document.getElementById("location").value.trim();
    let stateError = document.getElementById("stateError");
    let regex = /^[A-Za-z\s]{3,}$/;
    if (!regex.test(state)) {
        stateError.style.display = "block";
        isValid = false;
    } else {
        stateError.style.display = "none";
    }

    return isValid;
}
</script>

<?php
include('footer.php');
?>
