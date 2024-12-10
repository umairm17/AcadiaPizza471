<?php
session_start();
require_once './includes/test.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $orderItems = json_decode($_POST['orderItems'], true);
    
    // Calculate total from order items
    $total_price = 0;
    foreach ($orderItems as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
    
    // Add tax
    $total_price = $total_price * 1.05; // 5% tax
    
    // Insert into ORDER table
    $sql = "INSERT INTO [ORDER] (customer_ID, totalPrice) VALUES (?, ?)";
    $params = array($customer_id, $total_price);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt) {
        // Get the last inserted ID
        $result = sqlsrv_query($conn, "SELECT SCOPE_IDENTITY()");
        $row = sqlsrv_fetch_array($result);
        $order_ID = $row[0];
        
        // Insert order items
        foreach ($orderItems as $item) {
            $sql = "INSERT INTO ORDER_ITEMS (order_ID, menuitem_ID, quantity, itemPrice) 
                   VALUES (?, (SELECT menuitem_id FROM MENUITEMS WHERE itemname = ?), ?, ?)";
            $params = array($order_ID, $item['name'], $item['quantity'], $item['price']);
            sqlsrv_query($conn, $sql, $params);
        }
        
        // Redirect to confirmation page
        header('Location: orderconfirm.php');
    }
}
?>