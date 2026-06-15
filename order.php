<?php
session_start();
include("db.php");

$username = $_SESSION['user'];
$items    = $_POST['items'];
$total    = $_POST['total'];
$payment  = $_POST['payment'];
$address  = $_POST['address'];

// Simulate payment processing
$status = (rand(1, 10) > 2) ? "Successful" : "Failed";

// Save order to database
mysqli_query($conn,
    "INSERT INTO orders (username, items, total_amount, payment_method, delivery_address, order_status)
     VALUES ('$username', '$items', '$total', '$payment', '$address', '$status')"
);

$orderID = mysqli_insert_id($conn);

// Clear cart only if payment was successful
if ($status == "Successful") {
    mysqli_query($conn, "DELETE FROM cart WHERE username='$username'");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Status – Frosty Scoops</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <center>
            <?php if ($status == "Successful") { ?>
                <h1>🎉 Order Placed Successfully!</h1>
                <p>Your scoops are on their way!</p>
            <?php } else { ?>
                <h1>❌ Payment Failed</h1>
                <p>Please try again.</p>
            <?php } ?>

            <h2>Order ID: #<?php echo $orderID; ?></h2>
            <p><b>Items:</b> <?php echo $items; ?></p>
            <p><b>Payment:</b> <?php echo $payment; ?></p>
            <p><b>Amount:</b> ₹<?php echo $total; ?></p>
            <p><b>Delivery Address:</b> <?php echo $address; ?></p>

            <?php if ($status == "Successful") { ?>
                <p>🕐 Estimated Delivery: 20–30 mins</p>
            <?php } ?>

            <br>
            <a href="dashboard.php">
                <button>← Back to Menu</button>
            </a>
        </center>
    </div>

    <footer>
        <p>&copy; 2026 Frosty Scoops | Created by Ananya</p>
    </footer>
</body>
</html>
