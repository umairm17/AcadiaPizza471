<?php
include 'includes/owner_header.php';

// Success msg 
$success = isset($_GET['success']) && $_GET['success'] == '1';

// Connect to our database server

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

// SQL query for fetching employees
$sql = "SELECT firstname, lastname, employee_id FROM EMPLOYEE";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo "<p>query not fetched</p>";
    die(print_r(sqlsrv_errors(), true));
}

// debug line - remove later
//echo "<pre>";
//while ($debugRow = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
//    print_r($debugRow);
//}

?>

<html>
<head>
    <link rel="stylesheet" href="css/setschedule.css">
</head>
<body>
    <div class="schedule-page">
    <!-- Checks if schedule has been updated -->
    <?php if ($success): ?>
        <div class="success-message">
            <p>Schedule successfully updated!</p>
        </div>
    <?php endif; ?>
        <form action="updatesetschedule.php" method="POST">
            <div class="employee-dropdown">
                <label for="employee_id">Select Employee:</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="">Select an Employee (ID)</option>
                    <?php
                    // show the employee names & id in dropdown and fetch them
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $firstName = htmlspecialchars($row['firstname']);
                        $lastName = htmlspecialchars($row['lastname']);
                        $employeeID = htmlspecialchars($row['employee_id']);
                        
                        echo "<option value='{$employeeID}'>{$firstName} {$lastName} ({$employeeID})</option>";
                    }
                    ?>
                </select>
            </div>
            <h1>Set Schedule</h1>
            <div class="schedule-form">
                <?php
                // Create array of weekdays for the schedule & loop through them for the schedule inputs
                $scheduleDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                foreach ($scheduleDays as $day) {
                    echo "
                    <div class='day-row'>
                        <label for='{$day}_start'>{$day}:</label>
                        <input type='time' id='{$day}_start' name='{$day}_start' placeholder='Start Time'>
                        <input type='time' id='{$day}_end' name='{$day}_end' placeholder='End Time'>
                        <label>
                            <input type='checkbox' name='{$day}_off'> Off
                        </label>
                    </div>";
                }
                ?>
            </div>
            <button type="submit" class="save-button">Save Schedule</button>
        </form>
    </div>
</body>
</html>

<?php
include 'includes/footer.php';
?>
