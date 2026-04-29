<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['Login_id'])) {
    echo "You must be logged in to see your bookings.";
    exit;
}

$userid = $_SESSION['Login_id'];

// Handle cancellation
if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    $update = "UPDATE tbl_homerequest SET status='cancelled' WHERE request_id='$cancel_id' AND student_id='$userid'";
    $obj->executequery($update);
    header("Location: mybooking.php");
    exit;
}

// Fetch bookings
$sql = "SELECT b.request_id,
               h.house_name,
               b.from_date,
               b.to_date,
               b.noofperson,
               b.status
        FROM tbl_homerequest b
        LEFT JOIN tbl_housedetails h ON b.house_id = h.house_id
        WHERE b.student_id = '$userid'
        ORDER BY b.request_id DESC";

$res = $obj->executequery($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - Global Stay Hub</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f9fafc;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        .back-btn {
            border-radius: 50px;
            font-weight: 500;
        }
        .table th {
            text-align: center;
        }
        .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Row with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-primary"><i class="fas fa-book-open me-2"></i>My Bookings</h2>
        <a href="searchhouse.php" class="btn btn-secondary btn-sm back-btn">← Back</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
        <tr>
            <th>Sl No</th>
            <th>House</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>No. of Persons</th>
            <th>Status</th>
            <th>Action</th>
            <th>Cancel Booking</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($res && $res->num_rows > 0) {
            $i = 1;
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>".$row['house_name']."</td>";
                echo "<td>".$row['from_date']."</td>";
                echo "<td>".$row['to_date']."</td>";
                echo "<td>".$row['noofperson']."</td>";
                echo "<td>".ucfirst($row['status'])."</td>";

                // Action column
                echo "<td>";
                if ($row['status'] == "accepted") {
                    echo "<a href='payment.php?request_id=".$row['request_id']."' class='btn btn-primary btn-sm'>Proceed to Payment</a>";
                } elseif ($row['status'] == "paid") {
                    echo "<span class='badge bg-success'>Payment Completed</span>";
                } elseif ($row['status'] == "requested") {
                    echo "<span class='badge bg-warning text-dark'>Waiting for Owner</span>";
                } elseif ($row['status'] == "rejected") {
                    echo "<span class='badge bg-danger'>Rejected</span>";
                } elseif ($row['status'] == "cancelled") {
                    echo "<span class='badge bg-secondary'>Cancelled</span>";
                } else {
                    echo "<span class='badge bg-info text-dark'>Processing</span>";
                }
                echo "</td>";

                // Cancel Booking column
                echo "<td>";
                if ($row['status'] == "requested" || $row['status'] == "accepted") {
                    echo "<a href='mybooking.php?cancel_id=".$row['request_id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>";
                } else {
                    echo "-";
                }
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-muted'>No bookings found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Icons + Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
