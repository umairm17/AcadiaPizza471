<?php
include 'includes/owner_header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="css/setschedule.css">
    </head>
    <body>
        <div class="schedule-page">
            <!-- Dropdown for Employee Name -->
            <div class="employee-dropdown">
                <button class="dropdown-button">Employee Name <span>▼</span></button>
                <div class="dropdown-menu">
                    <a href="#">Employee 1</a>
                    <a href="#">Employee 2</a>
                    <a href="#">Employee 3</a>
                </div>
            </div>

            <!-- Set Schedule Heading -->
            <h1>Set Schedule</h1>

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

            <!-- Edit Button -->
            <button class="edit-button">Edit</button>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
