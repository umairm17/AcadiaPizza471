<?php
session_start();
require_once './includes/test.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $total_price = $_POST['total_price'];
    
    // Insert into ORDER table
    $sql = "INSERT INTO [ORDER] (customer_ID, totalPrice) VALUES (?, ?)";
    $params = array($customer_id, $total_price);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt) {
        $order_ID = /* Get the last inserted ID */
        
        // Insert order items
        $orderItems = json_decode($_SESSION['orderItems'], true);
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