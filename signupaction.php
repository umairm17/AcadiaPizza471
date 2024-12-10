<?php
require_once './includes/test.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $phone = $_POST['phone'];

    $sql = "INSERT INTO CUSTOMER (FirstName, LastName, Email, Password, PhoneNumber) 
            VALUES (?, ?, ?, ?, ?)";
    
    $params = array($firstName, $lastName, $email, $password, $phone);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if (sqlsrv_execute($stmt)) {
        header("Location: login.php");
        exit();
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
}
?>