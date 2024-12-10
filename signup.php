<?php
include 'includes/gen_header.php';
?>
<html>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
<body>
    <main>
        <div class="signup-page">
            <div class="signup-container">
                <div class="signup-image">
                    <img src="./images/signup_pizza.png" alt="Delicious pizza">
                </div>
                <div class="signup-form">
                    <h1>Join Us!</h1>
                    <p>Enter Your Details To Continue</p>
                    <form action="signupaction.php" method="POST">
                        <label for="first_name">What should we call you?</label>
                        <div class="name-fields">
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                        </div>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>

                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

                        <button type="submit">Get Started</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<?php
include 'includes/footer.php';
?>
