<?php
  include("header.php");
?>
<script src="../jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When country changes, load locations
    $("#countrySelect").change(function() {
        var country_id = $(this).val();
        $.ajax({
            url: "getplace.php",
            method: "POST",
            data: {countryid : country_id },
            success: function(response) {
                $("#locationSelect").html(response);
                $("#citySelect").html('<option value="">--------Select City-----------</option>');
                $("#uni").html('');
            },
            error: function() {
                $("#locationSelect").html("Error occurred while getting location!");
            }
        });
    });

    // When location changes, load cities
    $("#locationSelect").change(function() {
        var location_id = $(this).val();
        $.ajax({
            url: "getcity2.php",
            method: "POST",
            data: {locationid : location_id },
            success: function(response) {
                $("#citySelect").html(response);
                $("#uni").html('');
            },
            error: function() {
                $("#citySelect").html("Error occurred while getting city!");
            }
        });
    });

    // When city changes, load universities
    $("#citySelect").change(function() {
        var city_id = $(this).val();
        $.ajax({
            url: "getuni.php",
            method: "POST",
            data: {cityid : city_id },
            success: function(response) {
                $("#uni").html(response);
            },
            error: function() {
                $("#uni").html("Error occurred while getting university!");
            }
        });
    });
});
</script>
</head>
<body>  
<?php
    include_once("../dboperation.php");
    $sql="select * from tbl_country";
    $obj=new dboperation();
    $result=$obj->executequery($sql);
?>


<div class="container my-5">
  <div class="row justify-content">
    <div class="col-md-6 grid-margin stretch-card" style="margin-left: 10%;">
      <div class="card"  style="width:150%;">
        <div class="card-body">
          <h4 class="card-title">View University</h4>
          <p class="card-description">Select a country to view locations</p>
     
        <div class="form-group">
          <label>Select a Country</label>
          <select class="form-control" name="countryname" id="countrySelect">
            <option value="">---Select Country---</option>
            <?php
            while ($r = mysqli_fetch_array($result)) 
            { ?>
              <option value="<?php echo $r["country_id"]; ?>">
                <?php echo $r["country_name"]; ?>
              </option>
            <?php } ?>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

          </select>               
        </div>
        <div class="form-group">
          <label>Select location</label>
          <select class="form-control" name="locationname" id="locationSelect">
            <option value="">---Select Location---</option>
          </select>
        </div>

        <div class="form-group">
          <label>Select City</label>
          <select class="form-control" name="cityname" id="citySelect">
            <option value="">---Select City---</option>
          </select>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>University Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="uni">
              <!-- University rows will be loaded here by AJAX -->
            </tbody>
        </table>
    </div>
  </div>
</div>
</body>
</html>
<?php
  include("footer.php");
  ?>