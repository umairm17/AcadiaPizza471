<?php
include 'includes/emp_header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="css/viewschedule.css">
    </head>
    <body>
        <div class="schedule-page">
            <!-- Set Schedule Heading -->
            <h1>My Schedule</h1>

            <!-- Week Navigation -->
            <div class="week-nav">
                <button class="nav-arrow">←</button>
                <span class="week-display">Jan 01 - Jan 07</span>
                <button class="nav-arrow">→</button>
            </div>

            <!-- Schedule Table -->
            <div class="schedule-table">
                <div class="day-row"><span>Sunday</span><span>4pm-10pm</span></div>
                <div class="day-row"><span>Monday</span><span>10am-2pm</span></div>
                <div class="day-row"><span>Tuesday</span><span>No Shift</span></div>
                <div class="day-row"><span>Wednesday</span><span>6pm-10pm</span></div>
                <div class="day-row"><span>Thursday</span><span>No Shift</span></div>
                <div class="day-row"><span>Friday</span><span>3pm-10pm</span></div>
                <div class="day-row"><span>Saturday</span><span>No Shift</span></div>
            </div>

            <!-- Punch In/Out Buttons -->
            <div class="punch-buttons">
                <button class="punch-in-button">Punch In</button>
                <button class="punch-out-button">Punch Out</button>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
