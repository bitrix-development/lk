<?php
// pages/orders.php

require_once('db_config.php');  // Include database configuration file

// Fetch orders from database with filters
function fetchOrders($filters) {
    global $db;
    $sql = 'SELECT * FROM orders WHERE 1=1';
    $params = [];

    // Apply filters if provided
    if (!empty($filters['date_from'])) {
        $sql .= ' AND order_date >= ?';
        $params[] = $filters['date_from'];
    }
    if (!empty($filters['date_to'])) {
        $sql .= ' AND order_date <= ?';
        $params[] = $filters['date_to'];
    }
    if (!empty($filters['status'])) {
        $sql .= ' AND status = ?';
        $params[] = $filters['status'];
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Example usage
$filters = [
    'date_from' => '2026-01-01',
    'date_to' => '2026-02-16',
    'status' => 'completed'
];
$orders = fetchOrders($filters);

// Display orders
foreach ($orders as $order) {
    echo "Order ID: {$order['id']} - Status: {$order['status']} - Date: {$order['order_date']}\n";
}
?>