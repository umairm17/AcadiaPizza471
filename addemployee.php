<?php
include 'includes/owner_header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="css/addemployee.css">
    </head>
    <body>
        <div class="add-employee-page">
            <h1>Add Employee</h1>
            <div class="form-container">
                <form action="process_addemployee.php" method="POST">
                    <!-- First and Last Name Fields -->
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

                    <label for="employee-email">Set Employee Email</label>
                    <input type="email" id="employee-email" name="employee-email" placeholder="Enter employee email" required>

                    <label for="employee-password">Set Employee Password</label>
                    <input type="password" id="employee-password" name="employee-password" placeholder="Enter employee password" required>

                    <button type="submit" class="add-button">Add</button>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>
