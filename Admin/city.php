<?php
include('header.php');
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Load states based on country
    $("#countrySelect").change(function () {
        var country_id = $(this).val();

        if (country_id !== "") {
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
        } else {
            $("#locationSelect").html('<option value="">---Select State---</option>');
        }
    });

    // ✅ Client-side validation
    $("form").on("submit", function (e) {
        let country = $("#countrySelect").val();
        let state = $("#locationSelect").val();
        let city = $("#city").val().trim();

        // Country validation
        if (country === "") {
            alert("Please select a country.");
            e.preventDefault();
            return false;
        }

        // State validation
        if (state === "") {
            alert("Please select a state.");
            e.preventDefault();
            return false;
        }

        // City validation
        if (city === "") {
            alert("City name cannot be empty.");
            e.preventDefault();
            return false;
        }

        // City name must contain only letters
        let cityPattern = /^[A-Za-z\s]+$/;
        if (!cityPattern.test(city)) {
            alert("City name should only contain alphabets.");
            e.preventDefault();
            return false;
        }

        return true; // Allow submission if all checks pass
    });
});
</script>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f4f6fb;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .center-container {
        flex: 1 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 0;
    }
    .card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
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
    footer {
        flex-shrink: 0;
        width: 100%;
    }
</style>

<?php
include_once("../dboperation.php");
$sql = "select * from tbl_country";
$obj = new dboperation();
$result = $obj->executequery($sql);
?>

<div class="center-container">
    <div class="card">
        <div class="card-body">
            <div class="add-category-box">
                City Registration
            </div>
            <form action="cityaction.php" method="post" class="forms-sample" enctype="multipart/form-data">
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
                    <label for="city">City</label>
                    <input type="text" name="cityname" class="form-control" id="city"
                        placeholder="Enter City Name" required>
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
