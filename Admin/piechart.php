<?php
include ('header.php');
include("../dboperation.php");
$obj = new dboperation();

// --- Student entries by country ---
$query_students = "SELECT co.country_name, COUNT(s.student_id) AS entry_count
                   FROM tbl_student s
                   INNER JOIN tbl_city ci ON s.city_id = ci.city_id
                   INNER JOIN tbl_location lo ON ci.location_id = lo.location_id
                   INNER JOIN tbl_country co ON lo.country_id = co.country_id
                   GROUP BY co.country_name";
$res_students = $obj->executequery($query_students);

// --- House availability by country ---
$query_houses = "
SELECT co.country_name, COUNT(h.house_id) AS house_count
FROM tbl_housedetails h
LEFT JOIN tbl_city c1 
       ON h.house_type = 'city' AND h.id = c1.city_id
LEFT JOIN tbl_university u1 
       ON h.house_type = 'university' AND h.id = u1.university_id
LEFT JOIN tbl_city c2 
       ON h.house_type = 'university' AND u1.city_id = c2.city_id
LEFT JOIN tbl_location l 
       ON (h.house_type = 'city' AND c1.location_id = l.location_id)
       OR (h.house_type = 'university' AND c2.location_id = l.location_id)
LEFT JOIN tbl_country co 
       ON l.country_id = co.country_id
GROUP BY co.country_name
";
$res_houses = $obj->executequery($query_houses);

// --- Houseowners by country ---
$query_owners = "
SELECT co.country_name, COUNT(DISTINCT h.owner_id) AS owner_count
FROM tbl_housedetails h
LEFT JOIN tbl_city c1 
       ON h.house_type = 'city' AND h.id = c1.city_id
LEFT JOIN tbl_university u1 
       ON h.house_type = 'university' AND h.id = u1.university_id
LEFT JOIN tbl_city c2 
       ON h.house_type = 'university' AND u1.city_id = c2.city_id
LEFT JOIN tbl_location l 
       ON (h.house_type = 'city' AND c1.location_id = l.location_id)
       OR (h.house_type = 'university' AND c2.location_id = l.location_id)
LEFT JOIN tbl_country co 
       ON l.country_id = co.country_id
GROUP BY co.country_name
";
$res_owners = $obj->executequery($query_owners);
?>

<!-- Load Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawCharts);  

function drawCharts() {  

    // --- Student Pie Chart ---
    var dataStudents = google.visualization.arrayToDataTable([
        ['Country', 'Students'],  
        <?php  
        while($row = mysqli_fetch_array($res_students)) {  
            echo "['".$row["country_name"]."', ".$row["entry_count"]."],";  
        }  
        ?>
    ]);
    var optionsStudents = {
        title: 'Student Entries by Country',
        pieHole: 0.4,
        is3D: true
    };
    var chartStudents = new google.visualization.PieChart(document.getElementById('studentPieChart'));
    chartStudents.draw(dataStudents, optionsStudents);

    // --- House Pie Chart ---
    var dataHouses = google.visualization.arrayToDataTable([
        ['Country', 'Houses'],  
        <?php  
        while($row = mysqli_fetch_array($res_houses)) {  
            echo "['".$row["country_name"]."', ".$row["house_count"]."],";  
        }  
        ?>
    ]);
    var optionsHouses = {
        title: 'House Availability by Country',
        pieHole: 0.4,
        is3D: true
    };
    var chartHouses = new google.visualization.PieChart(document.getElementById('housePieChart'));
    chartHouses.draw(dataHouses, optionsHouses);

    // --- Houseowners Pie Chart ---
    var dataOwners = google.visualization.arrayToDataTable([
        ['Country', 'Houseowners'],  
        <?php  
        while($row = mysqli_fetch_array($res_owners)) {  
            echo "['".$row["country_name"]."', ".$row["owner_count"]."],";  
        }  
        ?>
    ]);
    var optionsOwners = {
        title: 'Houseowners by Country',
        pieHole: 0.4,
        is3D: true
    };
    var chartOwners = new google.visualization.PieChart(document.getElementById('ownersPieChart'));
    chartOwners.draw(dataOwners, optionsOwners);

}
</script>  

<div class="wrapper d-flex flex-column min-vh-100">
    <div class="main-panel">
        
        
        
        <div class="row mt-4">
            <!-- Student Entries Pie Chart -->
            <div class="col-4">
                <h4 align="center">Student Entries by Country</h4>
                <div id="studentPieChart" style="height: 400px;"></div>
            </div>
            <!-- House Availability Pie Chart -->
            <div class="col-4">
                <h4 align="center">House Availability by Country</h4>
                <div id="housePieChart" style="height: 400px;"></div>
            </div>
            <!-- Houseowners Pie Chart -->
            <div class="col-4">
                <h4 align="center">Houseowners by Country</h4>
                <div id="ownersPieChart" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<?php
include ('footer.php');
?>
