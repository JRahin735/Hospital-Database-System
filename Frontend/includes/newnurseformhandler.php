<?php
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login_id = htmlspecialchars($_POST["login_id"]);
    $login_password = htmlspecialchars($_POST["login_password"]);
    $first_name = htmlspecialchars($_POST["first_name"]);
    $middle_initials = htmlspecialchars($_POST["middle_initials"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $EmpID = htmlspecialchars($_POST["EmpID"]);
    $age = htmlspecialchars($_POST["age"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    $address = htmlspecialchars($_POST["address"]);

    // ERROR: Empty Field
    if (empty($login_id) || empty($login_password) || empty($first_name) || empty($last_name) || empty($EmpID) ||
        empty($age) || empty($gender)) {

        exit();
        header("Location: ../admin.php");
    }

    // Edit Vaccine table
                                // variable names need changes
    $query = "INSERT INTO nurse (Fname, MI, Lname, Employee_ID, Age, Gender, Phone_number, N_Address, Username, Pass)
            VALUES ('$first_name', '$middle_initials', '$last_name', $EmpID, $age, '$gender', '$phone_number', '$address', '$login_password', '$login_password');";
    $result = $conn->query($query);
    
    header("Location: ../admin.php");
}
else {
    header("Location: ../admin.php");
}
        