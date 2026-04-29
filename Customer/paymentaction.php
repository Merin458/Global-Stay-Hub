<?php
include('../dboperation.php');
session_start();

$obj = new dboperation();

// Check if form submitted
if (isset($_POST['request_id'], $_POST['advance_amount'], $_POST['card_name'])) {

    $request_id = intval($_POST['request_id']);
    $advance_amount = floatval($_POST['advance_amount']);
    $card_name = trim($_POST['card_name']);

    // Fetch student_id and house_id
    $res = $obj->executequery("SELECT student_id, house_id FROM tbl_homerequest WHERE request_id = $request_id");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $student_id = $row['student_id'];
        $house_id = $row['house_id'];
    } else {
        die("Booking not found. Payment failed.");
    }

    // Admin profit = 10%
    $admin_profit = $advance_amount * 0.10;

    $payment_date = date('Y-m-d');
    $status = 1;

    // Insert payment
    $sql =  "INSERT INTO tbl_payment (request_id, student_id, advance_amount, admin_profit, payment_date, status) 
        VALUES ('$request_id', '$student_id', '$advance_amount', '$admin_profit', '$payment_date', '$status')";

    $insert_res = $obj->executequery($sql);

    if ($insert_res) {

        // Update booking status
        $obj->executequery("UPDATE tbl_homerequest SET status='paid' WHERE request_id='$request_id'");

        // Mark house sold out
        $obj->executequery("UPDATE tbl_housedetails SET status='sold out' WHERE house_id='$house_id'");

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Payment Successful</title>

        <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 450px;
        }
        .success-container h1 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-container p {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 5px;
            transition: 0.3s;
        }
        .back-btn {
            background: #28a745;
            color: white;
        }
        .back-btn:hover {
            background: #218838;
        }
        .invoice-btn {
            background: #007bff;
            color: white;
        }
        .invoice-btn:hover {
            background: #0069d9;
        }
        </style>

        </head>
        <body>

        <div class="success-container">
            <h1>Payment Successful!</h1>

            <p>Dear <strong><?php echo htmlspecialchars($card_name); ?></strong>,</p>
            <p>Your payment has been completed successfully.</p>

            <p><strong>Amount Paid:</strong> ₹<?php echo number_format($advance_amount, 2); ?></p>

            <!-- 🔵 DOWNLOAD INVOICE BUTTON -->
            <a href="download_invoice.php?request_id=<?php echo $request_id; ?>" class="btn invoice-btn">
                Download Invoice
            </a>

            <!-- 🟢 BACK BUTTON -->
            <br>
            <a href="mybooking.php" class="btn back-btn">Back to My Bookings</a>
        </div>

        </body>
        </html>

        <?php

    } else {
        die("Payment failed. Please try again.");
    }

} else {
    die("Invalid request. Missing payment information.");
}
?>
