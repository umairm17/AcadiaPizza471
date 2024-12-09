<?php
include 'includes/cust_header.php';
?>

<html>
    <link rel="stylesheet" href="css/menu.css">
    <div class="menu-page">
    <aside class="menu-sidebar">
        <ul>
        <li><a href="#combos">Combos</a></li>
        <li><a href="#pizzas">Pizzas</a></li>
        <li><a href="#wings">Wings</a></li>
        <li><a href="#lasagnas">Lasagnas</a></li>
        <li><a href="#drinks">Drinks</a></li>
        <li><a href="#other">Other</a></li>
        </ul>
    </aside>

    <main class="menu-content">
        <section id="combos">
        <h2>Combos</h2>
        <div class="menu-item">
            <span>Combo A</span>
            <span class="item-price">$38.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Combo B</span>
            <span class="item-price">$45.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Combo C</span>
            <span class="item-price">$22.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>

        <section id="pizzas">
        <h2>Pizzas</h2>
        <div class="menu-item">
            <span>Pepperoni Pizza</span>
            <span class="item-price">$22.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Cheese Pizza</span>
            <span class="item-price">$22.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Meat Lover</span>
            <span class="item-price">$22.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>

        <section id="wings">
        <h2>Wings</h2>
        <div class="menu-item">
            <span>Spicy Wings</span>
            <span class="item-price">$13.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>BBQ Wings</span>
            <span class="item-price">$13.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Honey Garlic Wings</span>
            <span class="item-price">$13.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>

        <section id="lasagnas">
        <h2>Lasagnas</h2>
        <div class="menu-item">
            <span>Beef Lasagna</span>
            <span class="item-price">$12.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Chicken Lasagna</span>
            <span class="item-price">$12.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>Veggie Lasagna</span>
            <span class="item-price">$12.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>

        <section id="drinks">
        <h2>Drinks</h2>
        <div class="menu-item">
            <span>2L Pepsi</span>
            <span class="item-price">$4.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>2L Fanta</span>
            <span class="item-price">$4.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        <div class="menu-item">
            <span>2L Sprite</span>
            <span class="item-price">$4.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>

        <section id="other">
        <h2>Other</h2>
        <div class="menu-item">
            <span>Garlic Bread</span>
            <span class="item-price">$11.99</span>
            <div class="menu-actions">
                <button class="decrease">-</button>
                <span class="quantity">0</span>
                <button class="increase">+</button>
            </div>
        </div>
        </section>
    </main>
    </div>
    <script>
        let orderItems = [];

        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                const decreaseBtn = item.querySelector('.decrease');
                const increaseBtn = item.querySelector('.increase');
                const quantityDisplay = item.querySelector('.quantity');
                const itemName = item.querySelector('span:first-child').textContent;
                const itemPrice = parseFloat(item.querySelector('.item-price').textContent.replace('$', ''));
                
                let quantity = 0;
                
                decreaseBtn.addEventListener('click', () => {
                    if (quantity > 0) {
                        quantity--;
                        quantityDisplay.textContent = quantity;
                        updateOrderItems(itemName, itemPrice, quantity);
                    }
                });
                
                increaseBtn.addEventListener('click', () => {
                    quantity++;
                    quantityDisplay.textContent = quantity;
                    updateOrderItems(itemName, itemPrice, quantity);
                });
            });
        });

        function updateOrderItems(itemName, price, quantity) {
            const index = orderItems.findIndex(item => item.name === itemName);
            
            if (quantity === 0 && index !== -1) {
                orderItems.splice(index, 1);
            } else if (index !== -1) {
                orderItems[index].quantity = quantity;
            } else if (quantity > 0) {
                orderItems.push({
                    name: itemName,
                    price: price,
                    quantity: quantity
                });
            }
            
            // Store in session storage for checkout
            sessionStorage.setItem('orderItems', JSON.stringify(orderItems));
            
            // Calculate and update total
            const total = orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            console.log('Total: $' + total.toFixed(2));
        }
    </script>
</html>
<?php
include 'includes/footer.php';
?>
