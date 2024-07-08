<?php
session_start();
require_once "dbh.inc.php";
$currentID = $_SESSION['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    $vaccine = htmlspecialchars($_POST["vaccine"]);
    $dosenum = htmlspecialchars($_POST["dose_num"]);
    $VQ = "SELECT Vaccine_id from vaccine where VaccineName = '$vaccine';";
    $vid = $conn->query($VQ);
    $vac_id = $vid->fetch_assoc();
    $vaccine_id = $vac_id["Vaccine_id"];
    // ERROR: Empty Field
    if (empty($date) || empty($time) || empty($vaccine) || empty($dosenum)) {

        exit();
        header("Location: ../patient.php");
    }

    // CONSTRAINTS:
    // 1. if dose 2, then archive dose 1 shoud be recorded
    // 2. atmost 100 patients in 1 time slot
    // 3. count num of nurse -> *10 num of patients < this num

 
    if ($dosenum == 2) {

        $query1 = "SELECT * FROM archive_records WHERE DoseNumber = 1 and patient_id = $currentID;";
        $result = $conn->query($query1);

        $queryHistory = "SELECT VaccineName FROM vaccine
        JOIN archive_records WHERE vaccine.Vaccine_id = archive_records.vaccine_id
        AND archive_records.patient_id = $currentID;";
        $resultVac = $conn->query($queryHistory);
        $rowVac = $resultVac->fetch_assoc();
        if(empty($rowVac)) {
        }
        else{
        $VacTaken = $rowVac["VaccineName"];
        }

        $ageQuery = "SELECT * FROM patient WHERE patient_PKEY = $currentID;";
        $resultAge = $conn->query($ageQuery);
        $age = $resultAge->fetch_assoc();
        $PAge = $age["Age"];
        //$row1 = $result->fetch_assoc();
        $intDose = $result->num_rows;
        if($PAge <18)
        {
            echo 'Sorry, Children under 18 are only eligible for 1 dose.';
        }
        else if ($intDose == 0) {
            echo 'You cannot register, as you didnt get the first dose';
        }
        else if($vaccine != $VacTaken) {
            echo 'You cannot register for a different Vaccine, Please choose the same vaccine as dose 1 that is:' . $VacTaken . '<br>';
            
        }
        else {

            $query2 = "SELECT patient_id FROM patientSched WHERE start_time = $time and p_date = '$date'";
            $result2 = $conn->query($query2);
            echo 'num of patients registered for this time: ' . $result2->num_rows .'';
            if ($result2->num_rows < 100) {
                
                $query3 = "SELECT nurse_id FROM abc WHERE start_time = $time and s_date = '$date';";
                $nurse_available = $conn->query($query3);
                
                echo 'nurse: ' . $nurse_available->num_rows .'';
                
                $patient_limit = $nurse_available->num_rows *10;

                if ($patient_limit > $result2->num_rows) {

                    $query4 = "INSERT INTO patientSched (p_date, start_time, patient_id, vaccine_id, dosenum)
                        VALUES ('$date', $time, $currentID, $vaccine_id, $dosenum);";
                    $result4 = $conn->query($query4);
                    //$dq = "UPDATE patientSched SET dosenum = $dosenum where patient_id = $currentID;";
                    //$doseupdate = $conn->query($dq);
                    $query5 = "UPDATE inventory SET onhold_amt = onhold_amt + 1 , available_amt = available_amt - 1 where Vaccine_ID = $vaccine_id ;";
                    $result5 = $conn->query($query5);

                }
                else {
                    echo 'You cant register, not enough nurses';
                }
            }
            else {
                 echo 'You cannot register for this time, as max patient limit reached';
            }
        }
    }
    else {
        
        $query2 = "SELECT patient_id FROM patientSched WHERE start_time = $time and p_date = '$date'";
        $result2 = $conn->query($query2);
        echo 'num of patients registered for this time: ' . $result2->num_rows .'';
        if ($result2->num_rows < 100) {
            
            $query3 = "SELECT nurse_id FROM abc WHERE start_time = $time and s_date = '$date';";
            $nurse_available = $conn->query($query3);
            
            echo 'nurse: ' . $nurse_available->num_rows .'';
            
            $patient_limit = $nurse_available->num_rows *10;

            if ($patient_limit > $result2->num_rows) {

                $query4 = "INSERT INTO patientSched (p_date, start_time, patient_id, vaccine_id, dosenum)
                    VALUES ('$date', $time, $currentID, $vaccine_id, $dosenum);";
                $result4 = $conn->query($query4);
                //$dq = "UPDATE patientSched SET dosenum = $dosenum where patient_id = $currentID;";
                //$doseupdate = $conn->query($dq);
                $query5 = "UPDATE inventory SET onhold_amt = onhold_amt + 1 , available_amt = available_amt - 1 where Vaccine_ID = $vaccine_id ;";
                $result5 = $conn->query($query5);

            }
            else {
                echo 'You cant register, not enough nurses';
            }
        }
        else {
             echo 'You cannot register for this time, as max patient limit reached';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Scheduling</title>
</head>
<body>
        <br><input type="button" onclick="history.back()" value="Back" /></br>
</body>
</html>