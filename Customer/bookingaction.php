<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

$studid = $_SESSION["Login_id"];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate']; 
$request_date = date('Y-m-d');
$nopersons = $_POST['nopersons'];  
$house_id = $_GET['house_id'];

$sqlquery1 = "INSERT INTO tbl_homerequest (student_id,request_date,from_date,to_date,noofperson,house_id,status) 
              VALUES('$studid','$request_date','$fromdate','$todate','$nopersons','$house_id','requested')";

$result1 = $obj->executequery($sqlquery1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .confirmation-box {
            background: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            width: 90%;
            max-width: 500px;
            animation: fadeIn 0.8s ease-in-out;
        }
        .confirmation-box h2 {
            color: #28a745;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .confirmation-box p {
            color: #555;
            margin-bottom: 25px;
            font-size: 16px;
        }
        .confirmation-box .btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            margin: 8px;
            transition: all 0.3s ease;
        }
        .btn-bookings {
            background: #007bff;
            color: white;
        }
        .btn-bookings:hover {
            background: #0056b3;
        }
        .btn-home {
            background: #28a745;
            color: white;
        }
        .btn-home:hover {
            background: #1e7e34;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .fail h2 {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="confirmation-box <?php echo ($result1 == 1) ? '' : 'fail'; ?>">
    <?php if ($result1 == 1) { ?>
        <i class="fa-solid fa-circle-check fa-3x text-success mb-3"></i>
        <h2>Booking Successful!</h2>
        <p>Your booking has been placed successfully.<br>Thank you for choosing us!</p>

        <div>
            <a href="mybooking.php" class="btn btn-bookings">
                <i class="fa-solid fa-list"></i> View My Bookings
            </a>
            <a href="searchhouse.php" class="btn btn-home">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>

    <?php } else { ?>
        <i class="fa-solid fa-circle-xmark fa-3x text-danger mb-3"></i>
        <h2>Booking Failed!</h2>
        <p>Something went wrong. Please try again later.</p>

        <div>
            <a href="studenthome.php" class="btn btn-home">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>
    <?php } ?>
</div>

</body>
</html>
