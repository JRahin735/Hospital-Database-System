<?php
session_start();
$currentID = $_SESSION['ID'];
require_once "dbh.inc.php";
//Cancel a time: nurses should be able to delete a Eme they have scheduled for.
// remove from patientSched table
// update onhold amount in inventroy


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    // ERROR: Empty Field
    if (empty($date) || empty($time)) {

        exit();
        header("Location: ../nurse.php");
    }
    else
    {

        // update patientSched
        $DP = "DELETE FROM abc where s_date = '$date' and start_time = $time and nurse_id = $currentID;";
        $resultDP = $conn->query($DP);
    
        header("Location: ../nurse.php");
    }
}
else {
    header("Location: ../nurse.php");
}