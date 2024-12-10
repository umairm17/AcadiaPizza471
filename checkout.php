<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
    exit();
}

include './includes/cust_header.php';
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
                            
                            <input type="hidden" name="total_amount" id="total_amount">
                            <input type="hidden" name="orderItems" id="orderItems">
                            <button type="submit" class="pay-btn">Pay</button>
                        </form>
                    </div>

                    <script>
                        document.querySelector('form').addEventListener('submit', function(e) {
                            document.getElementById('orderItems').value = sessionStorage.getItem('orderItems');
                        });
                    </script>
                    
                    <!-- Order Summary Section -->
                    <div class="checkout-summary">
                        <h2>Your total is</h2>
                        <h3 id="total-display">$0.00</h3>
                        <div id="order-summary" class="order-summary">
                            <!-- Items will be dynamically populated -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Get order items from sessionStorage
                    const orderItems = JSON.parse(sessionStorage.getItem('orderItems')) || [];
                    const summaryDiv = document.getElementById('order-summary');
                    const totalDisplay = document.getElementById('total-display');
                    let subtotal = 0;

                    // Display each ordered item
                    orderItems.forEach(item => {
                        const itemTotal = item.price * item.quantity;
                        subtotal += itemTotal;
                        summaryDiv.innerHTML += `
                            <p>${item.name} x${item.quantity} <span>$${itemTotal.toFixed(2)}</span></p>
                            <hr>
                        `;
                    });

                    // Calculate and display tax and total
                    const tax = subtotal * 0.05;
                    const total = subtotal + tax;

                    // Add tax and total to summary
                    summaryDiv.innerHTML += `
                        <p>Subtotal <span>$${subtotal.toFixed(2)}</span></p>
                        <hr>
                        <p>Tax (5%) <span>$${tax.toFixed(2)}</span></p>
                        <hr>
                        <p><strong>Total</strong> <span><strong>$${total.toFixed(2)}</strong></span></p>
                    `;

                    // Update the total display at the top
                    totalDisplay.textContent = `$${total.toFixed(2)}`;
                });
            </script>
        </body>
    </html>

<?php
include 'includes/footer.php';
?>
