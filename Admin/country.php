<?php
include('header.php');
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
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
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
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
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
                Country Registration
            </div>
            <form action="countryaction.php" method="post" class="forms-sample" enctype="multipart/form-data" id="countryForm">
                <div class="form-group">
                    <label for="exampleInputName1">Country</label>
                    <input type="text" name="countryname" class="form-control" id="exampleInputName1" placeholder="Enter Country Name">
                </div>
        
                <div class="form-group">
                    <label for="countryimage">Country Flag</label>
                    <input type="file" name="flag" class="form-control" id="countryimage" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='adminindex.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#countryForm").on("submit", function(e) {
        let country = $("#exampleInputName1").val().trim();
        let flag = $("#countryimage").val();

        // Validate country name
        if (country === "") {
            alert("Please enter a country name.");
            e.preventDefault();
            return false;
        }
        let namePattern = /^[A-Za-z\s]+$/;
        if (!namePattern.test(country)) {
            alert("Country name should contain only letters and spaces.");
            e.preventDefault();
            return false;
        }

        // Validate flag upload
        if (flag === "") {
            alert("Please upload a country flag.");
            e.preventDefault();
            return false;
        }

        return true; // all good
    });
});
</script>

<?php
include('footer.php');
?>
