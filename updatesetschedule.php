<?php

// Connecting to db
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

// Get data from the html form
$employee_id = $_POST['employee_id'];
$daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// Looping through each day to add schedule or update 
foreach ($daysOfWeek as $day) {
    $start_time = $_POST["{$day}_start"] ?? null;
    $end_time = $_POST["{$day}_end"] ?? null;
    $is_off = isset($_POST["{$day}_off"]);

    // if "off" checkbox is checked, start & end times will be null
    if ($is_off) {
        $start_time = null;
        $end_time = null;
    }

    // Checks to see if there is already a schedule for this employee that exists, if it does, it updates it
    $sql_check = "SELECT * FROM SCHEDULE WHERE Employee_ID = ? AND ShiftDay = ?";
    $params_check = [$employee_id, $day];
    $stmt_check = sqlsrv_query($conn, $sql_check, $params_check);

    if ($stmt_check === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt_check)) {
        $sql_update = "UPDATE SCHEDULE 
                       SET StartTime = ?, EndTime = ? 
                       WHERE Employee_ID = ? AND ShiftDay = ?";
        $params_update = [$start_time, $end_time, $employee_id, $day];
        $stmt_update = sqlsrv_query($conn, $sql_update, $params_update);

        if ($stmt_update === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        // If schedule doesn't exist, then insert a new one
        $sql_insert = "INSERT INTO SCHEDULE (Employee_ID, ShiftDay, StartTime, EndTime) 
                       VALUES (?, ?, ?, ?)";
        $params_insert = [$employee_id, $day, $start_time, $end_time];
        $stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);

        if ($stmt_insert === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}

// Go to page with sucess message
header("Location: setschedule.php?success=1");
exit();
?>
