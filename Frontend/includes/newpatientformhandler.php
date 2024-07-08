<?php
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login_id = htmlspecialchars($_POST["login_id"]);
    $login_password = htmlspecialchars($_POST["login_password"]);
    $first_name = htmlspecialchars($_POST["first_name"]);
    $middle_initials = htmlspecialchars($_POST["middle_initials"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $ssn = htmlspecialchars($_POST["ssn"]);
    $age = htmlspecialchars($_POST["age"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $race = htmlspecialchars($_POST["race"]);
    $occupation_class = htmlspecialchars($_POST["occupation_class"]);
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    $address = htmlspecialchars($_POST["address"]);

    // ERROR: Empty Field
    if (empty($login_id) || empty($login_password) || empty($first_name) ||
        empty($middle_initials) || empty($last_name) || empty($ssn) ||
        empty($age) || empty($gender) || empty($race) ||
        empty($occupation_class) || empty($phone_number) || empty($address)) {

        exit();
        header("Location: ../index.php");
    }

    // Edit Vaccine table
                                // variable names need changes
    $query = "INSERT INTO patient (Fname, MI, Lname, SSN, Age, Gender, Race, Occupation_class, Phone_number, P_Address, Username, Pass)
            VALUES ('$first_name', '$middle_initials', '$last_name', '$ssn', $age, '$gender', '$race', '$occupation_class', '$phone_number', '$address', '$login_id', '$login_password');";
    $result = $conn->query($query);
    
    header("Location: ../index.php");
}
else {
    header("Location: ../index.php");
}
