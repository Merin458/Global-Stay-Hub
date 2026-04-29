<?php
include('../dboperation.php');

$obj = new dboperation();
$advance = 0; // default value

// Step 1: Get house_id from request_id
if (isset($_GET['request_id'])) {
    $request_id = intval($_GET['request_id']); // sanitize input

    $sql = "SELECT house_id FROM tbl_homerequest WHERE request_id = $request_id";
    $res = $obj->executequery($sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $house_id = $row['house_id'];
    } else {
        echo "Booking not found!";
        exit;
    }
} else {
    echo "Booking ID not provided!";
    exit;
}

// Step 2: Fetch rate from tbl_housedetails using house_id
$sql2 = "SELECT rate FROM tbl_housedetails WHERE house_id = $house_id";
$result2 = $obj->executequery($sql2);

if ($result2 && mysqli_num_rows($result2) > 0) {
    $house = mysqli_fetch_assoc($result2);
    $advance = $house['rate'] / 2; // calculate advance
} else {
    echo "House not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Page</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.payment-container {
    position: relative;
    background: #fff;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 400px;
}

/* ❌ Close button */
.close-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #dee2e6;
    color: #333;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s;
}
.close-btn:hover {
    background: #ced4da;
    transform: scale(1.1);
}

.payment-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}
.form-group {
    margin-bottom: 15px;
}
label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}
input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}
input:focus {
    border-color: #6c757d;
    outline: none;
}
.form-row {
    display: flex;
    gap: 10px;
}
.form-row .form-group {
    flex: 1;
}

/* ✅ Pay button - green */
.pay-btn {
    width: 100%;
    background: #28a745;
    color: white;
    padding: 14px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s;
}
.pay-btn:hover {
    background: #218838;
    transform: scale(1.02);
}

/* ✅ Back button - gray, same width */
.back-btn {
    width: 100%;
    display: block;
    background-color: #dee2e6;
    color: #2c3e50;
    padding: 14px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 6px;
    margin-top: 10px;
    transition: background 0.3s ease, transform 0.2s;
}
.back-btn:hover {
    background-color: #ced4da;
    transform: scale(1.02);
}

.note {
    text-align: center;
    font-size: 12px;
    color: gray;
    margin-top: 15px;
}
.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
</style>

<script>
function validatePaymentForm() {
    let valid = true;
    document.querySelectorAll('.error-message').forEach(el => el.innerText = "");

    const cardName = document.forms["paymentForm"]["card_name"].value.trim();
    const cardNumber = document.forms["paymentForm"]["card_number"].value.replace(/\s+/g,'');
    const expiry = document.forms["paymentForm"]["expiry"].value.trim();
    const cvv = document.forms["paymentForm"]["cvv"].value.trim();

    if (cardName.length < 3) {
        document.getElementById("cardNameError").innerText = "Card holder name must be at least 3 characters.";
        valid = false;
    }
    if (!/^\d{16}$/.test(cardNumber)) {
        document.getElementById("cardNumberError").innerText = "Card number must be 16 digits.";
        valid = false;
    }
    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
        document.getElementById("expiryError").innerText = "Expiry must be in MM/YY format.";
        valid = false;
    }
    if (!/^\d{3}$/.test(cvv)) {
        document.getElementById("cvvError").innerText = "CVV must be 3 digits.";
        valid = false;
    }
    return valid;
}
</script>
</head>
<body>
<div class="payment-container">

    <!-- ❌ Close button -->
    <button class="close-btn" onclick="window.location.href='mybooking.php'">&times;</button>

    <h2>Payment Details</h2>
    <form name="paymentForm" method="POST" action="paymentaction.php" onsubmit="return validatePaymentForm()">
        <div class="form-group">
            <label>Card Holder Name</label>
            <input type="text" name="card_name" placeholder="Enter card holder name" required>
            <div id="cardNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label>Card Number</label>
            <input type="text" name="card_number" placeholder="1111 2222 3333 4444" maxlength="16" required>
            <div id="cardNumberError" class="error-message"></div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Expiry</label>
                <input type="text" name="expiry" placeholder="MM/YY" required>
                <div id="expiryError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>CVV</label>
                <input type="password" name="cvv" placeholder="***" maxlength="3" required>
                <div id="cvvError" class="error-message"></div>
            </div>
        </div>

        <!-- Dynamic advance amount -->
        <button type="submit" class="pay-btn">Pay $<?php echo number_format($advance, 2); ?></button>
        <input type="hidden" name="advance_amount" value="<?php echo $advance; ?>">
        <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
    </form>

    
    <p class="note">Secure Payment • Encrypted Transaction</p>
</div>
</body>
</html>
