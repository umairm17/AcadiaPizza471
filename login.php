<?php
include 'includes/gen_header.php';

// Include your database connection code.
$serverName = "acadiapizzaserver.database.windows.net";
$connectionOptions = [
    "Database" => "AcadiaPizzaDB",
    "Uid" => "Umair",
    "PWD" => "Wizzop13",
    "Encrypt" => true,
    "TrustServerCertificate" => false
];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Determine if we should show the alert
$showAlert = false;
if (isset($_GET['error']) && $_GET['error'] == '1') {
    $showAlert = true;
}

// Check if form is submitted
if (isset($_POST['login'])) {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if credentials match OWNER
    $sql = "SELECT * FROM OWNER WHERE Email = ? AND Password = ?";
    $params = array($email, $password);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $owner = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($owner) {
        // Valid credentials
        header("Location: adminhome.php");
        exit();
    } else {
        // Invalid credentials, redirect to the same page with an error flag
        header("Location: login.php?error=1");
        exit();
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
        <div class="login-page">
            <div class="login-container">
                <div class="login-image">
                    <img src="./images/loginpizza.png" alt="Delicious pizza">
                </div>
                <div class="login-form">
                    <h1>Welcome!</h1>
                    <p>Enter Your Details To Continue</p>
                    <form action="" method="POST">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        
                        <button type="submit" name="login">Get Started</button>

                        <?php if ($showAlert): ?>
                        <div class="alert alert-danger">
                            Invalid credentials. Please try again.
                        </div>
                        <?php endif; ?>
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
