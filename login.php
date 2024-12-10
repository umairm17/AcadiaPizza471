<?php
session_start();
include 'includes/gen_header.php';

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

$errorMsg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlOwner = "SELECT * FROM OWNER WHERE Email = ? AND Password = ?";
    $paramsOwner = array($email, $password);
    $stmtOwner = sqlsrv_query($conn, $sqlOwner, $paramsOwner);

    if ($stmtOwner === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $owner = sqlsrv_fetch_array($stmtOwner, SQLSRV_FETCH_ASSOC);

    if ($owner) {
        header("Location: adminhome.php");
        exit();
    }

    $sqlCustomer = "SELECT * FROM CUSTOMER WHERE Email = ?";
    $paramsCustomer = array($email);
    $stmtCustomer = sqlsrv_query($conn, $sqlCustomer, $paramsCustomer);

    if ($stmtCustomer === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $customer = sqlsrv_fetch_array($stmtCustomer, SQLSRV_FETCH_ASSOC);

    if ($customer) {
        $hashedPassword = $customer['Password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['customer_id'] = $customer['Customer_ID'];
            header("Location: menu.php");
            exit();
        } else {
            $errorMsg = "Invalid customer password. Please try again.";
        }
    } else {
        $sqlEmployee = "SELECT * FROM EMPLOYEE WHERE email = ?";
        $paramsEmployee = array($email);
        $stmtEmployee = sqlsrv_query($conn, $sqlEmployee, $paramsEmployee);

        if ($stmtEmployee === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $employee = sqlsrv_fetch_array($stmtEmployee, SQLSRV_FETCH_ASSOC);

        if ($employee) {
            $hashedPassword = $employee['password'];
            if (password_verify($password, $hashedPassword)) {
                header("Location: employeehome.php");
                exit();
            } else {
                $errorMsg = "Invalid employee password.";
            }
        } else {
            $errorMsg = "Invalid credentials. Please try again.";
        }
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
