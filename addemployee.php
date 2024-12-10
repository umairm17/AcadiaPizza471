<?php
include 'includes/owner_header.php';

// Connecting our database
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

// If request == POST, get the form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['employee-firstname'];
    $lastname = $_POST['employee-lastname'];
    $email = $_POST['employee-email'];
    $password = password_hash($_POST['employee-password'], PASSWORD_DEFAULT); // Hash the password

    //echo "<p> got form data </p";

    // makes sure user enters something in every field
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {
        // Checks if the email user entered is already in our database, throws error if it is.
        $checkSql = "SELECT COUNT(*) AS count FROM EMPLOYEE WHERE email = ?";
        $checkParams = [$email];
        $checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

        if ($checkStmt === false) {
            //debug error handling
            $error = "Error checking for duplicates: " . print_r(sqlsrv_errors(), true);
        } else {
            $row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);
            if ($row['count'] > 0) {
                $error = "Email already exists. Please use a unique email.";
            } else {
                // If the email is unique and not in database, then it inserts the info into EMPLOYEE table 
                $sql = "INSERT INTO EMPLOYEE (firstname, lastname, email, password) 
                        VALUES (?, ?, ?, ?)";
                $params = [$firstname, $lastname, $email, $password];
                $stmt = sqlsrv_query($conn, $sql, $params);

                if ($stmt === false) {
                    //debug error handling
                    $error = "Error adding employee: " . print_r(sqlsrv_errors(), true);
                } else {
                    // Prints success message/alert to the user
                    $success = "Employee successfully added!";
                }
            }
        }
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="css/addemployee.css">
    </head>
    <body>
        <div class="add-employee-page">
            <h1>Add Employee</h1>
            <div class="form-container">
                <form action="" method="POST">
                    <!-- Name Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="employee-firstname">First Name</label>
                            <input type="text" id="employee-firstname" name="employee-firstname" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group">
                            <label for="employee-lastname">Last Name</label>
                            <input type="text" id="employee-lastname" name="employee-lastname" placeholder="Enter last name" required>
                        </div>
                    </div>
                    <!-- Email Fields -->
                    <label for="employee-email">Set Employee Email</label>
                    <input type="email" id="employee-email" name="employee-email" placeholder="Enter employee email" required>
                    <!-- Pass Fields -->
                    <label for="employee-password">Set Employee Password</label>
                    <input type="password" id="employee-password" name="employee-password" placeholder="Enter employee password" required>

                    <button type="submit" class="add-button">Add</button>
                </form>
                <?php
                // Error handling messages / success message
                if (isset($success)) {
                    echo '<div class="success-alert">' . $success . '</div>';
                }
                if (isset($error)) {
                    echo '<div class="error-alert">' . $error . '</div>';
                }
                ?>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
