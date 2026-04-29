<?php
include('header.php');
include("../dboperation.php");
$obj = new dboperation();

// --- Payment Revenue by Students' Country ---
$query_revenue = "
SELECT co.country_name, IFNULL(SUM(p.advance_amount),0) AS total_payment
FROM tbl_student s
INNER JOIN tbl_city ci ON s.city_id = ci.city_id
INNER JOIN tbl_location lo ON ci.location_id = lo.location_id
INNER JOIN tbl_country co ON lo.country_id = co.country_id
LEFT JOIN tbl_payment p ON s.student_id = p.student_id
GROUP BY co.country_name
";
$res_revenue = $obj->executequery($query_revenue);
?>

<!-- Load Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawRevenueChart);

function drawRevenueChart() {
    var data = google.visualization.arrayToDataTable([
        ['Country', 'Payment Revenue (USD)'],
        <?php
        while($row = mysqli_fetch_array($res_revenue)) {
            echo "['".$row["country_name"]."', ".$row["total_payment"]."],";
        }
        ?>
    ]);

    var options = {
        chart: {
            title: 'Payment Revenue by Students\' Country',
            subtitle: 'Revenue collected from student payments per country'
        },
        bars: 'vertical',
        vAxis: {format: 'currency', currency: 'USD'},
        height: 500,
        bar: { groupWidth: "50%" },
        colors: ['#1b9e77'],
        legend: { position: 'none' },
        chartArea: {width: '70%', height: '70%'}
    };

    var chart = new google.charts.Bar(document.getElementById('revenueBarChart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

<style>
/* --- Page styling --- */
.wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f9f9f9;
    padding: 20px 0;
}

.main-panel {
    flex-grow: 1;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.chart-card {
    background: #fff;
    padding: 30px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 85%;
    max-width: 1000px;
    margin: 20px auto;
}

.chart-card h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-weight: 600;
}

#revenueBarChart {
    height: 500px !important;
}
</style>

<div class="wrapper">
    <div class="main-panel">
        <div class="chart-card">
            <h3>Payment Revenue by Students' Country</h3>
            <div id="revenueBarChart"></div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
