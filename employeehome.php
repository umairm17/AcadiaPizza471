<?php
include 'includes/emp_header.php';

// Connected to our database
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

$sql_employees = "SELECT firstname, lastname, employee_id FROM EMPLOYEE";
$stmt_employees = sqlsrv_query($conn, $sql_employees);

if ($stmt_employees === false) {
    die(print_r(sqlsrv_errors(), true));
}

$schedule = [];
if (isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
    $selected_employee_id = $_POST['employee_id'];
    $sql_schedule = "SELECT ShiftDay, StartTime, EndTime FROM SCHEDULE WHERE Employee_ID = ?";
    $params_schedule = [$selected_employee_id];
    $stmt_schedule = sqlsrv_query($conn, $sql_schedule, $params_schedule);

    if ($stmt_schedule === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt_schedule, SQLSRV_FETCH_ASSOC)) {
        $schedule[$row['ShiftDay']] = [
            'start_time' => $row['StartTime'] ? $row['StartTime']->format('H:i') : "No Shift",
            'end_time' => $row['EndTime'] ? $row['EndTime']->format('H:i') : "No Shift"
        ];
    }
}

$daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
?>

<html>
<head>
    <link rel="stylesheet" href="css/viewschedule.css">
</head>
<body>
    <div class="schedule-page">
        <form action="" method="POST" class="employee-dropdown">
            <select name="employee_id" id="employee_id" onchange="this.form.submit()">
                <option value="">Select an Employee (ID)</option>
                <?php
                while ($row = sqlsrv_fetch_array($stmt_employees, SQLSRV_FETCH_ASSOC)) {
                    $employeeName = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $employeeID = htmlspecialchars($row['employee_id']);
                    $selected = (isset($selected_employee_id) && $selected_employee_id == $employeeID) ? "selected" : "";
                    echo "<option value='{$employeeID}' {$selected}>{$employeeName} ({$employeeID})</option>";
                }
                ?>
            </select>
        </form>
        <h1>Employee Schedules</h1>
        <div class="schedule-table">
            <?php
            foreach ($daysOfWeek as $day) {
                $start_time = isset($schedule[$day]['start_time']) ? $schedule[$day]['start_time'] : "No Shift";
                $end_time = isset($schedule[$day]['end_time']) ? $schedule[$day]['end_time'] : "No Shift";
                echo "
                <div class='day-row'>
                    <span>{$day}</span>
                    <span>{$start_time} - {$end_time}</span>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
include 'includes/footer.php';
?>
