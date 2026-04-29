<?php
include('header.php');
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Fetch States on Country change
        $("#countrySelect").change(function () {
            var country_id = $(this).val();
            if (country_id !== "") {
                $.ajax({
                    url: "getplace.php",
                    method: "POST",
                    data: { countryid: country_id },
                    success: function (response) {
                        $("#locationSelect").html(response);
                        $("#citySelect").html('<option value="">---Select City---</option>'); // Reset city
                    },
                    error: function () {
                        $("#locationSelect").html("<option>Error loading states</option>");
                    }
                });
            }
        });

        // Fetch Cities on State change
        $("#locationSelect").change(function () {
            var location_id = $(this).val();
            if (location_id !== "") {
                $.ajax({
                    url: "getcity2.php",
                    method: "POST",
                    data: { locationid: location_id },
                    success: function (response) {
                        $("#citySelect").html(response);
                    },
                    error: function () {
                        $("#citySelect").html("<option>Error loading cities</option>");
                    }
                });
            }
        });
    });

    // Form Validation
    function validateForm() {
        let isValid = true;

        let country = document.getElementById("countrySelect").value;
        let state = document.getElementById("locationSelect").value;
        let city = document.getElementById("citySelect").value;
        let university = document.getElementById("university").value.trim();

        // Regex for university name: alphabets, spaces, dots allowed
        let nameRegex = /^[A-Za-z\s.]{3,}$/;

        // Reset error messages
        document.querySelectorAll(".error").forEach(e => e.style.display = "none");

        if (country === "") {
            document.getElementById("countryError").style.display = "block";
            isValid = false;
        }
        if (state === "") {
            document.getElementById("stateError").style.display = "block";
            isValid = false;
        }
        if (city === "") {
            document.getElementById("cityError").style.display = "block";
            isValid = false;
        }
        if (!nameRegex.test(university)) {
            document.getElementById("universityError").style.display = "block";
            isValid = false;
        }

        return isValid;
    }
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
    }

    .card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border-radius: 14px;
        border: none;
        background: #fff;
        width: 100%;
        max-width: 460px;
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
        margin: 0 0 18px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        letter-spacing: 1px;
        border: 1.5px solid #007bff;
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
    }

    .btn-light:hover {
        background: #e2e6ea;
    }

    .error {
        color: red;
        font-size: 0.9rem;
        display: none;
        margin-top: 4px;
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
                University Registration
            </div>
            <form action="universityaction.php" method="post" class="forms-sample" enctype="multipart/form-data" onsubmit="return validateForm()">
                
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
                    <span class="error" id="countryError">Please select a country.</span>
                </div>

                <div class="form-group">
                    <label>Select State</label>
                    <select class="form-control" name="locationname" id="locationSelect">
                        <option value="">---Select State---</option>
                    </select>
                    <span class="error" id="stateError">Please select a state.</span>
                </div>

                <div class="form-group">
                    <label>Select City</label>
                    <select class="form-control" name="cityname" id="citySelect">
                        <option value="">---Select City---</option>
                    </select>
                    <span class="error" id="cityError">Please select a city.</span>
                </div>

                <div class="form-group">
                    <label for="university">University</label>
                    <input type="text" name="universityname" class="form-control" id="university" placeholder="Enter University Name">
                    <span class="error" id="universityError">Enter a valid university name.</span>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='university.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
