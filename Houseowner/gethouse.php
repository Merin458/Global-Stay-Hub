<?php
include_once("../dboperation.php");
$sql = "select * from tbl_country";
$obj = new dboperation();
$result = $obj->executequery($sql);
?>

<script src="../jquery-3.6.0.min.js"> </script>
<script>
    $(document).ready(function () {
        $("#countrySelect").change(function () {
            var country_id = $(this).val();


            $.ajax({
                url: "getlocation.php",
                method: "POST",
                data: { countryid: country_id },
                success: function (response) {
                    $("#locationSelect").html(response);
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
                    $("#citySelect").html("Error occurred while getting location!");
                }
            });
        });

        $("#citySelect").change(function () {
            var city_id = $(this).val();
            
            $.ajax({
                url: "getuniversity.php",
                method: "POST",
                data: { cityid: city_id },
                success: function (response) {
                    $("#universitySelect").html(response);
                },
                error: function () {
                    $("#universitySelect").html("Error occurred while getting university!");
                }
            });
        });


    });
</script>
<?php
if (isset($_POST["countryid"])) {
    $cityid = $_POST["countryid"];
    if ($cityid == "city") {
        ?>
        <div class="mb-4">
            
            <select class="form-control" name="countryname" id="countrySelect">
                        <option value="">---SELECT COUNTRY---</option>
                        <?php
                        while ($r = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $r["country_id"]; ?>">
                                <?php echo $r["country_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
        </div>
        <div class="mb-4">
            
            <select class="form-control" name="locationname" id="locationSelect">
                        <option value="">---SELECT STATE---</option>
             </select>

        <div class="mb-4">

            <select class="form-control" name="cityname" id="citySelect" >
                        <option value="">---SELECT CITY---</option>
             </select>


        </div>
    <?php
    }else{
        ?>
        <div class="mb-4">
            
            <select class="form-control" name="countryname" id="countrySelect">
                        <option value="">---SELECT COUNTRY---</option>
                        <?php
                        while ($r = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $r["country_id"]; ?>">
                                <?php echo $r["country_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
            
        </div>
        <div class="mb-4">
            
            <select class="form-control" name="locationname" id="locationSelect">
                         <option value="">---SELECT STATE---</option> 
             </select>
        <div class="mb-4">

            
            <select class="form-control" name="cityname" id="citySelect">
                         <option value="">---SELECT CITY---</option> 
             </select>

            
        </div>
        <div class="mb-4">
           
            <select class="form-control" name="universityname" id="universitySelect">
                         <option value="">---SELECT UNIVERSITY---</option> 
             </select>

            
        </div>
        <?php
    }
}
?>