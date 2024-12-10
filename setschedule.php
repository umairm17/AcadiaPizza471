<?php
include 'includes/owner_header.php';

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

$sql = "SELECT firstname, lastname, employee_id FROM EMPLOYEE";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/setschedule.css">
</head>
<body>
    <div class="schedule-page">
        <div class="employee-dropdown">
            <button class="employee-dropdown-button">Employee Name (ID) <span>▼</span></button>
            <div class="employee-dropdown-menu">
                <?php
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $employeeName = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $employeeID = htmlspecialchars($row['employee_id']);
                    echo "<a href='#'>{$employeeName} ({$employeeID})</a>";
                }
                ?>
            </div>
        </div>
        <h1>Set Schedule</h1>
        <div class="week-nav">
            <button class="nav-arrow">←</button>
            <span class="week-display">Jan 01 - Jan 07</span>
            <button class="nav-arrow">→</button>
        </div>
        <div class="schedule-table">
            <div class="day-row"><span>Sunday</span><span>4pm-10pm</span></div>
            <div class="day-row"><span>Monday</span><span>10am-2pm</span></div>
            <div class="day-row"><span>Tuesday</span><span>No Shift</span></div>
            <div class="day-row"><span>Wednesday</span><span>6pm-10pm</span></div>
            <div class="day-row"><span>Thursday</span><span>No Shift</span></div>
            <div class="day-row"><span>Friday</span><span>3pm-10pm</span></div>
            <div class="day-row"><span>Saturday</span><span>No Shift</span></div>
        </div>
        <button class="edit-button">Edit</button>
    </div>
</body>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const employeeDropdownButton = document.querySelector(".employee-dropdown-button");
            const employeeDropdownMenu = document.querySelector(".employee-dropdown-menu");

            employeeDropdownButton.addEventListener("click", function (event) {
                event.stopPropagation(); 
                employeeDropdownMenu.classList.toggle("show");
            });

            document.addEventListener("click", function (event) {
                if (!employeeDropdownMenu.contains(event.target) && !employeeDropdownButton.contains(event.target)) {
                    employeeDropdownMenu.classList.remove("show");
                }
            });
        });
    </script>
</html>

<?php
include 'includes/footer.php';
?>
