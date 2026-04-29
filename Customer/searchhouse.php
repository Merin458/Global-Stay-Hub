<?php
include('header.php');
include('../dboperation.php');
$obj = new dboperation();
?>

<style>
    /* Navbar */
    .navbar-custom {
        background: #2f3e46; /* Dark grey-blue */
        padding: 12px 20px;
    }

    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
        color: #ffffff !important;
        font-weight: 500;
    }

    .navbar-custom .btn {
        margin-left: 10px;
        border-radius: 6px;
        padding: 6px 14px;
    }

    .btn-blue {
        background-color: #0077b6;
        color: #fff;
        border: none;
    }

    .btn-blue:hover {
        background-color: #0096c7;
    }

    .btn-grey {
        background-color: #adb5bd;
        color: #fff;
        border: none;
    }

    .btn-grey:hover {
        background-color: #6c757d;
    }

    /* Hero section */
    .hero-wrap {
        position: relative;
        background-size: cover;
        background-position: center center;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .hero-wrap .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.55);
        z-index: 1;
    }

    /* Content box */
    .content-box {
        position: relative;
        z-index: 2;
        background: #ffffff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
        color: #333;
        max-width: 500px;
        width: 100%;
    }

    .content-box h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #023e8a;
    }

    .content-box p {
        color: #495057;
    }

    /* Radio buttons */
    .custom-radio-group {
        display: flex;
        gap: 30px;
        margin-top: 15px;
    }

    .custom-radio {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .custom-radio input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #0077b6;
        cursor: pointer;
    }

    /* Select dropdowns */
    select.form-control {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px 14px;
        font-size: 15px;
        border-radius: 6px;
        width: 100%;
        transition: 0.3s;
    }

    select.form-control:focus {
        border-color: #0077b6;
        box-shadow: 0 0 6px rgba(0, 119, 182, 0.5);
    }

    label.custom-radio,
    label[for="cityid"],
    label[for="uniid"] {
        font-weight: 600;
        margin-top: 12px;
        margin-bottom: 5px;
        display: block;
        color: #023e8a;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .custom-radio-group {
            flex-direction: column;
        }

        .hero-wrap {
            justify-content: center;
        }

        .content-box {
            margin: 0 15px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-wrap js-fullheight" style="background-image: url('images/bgnew3.jpg');" data-section="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-end">
            <div class="col-md-6 col-lg-5">
                <div class="content-box">
                    <h1 class="mb-3">Smart Home Search</h1>
                    <p class="mb-3">
                        Search by city or university and discover comfortable homes near you.
                    </p>

                    <!-- Radio buttons -->
                    <div class="form-group custom-radio-group">
                        <label class="custom-radio">
                            <input type="radio" name="searchType" id="txtcityid" value="city"> City
                        </label>
                        <label class="custom-radio">
                            <input type="radio" name="searchType" id="txtuniid" value="university"> University
                        </label>
                    </div>

                    <?php
                    $query = "SELECT * FROM tbl_country";
                    $result = $obj->executequery($query);
                    ?>

                    <!-- Dropdowns -->
                    <div class="form-group">
                        <div class="col-sm-12" id="r1">
                            <label class="custom-radio">Country</label>
                            <select class="form-control" name="ddlcountry" id="countryid">
                                <option value="0">--SELECT--</option>
                                <?php while ($display = mysqli_fetch_array($result)) { ?>
                                    <option value="<?php echo $display["country_id"]; ?>">
                                        <?php echo $display["country_name"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-12" id="r2">
                            <label for="stateid" class="custom-radio">State</label>
                            <select class="form-control" name="txtstatename" id="stateid">
                                <option>--SELECT--</option>
                            </select>
                        </div>

                        <div class="col-sm-12" id="r3">
                            <label for="cityid" class="custom-radio">City</label>
                            <select class="form-control" name="txtcityname" id="cityid">
                                <option>--SELECT--</option>
                            </select>
                        </div>

                        <div class="col-sm-12" id="r4">
                            <label for="uniid" class="custom-radio">University</label>
                            <select class="form-control" name="txtuniname" id="uniid">
                                <option value="0">--SELECT--</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property Section -->
 <section class="ftco-section ftco-properties" id="properties-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4" style="color:#023e8a;">Our Property</h2>
            </div>
        </div>
        <div class="row" id="details"></div>
    </div>
</section>  

<?php include('footer.php'); ?>
<script src="../jquery-3.6.0.min.js"></script>

<script>
// --- jQuery Logic same as your existing ---
$(document).ready(function () {
    $("#r1, #r2, #r3,#r4").hide();

    $("input[name='searchType']").change(function () {
        const type = $(this).val();
        $("#countryid").val("0").trigger("change");
        $("#cityid").val("0").trigger("change");
        $("#stateid").val("0").trigger("change");
        $("#uniid").val("0").trigger("change");
        $("#details").empty();

        if (type === 'city') {
            $("#r1, #r2, #r3").show();
            $("#r4").hide();
        } else if (type === 'university') {
            $("#r1, #r2, #r3,#r4").show();
        }
    });
});

$("#countryid").change(function () {
        var country_id = $(this).val();


        $.ajax({
            url: "getlocation.php",
            method: "POST",
            data: { countryid: country_id },
            success: function (response) {
                $("#stateid").html(response);
            },
            error: function () {
                $("#stateid").html("Error occurred while getting location!");
            }
        });
    });
    $("#stateid").change(function () {
        var location_id = $(this).val();


        $.ajax({
            url: "getcity.php",
            method: "POST",
            data: { locationid: location_id },
            success: function (response) {
                $("#cityid").html(response);
            },
            error: function () {
                $("#cityid").html("Error occurred while getting location!");
            }

        });



        $("#cityid").change(function () {
            const cityid = $(this).val();
            const type = $("input[name='searchType']:checked").val();
            if (!cityid) return;

            if (type === 'city') {
                // Get properties by city
                $.ajax({
                    url: "getproperty.php",
                    method: "POST",
                    data: { id: cityid, type: "city" },
                    success: function (response) {
                        $("#details").html(response);
                    },
                    error: function () {
                        $("#details").html("Error occurred while getting properties.");
                    }
                });
            } else if (type === 'university') {
                // Load universities in selected city
                $.ajax({
                    url: "getuniversity.php",
                    method: "POST",
                    data: { cityid: cityid },
                    success: function (response) {
                        $("#uniid").html(response);
                    },
                    error: function () {
                        $("#uniid").html("<option>Error loading universities</option>");
                    }
                });
            }
        });

        // On university change -> get properties
        $("#uniid").change(function () {
            const uniid = $(this).val();
            if (!uniid || uniid === "0") return;

            $.ajax({
                url: "getproperty.php",
                method: "POST",
                data: { id: uniid, type: "university" },
                success: function (response) {
                    $("#details").html(response);
                },
                error: function () {
                    $("#details").html("Error occurred while getting properties.");
                }
            });
        });
    });
</script>

