<?php
include('../dboperation.php');
$obj = new dboperation();

// Validate request_id
if (!isset($_GET['request_id'])) {
    echo "<script>alert('Invalid Request ID'); window.location='mybooking.php';</script>";
    exit;
}

$request_id = intval($_GET['request_id']);

// Fetch payment + student details
$sql = "
SELECT 
    p.payment_id,
    p.advance_amount,
    p.payment_date,
    s.student_name,
    s.email,
    h.house_id
FROM tbl_payment p
INNER JOIN tbl_homerequest r ON p.request_id = r.request_id
INNER JOIN tbl_student s ON r.student_id = s.student_id
INNER JOIN tbl_housedetails h ON r.house_id = h.house_id
WHERE p.request_id = '$request_id'
";

$res = $obj->executequery($sql);

if (!$res || mysqli_num_rows($res) == 0) {
    echo "<script>alert('No Invoice Found'); window.location='mybooking.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($res);

// Fetch house details
$house = $obj->executequery("SELECT house_name, rate FROM tbl_housedetails WHERE house_id='" . $row['house_id'] . "'");
$house = mysqli_fetch_assoc($house);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice <?php echo $row['payment_id']; ?></title>

    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .invoice-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            width: 750px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h2, h4 { text-align: center; margin: 0; }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 15px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .welcome-box {
            margin-top: 25px;
            background: #f8f9ff;
            padding: 20px;
            border-left: 5px solid #4d79ff;
            border-radius: 8px;
            font-size: 15px;
            line-height: 1.6;
        }
        .btn {
            padding: 10px 18px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }
        .print-btn { background: #007bff; }
        .back-btn { background: #444; }
    </style>
</head>

<body>

<div class="invoice-box">
    <h2>Payment Invoice</h2>
    <h4>Global Stay Hub</h4>

    <table>
        <tr><td><b>Invoice ID</b></td> <td><?php echo $row['payment_id']; ?></td></tr>
        <tr><td><b>Payment Date</b></td> <td><?php echo $row['payment_date']; ?></td></tr>
        <tr><td><b>Student Name</b></td> <td><?php echo $row['student_name']; ?></td></tr>
        <tr><td><b>Email</b></td> <td><?php echo $row['email']; ?></td></tr>
        <tr><td><b>House Name</b></td> <td><?php echo $house['house_name']; ?></td></tr>
        <tr><td><b>House Rate</b></td> <td>₹<?php echo $house['rate']; ?></td></tr>
        <tr><td><b>Advance Paid</b></td> <td><b>₹<?php echo $row['advance_amount']; ?></b></td></tr>
    </table>

    <!-- WELCOME LETTER -->
    <div class="welcome-box">
        <b>Dear <?php echo $row['student_name']; ?>,</b>
        <br><br>
        We are delighted to welcome you to your new stay at 
        <b><?php echo $house['house_name']; ?></b>. Thank you for choosing 
        <b>Global Stay Hub</b> as your trusted accommodation partner.
        <br><br>

        <b> Important Instructions:</b>
        <ul>
            <li>Please bring a valid <b>Government ID Proof</b> when you visit the house.</li>
            <li>You must also carry a printed copy of this <b>Invoice</b> for verification.</li>
            <li>The house owner will verify your identity and booking details before check-in.</li>
        </ul>

        We look forward to ensuring you have a comfortable and safe stay.
        <br><br>

        <b>Warm Regards,</b><br>
        Global Stay Hub Team
    </div>

    <center>
        <button onclick="window.print()" class="btn print-btn">Download / Print Invoice</button>
        <a href="mybooking.php" class="btn back-btn">Back</a>
    </center>
</div>

</body>
</html>
