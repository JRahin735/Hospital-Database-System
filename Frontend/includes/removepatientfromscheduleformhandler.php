<?php

session_start();
$currentID = $_SESSION['ID'];
require_once "dbh.inc.php";

// remove from patientSched table
// update onhold amount in inventroy


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    // ERROR: Empty Field
    if (empty($date) || empty($time)) {

        exit();
        header("Location: ../patient.php");
    }
    else
    {

        // fetch vaccine id
        $QV = "SELECT vaccine_id from patientSched where patient_id = $currentID;";
        $resultV = $conn->query($QV);
        $rowV = $resultV->fetch_assoc();
        $vaccine_id = $rowV["vaccine_id"];
        // update patientSched
        $DP = "DELETE FROM patientSched where p_date = '$date' and start_time = $time and patient_id = $currentID;";
        $resultDP = $conn->query($DP);
        // update inventory
        $query = "UPDATE inventory SET onhold_amt = onhold_amt - 1 WHERE Vaccine_ID = $vaccine_id; ";
        $result = $conn->query($query);
        $query2 = "UPDATE inventory SET available_amt = available_amt + 1 WHERE Vaccine_ID = $vaccine_id; ";
        $result2 = $conn->query($query2);
        header("Location: ../patient.php");
    }
}
else {
    header("Location: ../patient.php");
}