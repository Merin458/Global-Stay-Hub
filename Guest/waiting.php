<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Approval</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0,0,0,0.4);
            font-family: Arial, Helvetica, sans-serif;
        }

        .popup-box {
            background: #fff;
            padding: 25px;
            width: 300px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .popup-box h3 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }

        .popup-box p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .close-btn {
            background: #007bff;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .close-btn:hover {
            background: #0056b3;
        }

        @keyframes fadeIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
</head>

<body>

    <div class="popup-box">
        <h3>Waiting for Approval</h3>
        <p>Your request has been submitted.<br>
           Please wait until the admin approves it.</p>

        <button class="close-btn" onclick="window.location.href='guestindex.php'">Close</button>
    </div>

</body>
</html>
