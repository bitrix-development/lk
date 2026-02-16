<?php
// order_detail.php

// Function to display order details
function displayOrderDetails($orderId) {
    // Placeholder for order details retrieval logic
    // This would typically involve fetching data from a database
    
    // Example order details (mock data)
    $orderDetails = [
        'order_id' => $orderId,
        'customer_name' => 'John Doe',
        'order_date' => '2026-02-16',
        'total_amount' => '99.99',
    ];
    
    // Display order details
    echo '<h1>Order Details</h1>';
    echo '<p>Order ID: ' . $orderDetails['order_id'] . '</p>';
    echo '<p>Customer Name: ' . $orderDetails['customer_name'] . '</p>';
    echo '<p>Order Date: ' . $orderDetails['order_date'] . '</p>';
    echo '<p>Total Amount: $' . $orderDetails['total_amount'] . '</p>';
}

// Assuming an order ID is passed to the script
$orderId = isset($_GET['order_id']) ? $_GET['order_id'] : 1;

// Call the function to display order details
displayOrderDetails($orderId);
?>