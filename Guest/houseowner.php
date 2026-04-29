<?php
include('header.php');
include_once("../dboperation.php");
$obj = new dboperation();

// Fetch countries
$sql = "SELECT * FROM tbl_country";
$result = $obj->executequery($sql);
?>

<script src="../jquery-3.6.0.min.js"></script>
<style>
    .form-section {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .form-left, .form-right {
        width: 48%;
    }
    @media(max-width:768px){
        .form-left, .form-right {
            width: 100%;
        }
    }
</style>

<script>
$(document).ready(function () {

    // Populate locations based on country
    $("#countrySelect").change(function () {
        var country_id = $(this).val();
        if(country_id !== "") {
            $.ajax({
                url: "getplace.php",
                method: "POST",
                data: { countryid: country_id },
                success: function (response) {
                    $("#locationSelect").html(response);
                    $("#citySelect").html('<option value="">---Select City---</option>');
                }
            });
        } else {
            $("#locationSelect").html('<option value="">---Select State---</option>');
            $("#citySelect").html('<option value="">---Select City---</option>');
        }
    });

    // Populate cities based on location
    $("#locationSelect").change(function () {
        var location_id = $(this).val();
        if(location_id !== "") {
            $.ajax({
                url: "getcity.php",
                method: "POST",
                data: { locationid: location_id },
                success: function (response) {
                    $("#citySelect").html(response);
                }
            });
        } else {
            $("#citySelect").html('<option value="">---Select City---</option>');
        }
    });

    // Client-side validation
    $("#houseOwnerForm").submit(function() {
        let valid = true;
        let email = $("input[name='mail']").val().trim();
        let phone = $("input[name='phone']").val().trim();
        let pass = $("input[name='pass']").val().trim();
        let uname = $("input[name='uname']").val().trim();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[0-9]{10}$/;

        $(".error-message").remove();

        if(!emailRegex.test(email)){
            $("input[name='mail']").after('<div class="error-message text-danger">Enter a valid email.</div>');
            valid = false;
        }
        if(!phoneRegex.test(phone)){
            $("input[name='phone']").after('<div class="error-message text-danger">Enter a valid 10-digit phone number.</div>');
            valid = false;
        }
        if(pass.length < 6){
            $("input[name='pass']").after('<div class="error-message text-danger">Password must be at least 6 characters.</div>');
            valid = false;
        }
        if(uname.length < 3){
            $("input[name='uname']").after('<div class="error-message text-danger">Username must be at least 3 characters.</div>');
            valid = false;
        }
        return valid;
    });
});
</script>

<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
        <div class="row block-9">
            <div class="col-md-12 d-flex ftco-animate">
                
                <form id="houseOwnerForm" action="houseowneraction.php" method="post" 
                    class="bg-light p-4 p-md-5 contact-form" enctype="multipart/form-data">

                    <div class="form-section">

                        <!-- LEFT SECTION -->
                        <div class="form-left">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Name" name="honame" required>
                            </div>

                            <div class="form-group">
                                <label>House</label>
                                <input type="text" class="form-control" placeholder="Enter House Name" name="hname" required>
                            </div>

                            <div class="form-group">
                                <label>Select a Country</label>
                                <select class="form-control" name="countryname" id="countrySelect" required>
                                    <option value="">---Select Country---</option>
                                    <?php while ($r = mysqli_fetch_array($result)) { ?>
                                        <option value="<?php echo $r["country_id"]; ?>"><?php echo $r["country_name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select State</label>
                                <select class="form-control" name="locationname" id="locationSelect" required>
                                    <option value="">---Select State---</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select City</label>
                                <select class="form-control" name="cityname" id="citySelect" required>
                                    <option value="">---Select City---</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="User Name" name="uname" required>
                            </div>


                        </div>

                        <!-- RIGHT SECTION -->
                        <div class="form-right">

                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control" placeholder="Pincode" name="pin" pattern="[0-9]{6}" required>
                            </div>

                            <div class="form-group">
                                <label>Id proof</label>
                                <input type="file" class="form-control" name="idproof" accept=".jpg,.jpeg,.png,.pdf" required>
                            </div>

                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter Your Email" name="mail" required>
                            </div>

                            <div class="form-group">
                                <label>Your Image</label>
                                <input type="file" class="form-control" name="himage" accept=".jpg,.jpeg,.png" required>
                            </div>

                            
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="pass" required>
                            </div>

                        </div>

                    </div>

                    <div class="form-group text-center mt-4">
                        <input type="submit" value="Register" class="btn btn-primary py-3 px-5">
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
