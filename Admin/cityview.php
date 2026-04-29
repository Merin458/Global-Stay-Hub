<?php
include("header.php");
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // When country changes, load states
    $("#countrySelect").change(function () {
        var country_id = $(this).val();
        $.ajax({
            url: "getplace.php",
            method: "POST",
            data: { countryid: country_id },
            success: function (response) {
                $("#stateSelect").html(response);
                $("#districtSelect").html('<option value="">--- Select District ---</option>');
                $("#city").html('<tr><td colspan="3" class="text-muted">Please select a district to view cities.</td></tr>');
            },
            error: function () {
                $("#stateSelect").html("<option>Error while loading states!</option>");
            }
        });
    });

    // When state changes, load districts
    $("#stateSelect").change(function () {
        var state_id = $(this).val();
        $.ajax({
            url: "getcity.php",
            method: "POST",
            data: { locationid: state_id },
            success: function (response) {
                $("#city").html(response);
            },
            error: function () {
                $("#city").html("<option>Error while loading districts!</option>");
            }
        });
    });

});
</script>

<?php
include_once("../dboperation.php");
$sql = "SELECT * FROM tbl_country";
$obj = new dboperation();
$result = $obj->executequery($sql);
?>

<div class="container mt-4"> <!-- moved closer to top -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-bottom">
                    <h4 class="card-title mb-0 fw-semibold text-dark">
                        <i class="bi bi-building text-primary me-2"></i> View Cities
                    </h4>
                </div>
                <div class="card-body p-4">

                    <!-- Country Select -->
                    <div class="form-group mb-4">
                        <label class="fw-semibold mb-2">Select a Country</label>
                        <select class="form-control shadow-sm" name="countryname" id="countrySelect">
                            <option value="">--- Select Country ---</option>
                            <?php while ($r = mysqli_fetch_array($result)) { ?>
                                <option value="<?php echo $r["country_id"]; ?>">
                                    <?php echo $r["country_name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- State Select -->
                    <div class="form-group mb-4">
                        <label class="fw-semibold mb-2">Select a State</label>
                        <select class="form-control shadow-sm" name="statename" id="stateSelect">
                            <option value="">--- Select State ---</option>
                        </select>
                    </div>


                    <!-- City Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover text-center align-middle rounded-3 overflow-hidden">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 10%;">Sl.No</th>
                                    <th style="width: 60%;">City</th>
                                    <th style="width: 30%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="city">
                                <tr>
                                    <td colspan="3" class="text-muted">Please select a State to view cities.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
