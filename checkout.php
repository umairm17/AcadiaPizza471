<?php
include 'includes/cust_header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="css/checkout.css">
    </head>
    <body>
        <div class="checkout-page">
            <div class="checkout-container">
                <!-- Checkout Form Section -->
                <div class="checkout-form">
                    <h1>Checkout</h1>
                    <form action="process_payment.php" method="POST">
                        <label for="cardholder-name">Cardholder's Name</label>
                        <input type="text" id="cardholder-name" name="cardholder-name" placeholder="Enter your name" required>
                        
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                        
                        <div class="expiry-cvc">
                            <div>
                                <label for="expiry">Expiry</label>
                                <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                            </div>
                            <div>
                                <label for="cvc">CVC</label>
                                <input type="text" id="cvc" name="cvc" placeholder="CVC" required>
                            </div>
                        </div>
                        
                        <label for="coupon">Coupon</label>
                        <div class="coupon-input">
                            <input type="text" id="coupon" name="coupon" placeholder="Enter coupon code">
                            <button type="button" class="apply-btn">Apply</button>
                        </div>
                        
                        <button type="submit" class="pay-btn" onclick="window.location.href='orderconfirm.php'">Pay</button>
                    </form>
                </div>
                
                <!-- Order Summary Section -->
                <div class="checkout-summary">
                    <h2>Your total is</h2>
                    <h3>$84.00</h3>
                    <div class="order-summary">
                        <p>Combo A <span>$80.00</span></p>
                        <hr>
                        <p>Tax <span>$4.00</span></p>
                        <hr>
                        <p><strong>Total</strong> <span><strong>$84.00</strong></span></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
