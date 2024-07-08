<?php
session_start();
$currentID = $_SESSION['ID'];

//Update Info: paEents can update their informaEon.


require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $existing = "SELECT * FROM patient WHERE patient_PKEY = $currentID;";
    $store = $conn->query($existing);
    $row = $store->fetch_assoc();

    //$login_id = htmlspecialchars($_POST["login_id"]);
    //$login_password = htmlspecialchars($_POST["login_password"]);
    $first_name = htmlspecialchars($_POST["first_name"]);
    if (empty($first_name)) {
        $first_name = $row["Fname"];
    }
    $middle_initials = htmlspecialchars($_POST["middle_initials"]);
    if (empty($middle_initials)) {
        $middle_initials = $row["MI"];
    }
    $last_name = htmlspecialchars($_POST["last_name"]);
    if (empty($last_name)) {
        $last_name = $row["Lname"];
    }
    $ssn = htmlspecialchars($_POST["ssn"]);
    if (empty($ssn)) {
        $ssn = $row["SSN"];
    }
    $age = htmlspecialchars($_POST["age"]);
    if (empty($age)) {
        $age = $row["Age"];
    }
    $gender = htmlspecialchars($_POST["gender"]);
    if (empty($gender)) {
        $gender = $row["Gender"];
    }
    $race = htmlspecialchars($_POST["race"]);
    if (empty($race)) {
        $race = $row["Race"];
    }
    $occupation_class = htmlspecialchars($_POST["occupation_class"]);
    if (empty($occupation_class)) {
        $occupation_class = $row["Occupation_class"];
    }
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    if (empty($phone_number)) {
        $phone_number = $row["Phone_number"];
    }
    $address = htmlspecialchars($_POST["address"]);
    if (empty($address)) {
        $address = $row["P_Address"];
    }
    
    

    $query = "UPDATE patient SET Fname = '$first_name',MI = '$middle_initials',Lname = '$last_name',SSN = '$ssn',Age = $age,
    Gender = '$gender', Race = '$race',Occupation_class = '$occupation_class',Phone_number = '$phone_number',
    P_Address = '$address' WHERE patient_PKEY = $currentID;";
    $result = $conn->query($query);
   // echo "Your ID:" . $currentID ;
    header("Location: ../patient.php");
}
else {
    header("Location: ../patient.php");
}
