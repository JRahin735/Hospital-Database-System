<?php 

session_start();
$currentID = $_SESSION['ID'];

require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmpID = htmlspecialchars($_POST["EmpID"]);
    $existing = "SELECT * FROM nurse WHERE Employee_ID = $EmpID;";
    $store = $conn->query($existing);
    $row = $store->fetch_assoc();

    

    $first_name = htmlspecialchars($_POST["first_name"]);
    if (empty($first_name)) {
        $first_name = $row["Fname"];
    }
    $last_name = htmlspecialchars($_POST["last_name"]);
    if (empty($last_name)) {
        $last_name = $row["Lname"];
    }
    $middle_initials = htmlspecialchars($_POST["middle_initials"]);
    if (empty($middle_initials)) {
        $middle_initials = $row["MI"];
    }
    $age = htmlspecialchars($_POST["age"]);
    if (empty($age)) {
        $age = $row["Age"];
    }
    $gender = htmlspecialchars($_POST["gender"]);
    if (empty($gender)) {
        $gender = $row["Gender"];
    }
    $login_id = htmlspecialchars($_POST["login_id"]);
    if (empty($login_id)) {
        $login_id = $row["Username"];
    }
    $login_password = htmlspecialchars($_POST["login_password"]);
    if (empty($login_password)) {
        $login_password = $row["Pass"];
    }

    $query = "UPDATE nurse SET
    Fname = '$first_name',
    MI = '$middle_initials',
    Lname = '$last_name',
    Age = $age,
    Gender = '$gender',
    Username = '$login_id',
    Pass = '$login_password'
    WHERE Employee_ID = $EmpID;";
    $result = $conn->query($query);

    header("Location: ../admin.php");
}
else {
    header("Location: ../admin.php");
}


