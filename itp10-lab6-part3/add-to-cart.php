<?php
session_start();
require "products.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Check if product exists in products array
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            // If product is already in cart, increment quantity, else add to cart
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];
            }
            break;
        }
    }
}

// Redirect to the cart page
header("Location: cart.php");
exit;
?>
