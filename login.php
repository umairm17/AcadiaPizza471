<?php
include 'includes/gen_header.php';

// Include your database connection
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

// Initialize error message variable
$errorMsg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Check if the user is OWNER (plaintext check)
    $sqlOwner = "SELECT * FROM OWNER WHERE Email = ? AND Password = ?";
    $paramsOwner = array($email, $password);
    $stmtOwner = sqlsrv_query($conn, $sqlOwner, $paramsOwner);

    if ($stmtOwner === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $owner = sqlsrv_fetch_array($stmtOwner, SQLSRV_FETCH_ASSOC);

    if ($owner) {
        // OWNER found
        header("Location: adminhome.php");
        exit();
    }

    // 2. Check if the user is CUSTOMER (hashed password)
    $sqlCustomer = "SELECT * FROM CUSTOMER WHERE Email = ?";
    $paramsCustomer = array($email);
    $stmtCustomer = sqlsrv_query($conn, $sqlCustomer, $paramsCustomer);

    if ($stmtCustomer === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $customer = sqlsrv_fetch_array($stmtCustomer, SQLSRV_FETCH_ASSOC);
    
    if ($customer) {
        // Email found, now verify password
        $hashedPassword = $customer['Password']; 
        if (password_verify($password, $hashedPassword)) {
            // Correct CUSTOMER password
            header("Location: menu.php");
            exit();
        } else {
            // Email found, but password didn't match
            $errorMsg = "Invalid customer password.";
        }
    } else {
        // Not OWNER or CUSTOMER
        $errorMsg = "Invalid credentials. Please try again.";
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

                        <?php if (!empty($errorMsg)): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($errorMsg); ?>
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
