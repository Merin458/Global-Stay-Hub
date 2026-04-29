<?php
include('header.php');
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // Load states when country changes
    $("#countrySelect").change(function () {
        var country_id = $(this).val();
        if (country_id === "") {
            $("#locationSelect").html('<option value="">---Select State---</option>');
            return;
        }

        $.ajax({
            url: "getplace.php",
            method: "POST",
            data: { countryid: country_id },
            success: function (response) {
                $("#locationSelect").html(response);
            },
            error: function () {
                $("#locationSelect").html("<option>Error loading states!</option>");
            }
        });
    });

    // ✅ Form validation
    $("form").on("submit", function (e) {
        let country = $("#countrySelect").val();
        let state = $("#locationSelect").val();
        let district = $("#district").val().trim();

        // reset errors
        $(".error").remove();

        if (country === "") {
            $("#countrySelect").after('<span class="error"> Please select a country.</span>');
            e.preventDefault();
            return;
        }

        if (state === "") {
            $("#locationSelect").after('<span class="error"> Please select a state.</span>');
            e.preventDefault();
            return;
        }

        if (district === "") {
            $("#district").after('<span class="error"> District name is required.</span>');
            e.preventDefault();
            return;
        }

        let districtPattern = /^[A-Za-z\s]+$/;
        if (!districtPattern.test(district)) {
            $("#district").after('<span class="error"> Only letters allowed.</span>');
            e.preventDefault();
            return;
        }
    });
});
</script>

<style>
    body {
        background-color: #f4f6fb;
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .center-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }
    .card {
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        border-radius: 14px;
        background: #fff;
        width: 100%;
        max-width: 420px;
    }
    .card-body {
        padding: 32px 28px;
    }
    .add-category-box {
        background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 6px;
        padding: 10px 16px;
        margin-bottom: 18px;
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
        padding: 10px 14px;
        font-size: 1rem;
        background: #f9fafb;
        width: 100%;
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
    }
    .btn-light:hover {
        background: #e2e6ea;
    }
    .error {
        color: red;
        font-size: 0.85rem;
        display: block;
        margin-top: 5px;
    }
</style>

<?php
include_once("../dboperation.php");
$sql = "SELECT * FROM tbl_country";
$obj = new dboperation();
$result = $obj->executequery($sql);
?>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <div class="add-category-box">District Registration</div>
            
            <form action="districtaction.php" method="post">
                <div class="form-group">
                    <label>Select a Country</label>
                    <select class="form-control" name="countryname" id="countrySelect">
                        <option value="">---Select Country---</option>
                        <?php while ($r = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $r["country_id"]; ?>">
                                <?php echo $r["country_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select State</label>
                    <select class="form-control" name="locationname" id="locationSelect">
                        <option value="">---Select State---</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" name="districtname" class="form-control" id="district"
                           placeholder="Enter District">
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
