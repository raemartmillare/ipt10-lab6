<?php
session_start();
require "products.php";

$cart = $_SESSION['cart'] ?? [];
$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
           
        }
        table, th, td {
            border: 5px solid #000000;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        p {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
        .cart-empty {
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (!empty($cart)): ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $product_id => $details): ?>
                    <tr>
                        <td><?php echo $details['name']; ?></td>
                        <td><?php echo $details['price']; ?> PHP</td>
                        <td><?php echo $details['quantity']; ?></td>
                        <td><?php echo $details['price'] * $details['quantity']; ?> PHP</td>
                    </tr>
                    <?php $total_price += $details['price'] * $details['quantity']; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Price: <?php echo $total_price; ?> PHP</p>
    <?php else: ?>
        <p class="cart-empty">Your cart is empty.</p>
    <?php endif; ?>

    <a href="reset-cart.php">Clear my cart</a>
    <?php if (!empty($cart)): ?>
        <a href="place_order.php">Place the order</a>
    <?php endif; ?>
</body>
</html>
