<?php
include('header.php');
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // Country -> State -> City dynamic dropdowns
    $("#countrySelect").change(function () {
        var country_id = $(this).val();
        $.ajax({
            url: "getplace.php",
            method: "POST",
            data: { countryid: country_id },
            success: function (response) {
                $("#locationSelect").html(response);
                $("#citySelect").html('<option value="">--SELECT--</option>');
            },
            error: function () {
                $("#locationSelect").html("Error occurred while getting location!");
            }
        });
    });

    $("#locationSelect").change(function () {
        var location_id = $(this).val();
        $.ajax({
            url: "getcity.php",
            method: "POST",
            data: { locationid: location_id },
            success: function (response) {
                $("#citySelect").html(response);
            },
            error: function () {
                $("#citySelect").html("Error occurred while getting city!");
            }
        });
    });

    // Client-side form validation
    $("form").submit(function (e) {
        $(".error-message").remove();
        let valid = true;

        if ($("input[name='sname']").val().trim() === "") {
            $("input[name='sname']").after('<div class="error-message text-danger">Enter your name</div>');
            valid = false;
        }
        if (!$("input[name='gender']:checked").val()) {
            $("input[name='gender']").last().after('<div class="error-message text-danger">Select your gender</div>');
            valid = false;
        }
        if ($("#countrySelect").val() === "") {
            $("#countrySelect").after('<div class="error-message text-danger">Select a country</div>');
            valid = false;
        }
        if ($("#locationSelect").val() === "") {
            $("#locationSelect").after('<div class="error-message text-danger">Select a state</div>');
            valid = false;
        }
        if ($("#citySelect").val() === "") {
            $("#citySelect").after('<div class="error-message text-danger">Select a city</div>');
            valid = false;
        }

        const pin = $("input[name='pin']").val().trim();
        const pinRegex = /^[0-9]{6}$/;
        if (!pinRegex.test(pin)) {
            $("input[name='pin']").after('<div class="error-message text-danger">Enter a valid 6-digit pincode</div>');
            valid = false;
        }

        const phone = $("input[name='phone']").val().trim();
        const phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phone)) {
            $("input[name='phone']").after('<div class="error-message text-danger">Enter a valid 10-digit phone number</div>');
            valid = false;
        }

        const email = $("input[name='mail']").val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $("input[name='mail']").after('<div class="error-message text-danger">Enter a valid email address</div>');
            valid = false;
        }

        if ($("input[name='uname']").val().trim() === "") {
            $("input[name='uname']").after('<div class="error-message text-danger">Enter a username</div>');
            valid = false;
        }

        // Strong password validation
        const password = $("input[name='pass']").val().trim();
        const strongPassRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!strongPassRegex.test(password)) {
            $("input[name='pass']").after('<div class="error-message text-danger">Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.</div>');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
});
</script>

<?php
include_once("../dboperation.php");
$sql = "SELECT * FROM tbl_country";
$obj = new dboperation();
$result = $obj->executequery($sql);
?>

<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row block-9 justify-content-center">
            <div class="col-md-10 order-md-last d-flex ftco-animate">
                <form action="studentaction.php" method="post" class="bg-light p-4 p-md-5 contact-form w-100" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Your Name" name="sname" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <div class="form-control d-flex justify-content-around align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                    <label class="form-check-label ms-2" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                    <label class="form-check-label ms-2" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                                    <label class="form-check-label ms-2" for="other">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Select a Country</label>
                            <select class="form-control" name="countryname" id="countrySelect" required>
                                <option value="">--SELECT--</option>
                                <?php while ($r = mysqli_fetch_array($result)) { ?>
                                    <option value="<?php echo $r["country_id"]; ?>"><?php echo $r["country_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Select State</label>
                            <select class="form-control" name="locationname" id="locationSelect" required>
                                <option value="">--SELECT--</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Select City</label>
                            <select class="form-control" name="cityname" id="citySelect" required>
                                <option value="">--SELECT--</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Pincode</label>
                            <input type="text" class="form-control" placeholder="6-digit Pincode" name="pin" pattern="\d{6}" title="Enter exactly 6 digits" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Id Proof</label>
                            <input type="file" class="form-control" name="idproof" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Contact</label>
                            <input type="text" class="form-control" placeholder="10-digit Phone Number" name="phone" pattern="\d{10}" title="Enter 10-digit phone number" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email" name="mail" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Your Image</label>
                            <input type="file" class="form-control" name="simage" required>
                        </div>

                        

                        <div class="col-md-6 mb-3">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="User Name" name="uname" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="pass"
                                   pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}"
                                   title="Must contain at least 8 characters, including uppercase, lowercase, number, and special character." required>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <input type="submit" value="Register" class="btn btn-primary py-3 px-5">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>
