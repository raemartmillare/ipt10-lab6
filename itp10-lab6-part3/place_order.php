<?php
session_start();
require "products.php";

$cart = $_SESSION['cart'] ?? [];
$total_price = 0;

// If cart is empty, redirect back to the cart page
if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

// Generate a random order code
$order_code = bin2hex(random_bytes(4)); // This will generate an 8-character random string
$date = date('Y-m-d H:i:s');

// Calculate the total price
foreach ($cart as $details) {
    $total_price += $details['price'] * $details['quantity'];
}

// Save order to file
$order_file = fopen("orders-{$order_code}.txt", 'w');
fwrite($order_file, "Order Code: {$order_code}\n");
fwrite($order_file, "Date: {$date}\n\n");
fwrite($order_file, "Items:\n");

foreach ($cart as $product_id => $details) {
    fwrite($order_file, "Product ID: {$product_id}, Name: {$details['name']}, Price: {$details['price']} PHP, Quantity: {$details['quantity']}\n");
}

fwrite($order_file, "\nTotal Price: {$total_price} PHP\n");
fclose($order_file);

// Clear the cart after placing the order
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }
        li span {
            font-weight: bold;
        }
        .order-summary {
            margin-top: 20px;
        }
        .order-details {
            background-color: #e9f7e9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <div class="order-details">
        <p><strong>Thank you for your order!</strong> Your order has been placed successfully.</p>
        <p><strong>Order Code:</strong> <?php echo $order_code; ?></p>
        <p><strong>Date:</strong> <?php echo $date; ?></p>
        <p><strong>Total Price:</strong> <?php echo $total_price; ?> PHP</p>
    </div>

    <h2>Order Summary:</h2>
    <ul class="order-summary">
        <?php foreach ($cart as $details): ?>
            <li>
                <span><?php echo $details['name']; ?></span> - <?php echo $details['price']; ?> PHP - Quantity: <?php echo $details['quantity']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
