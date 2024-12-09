<?php
include 'includes/cust_header.php';
?>
<?php
session_start();
// Clear the order session
unset($_SESSION['orderItems']);
?>

<html>
    <head>
        <link rel="stylesheet" href="css/orderconfirm.css">
    </head>
    <body>
        <div class="success-page">
            <div class="success-container">
                <h1>Order Successful!</h1>
                <p>Thank you for your order.</p>
                <a href="menu.php" class="return-btn">Return to Menu</a>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
