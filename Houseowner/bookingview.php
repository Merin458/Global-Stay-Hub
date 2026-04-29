<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['Login_id'])) {
    echo "You must be logged in to see your property bookings.";
    exit;
}

$ownerid = $_SESSION['Login_id'];

// Handle Accept/Reject
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $request_id = intval($_GET['id']);

    if ($action == "accept") {
        $update = "UPDATE tbl_homerequest SET status='accepted' WHERE request_id='$request_id'";
    } elseif ($action == "reject") {
        $remark = $obj->con->real_escape_string($_GET['remark']); 
        $update = "UPDATE tbl_homerequest SET status='rejected', remarks='$remark' WHERE request_id='$request_id'";
    }
}

if (isset($update)) {
    $obj->executequery($update);
    header("Location: bookingview.php");
    exit;
}

// Fetch bookings
$sql = "SELECT b.request_id,
               s.student_name,
               s.gender,
               s.simage,
               s.id_proof,
               s.contact,
               s.email,
               s.city_id,
               s.regdate,
               h.house_name,
               b.from_date,
               b.to_date,
               b.noofperson,
               b.status
        FROM tbl_homerequest b
        INNER JOIN tbl_housedetails h ON b.house_id = h.house_id
        INNER JOIN tbl_student s ON b.student_id = s.student_id
        WHERE h.owner_id = '$ownerid'
        ORDER BY b.request_id DESC";

$res = $obj->executequery($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Property Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .student-img { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; }
        .id-proof { width: 100%; max-width: 200px; }
        .back-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        .back-btn:hover {
            background-color: #5a6268;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bookings for My Properties</h2>
        <a href="houseregistration.php" class="back-btn">← Back</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Sl No</th>
            <th>Student</th>
            <th>Email</th>
            <th>House</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>No. of Persons</th>
            <th>Status</th>
            <th>Student Info</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($res && $res->num_rows > 0) {
            $i = 1;
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['house_name'] . "</td>";
                echo "<td>" . $row['from_date'] . "</td>";
                echo "<td>" . $row['to_date'] . "</td>";
                echo "<td>" . $row['noofperson'] . "</td>";
                echo "<td>" . ucfirst($row['status']) . "</td>";

                // ✅ Student Info column
                echo "<td>";
                if ($row['status'] != "cancelled") {
                    echo "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#studentModal" . $row['request_id'] . "'>View Student</button>";
                } else {
                    echo "-";
                }
                echo "</td>";

                // ✅ Action column
                echo "<td>";
                if ($row['status'] == "requested") {
                    echo "<a href='bookingview.php?action=accept&id=" . $row['request_id'] . "' class='btn btn-success btn-sm me-1'>Accept</a>";
                    echo "<a href='#' class='btn btn-danger btn-sm me-1' onclick='rejectRequest(" . $row['request_id'] . ")'>Reject</a>";
                } elseif ($row['status'] == "accepted") {
                    echo "Waiting for Payment";
                } elseif ($row['status'] == "rejected") {
                    echo "Booking Rejected";
                } elseif ($row['status'] == "cancelled") {
                    echo "<span class='badge bg-secondary'>Cancelled by Student</span>";
                } elseif ($row['status'] == "paid") {
                    echo "Payment Successful";
                } else {
                    echo "Unknown Status";
                }
                echo "</td>";

                echo "</tr>";

                // ✅ Student Modal
                echo "
                <div class='modal fade' id='studentModal{$row['request_id']}' tabindex='-1' aria-labelledby='studentModalLabel{$row['request_id']}' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='studentModalLabel{$row['request_id']}'>Student Details</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <div class='text-center mb-3'>
                                    <img src='../uploads/{$row['simage']}' alt='Student Image' class='student-img'>
                                </div>
                                <p><strong>Name:</strong> {$row['student_name']}</p>
                                <p><strong>Gender:</strong> {$row['gender']}</p>
                                <p><strong>Contact:</strong> {$row['contact']}</p>
                                <p><strong>Email:</strong> {$row['email']}</p>
                                <p><strong>Registration Date:</strong> {$row['regdate']}</p>
                                <p><strong>ID Proof:</strong></p>
                                <img src='../uploads/{$row['id_proof']}' alt='ID Proof' class='id-proof'>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<tr><td colspan='10' class='text-center'>No bookings found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function rejectRequest(requestId) {
        var remark = prompt("Please enter a remark for rejecting this request:");
        if (remark !== null && remark.trim() !== "") {
            var encodedRemark = encodeURIComponent(remark);
            window.location.href = "bookingview.php?action=reject&id=" + requestId + "&remark=" + encodedRemark;
        } else {
            alert("Rejection cancelled. Remark is required.");
        }
    }
</script>
</body>
</html>
