<?php
session_start();
$currentID = $_SESSION['ID'];
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vaccine = htmlspecialchars($_POST["vaccine"]);
    $VQ = "SELECT Vaccine_id from vaccine where VaccineName = '$vaccine';";
    $vid = $conn->query($VQ);
    $vac_id = $vid->fetch_assoc();
    $vaccine_id = $vac_id["Vaccine_id"];
    $patient_id = htmlspecialchars($_POST["patient_id"]);
    $dosenum = htmlspecialchars($_POST["dose_num"]);


    
    // ERROR: Empty Field
    if (empty($vaccine_id) || empty($patient_id)) {

        exit();
        header("Location: ../index.php");
    }
    
    // Edit Vaccine table
                                // variable names need changes
        $getQ = "SELECT * from patientSched where patient_id = $patient_id;";
        $resultP = $conn->query($getQ);
        $row = $resultP->fetch_assoc();
        $vactime = $row["start_time"];
        $vacdate = $row["p_date"];
    $query = "INSERT INTO archive_records (vaccine_id, patient_id, nurse_id,DoseNumber,v_time,v_date)
            VALUES ($vaccine_id, $patient_id, $currentID,$dosenum,$vactime,'$vacdate'); ";
    $result = $conn->query($query);
    $query5 = "UPDATE inventory SET onhold_amt = onhold_amt - 1 , instock_amt = instock_amt - 1 where Vaccine_ID = $vaccine_id ;";
                    $result5 = $conn->query($query5);
    header("Location: ../nurse.php");
}
else {
    header("Location: ../nurse.php");
}
