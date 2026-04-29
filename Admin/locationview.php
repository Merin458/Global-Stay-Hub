<?php
  include("header.php");
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#countrySelect").change(function() {
      var country_id = $(this).val();

      $.ajax({
        url: "getlocation.php",
        method: "POST",
        data: { countryid: country_id },
        success: function(response) {
          $("#location").html(response);
        },
        error: function() {
          $("#location").html("<tr><td colspan='3' class='text-danger'>Error occurred while getting location!</td></tr>");
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

<div class="d-flex justify-content-center mt-5 mb-5">
  <div class="col-md-8">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-white border-bottom">
        <h4 class="card-title mb-0 fw-semibold text-dark">
          <i class="bi bi-geo-alt-fill text-primary me-2"></i> View States
        </h4>
      </div>
      <div class="card-body p-4">
        <p class="card-description text-muted">Select a country to view its locations</p>

        <!-- Country Dropdown -->
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

        <!-- States Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
              <tr>
                <th style="width: 10%;">Sl.No</th>
                <th style="width: 60%;">State</th>
                <th style="width: 30%;">Actions</th>
              </tr>
            </thead>
            <tbody id="location">
              <!-- States will load here from getlocation.php -->
              <tr>
                <td colspan="3" class="text-muted">Please select a country to view states.</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
