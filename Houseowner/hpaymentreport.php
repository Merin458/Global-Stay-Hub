<?php
session_start();
include('../dboperation.php');
$obj = new dboperation();

// Check if owner is logged in
if (!isset($_SESSION["Login_id"])) {
    echo "<script>alert('Owner not logged in'); window.location='../login.php';</script>";
    exit;
}

$owner_id = $_SESSION["Login_id"];

// Get filter values
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date   = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$status    = isset($_GET['status']) ? $_GET['status'] : '';

// BUILD QUERY
$q = "
SELECT 
    p.payment_id,
    p.advance_amount,
    p.payment_date,
    p.status,
    p.admin_profit,
    s.student_name, 
    r.request_id
FROM tbl_payment p
JOIN tbl_homerequest r ON p.request_id = r.request_id
JOIN tbl_student s ON p.student_id = s.student_id
JOIN tbl_housedetails h ON r.house_id = h.house_id
WHERE h.owner_id = '$owner_id'
";

// Add filters
if($from_date != '' && $to_date != '') {
    $q .= " AND p.payment_date BETWEEN '$from_date' AND '$to_date'";
}

if($status != '') {
    $q .= " AND p.status = '$status'";
}

$q .= " ORDER BY p.payment_id DESC";

$data = $obj->executequery($q);

// Download CSV if requested
if(isset($_GET['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="payment_report.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Payment ID','Student Name','Request ID','Advance Amount','Payment Date','Status','Admin Profit'));
    if($data && mysqli_num_rows($data) > 0){
        while($row = mysqli_fetch_assoc($data)){
            fputcsv($output, array(
                $row['payment_id'],
                $row['student_name'],
                $row['request_id'],
                $row['advance_amount'],
                $row['payment_date'],
                ($row['status']==1 ? "Paid" : "Pending"),
                $row['admin_profit']
            ));
        }
    }
    fclose($output);
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #666; padding: 10px; text-align: center; }
        th { background: #333; color: white; }
        .filter, .buttons { margin-bottom: 15px; }
        .filter input, .filter select, .filter button { padding: 5px; margin-right: 5px; }
        button { cursor: pointer; }
    </style>
</head>
<body>

<h2>Payment Report</h2>

<!-- Back Button -->
<div class="buttons">
    <a href="houseregistration.php"><button type="button">Back</button></a>
</div>

<!-- Filter & Download -->
<div class="filter">
    <form method="GET">
        From: <input type="date" name="from_date" value="<?php echo $from_date; ?>">
        To: <input type="date" name="to_date" value="<?php echo $to_date; ?>">
        Status: 
        <select name="status">
            <option value="">All</option>
            <option value="1" <?php if($status=='1') echo 'selected'; ?>>Paid</option>
            <option value="0" <?php if($status=='0') echo 'selected'; ?>>Pending</option>
        </select>
        <button type="submit">Filter</button>
        <a href="?download=csv<?php 
            echo ($from_date && $to_date ? "&from_date=$from_date&to_date=$to_date" : ""); 
            echo ($status != '' ? "&status=$status" : ""); 
        ?>"><button type="button">Download CSV</button></a>
    </form>
</div>

<!-- Payment Table -->
<table>
    <tr>
        <th>Payment ID</th>
        <th>Student Name</th>
        <th>Request ID</th>
        <th>Advance Amount</th>
        <th>Payment Date</th>
        <th>Status</th>
        <th>Admin Profit</th>
    </tr>

    <?php
    if ($data && mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $row['payment_id']; ?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['request_id']; ?></td>
                <td><?php echo $row['advance_amount']; ?></td>
                <td><?php echo $row['payment_date']; ?></td>
                <td><?php echo ($row['status']==1 ? "Paid" : "Pending"); ?></td>
                <td><?php echo $row['admin_profit']; ?></td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>No payments found</td></tr>";
    }
    ?>
</table>

</body>
</html>
