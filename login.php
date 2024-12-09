<?php
include 'includes/gen_header.php';
?>

<html>
    <link rel="stylesheet" href="css/login.css">
    <main>
    <div class="login-page">
    <div class="login-container">
        <div class="login-image">
        <img src="./images/loginpizza.png" alt="Delicious pizza">
        </div>
        <div class="login-form">
        <h1>Welcome!</h1>
        <p>Enter Your Details To Continue</p>
        <form action="login_action.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            
            <button type="submit">Get Started</button>
        </form>
        </div>
    </div>
    </div>
</main>
</html>

<?php
include 'includes/footer.php';
?>
