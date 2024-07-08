<?php
session_start();
$currentID = $_SESSION['ID'];
$currentRole = $_SESSION['Role'];
$currentStatus = $_SESSION['Status'];
require_once "dbh.inc.php";

$username = htmlspecialchars($_POST["username"]);
$role = htmlspecialchars($_POST["role"]);


if(empty($role))
{
    $role = $currentRole;
}
if($currentStatus == 1)
{
    if ($role == 'Patient') 
    {

    // patient info
    $query = "SELECT * FROM patient WHERE Username = '$username';";
    $result = $conn->query($query);

    // schedule info
    $query2 = "SELECT patientSched.*, patient.*
                FROM patientSched
                JOIN patient ON patientSched.patient_id = patient.patient_PKEY
                WHERE patient.Username = '$username';";

    $result2 = $conn->query($query2);

    // archive info
    $query3 = " SELECT vaccine.*
                FROM archive_records
                JOIN patient ON archive_records.patient_id = patient.patient_PKEY
                JOIN vaccine ON archive_records.vaccine_id = vaccine.Vaccine_id
                WHERE patient.Username = '$username';";
    
    $result3 =  $conn->query($query3);
    

        }
    else if ($role == 'Nurse') {

    $query4 = "SELECT * FROM nurse WHERE Username = '$username';";
    $result4 = $conn->query($query4);

    $query5 = "SELECT abc.*, nurse.*
                FROM abc
                JOIN nurse ON abc.nurse_id = nurse.nurse_id
                WHERE nurse.Username = '$username';";
    $result5 = $conn->query($query5);

    }
}
else if($currentStatus == 2)
{
    if ($role == 'Patient') 
    {

    // patient info
    $query = "SELECT * FROM patient WHERE patient_PKEY = $currentID;";
    $result = $conn->query($query);

    // schedule info
    $query2 = "SELECT patientSched.*, patient.*
                FROM patientSched,patient
                WHERE patientSched.patient_id = patient.patient_PKEY and
                patient.patient_PKEY = $currentID;";

    $result2 = $conn->query($query2);

    // archive info
    $query3 = " SELECT vaccine.*
                FROM archive_records
                JOIN patient ON archive_records.patient_id = patient.patient_PKEY
                JOIN vaccine ON archive_records.vaccine_id = vaccine.Vaccine_id
                WHERE patient.patient_PKEY = $currentID;";
    
    $result3 =  $conn->query($query3);
    }
    else if ($role == 'Nurse') {

    $query4 = "SELECT * FROM nurse WHERE nurse_id = $currentID;";
    $result4 = $conn->query($query4);

    $query5 = "SELECT abc.*, nurse.*
                FROM abc,nurse
                WHERE abc.nurse_id = nurse.nurse_id and
                nurse.nurse_id = $currentID;";
    $result5 = $conn->query($query5);

    }   
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Search</title>
</head>
<body>
    

<h1>Results:  </h1>

<?php

if ($role == 'Patient') {
    if (empty($result)) {
        echo '<p> No results. </p>';
    }
    else {
        foreach ($result as $row) {
            
            echo 'Name: '. $row['Fname'] .' '. $row['MI'] .' '. $row['Lname'] .'<br>'.
            'PHONE: ' . $row['Phone_number'] .'<br>'.
            'ADDRESS: ' . $row['P_Address'] . '<br>'.
            'AGE: ' . $row['Age'] . '<br>'.
            'Race: ' . $row['Race'] . '<br>';
        }
    }
echo 'Currently Scheduled for: '.'<br>';
        foreach ($result2 as $row2) {

            echo 'Date: '. $row2['p_date'] .' at '. $row2['start_time'] . ''.'<br>';
        }
       
        echo 'Previous Record- <br>';
        foreach ($result3 as $row3) {
            echo 'Vaccine taken: ' . $row3['VaccineName'] .'<br>';
        }
}

if ($role == 'Nurse') {

    if (empty($result4)) {
        echo '<p> No results. </p>';
    }
    else {
        foreach ($result4 as $row4) {

            echo 'Name: '. $row4['Fname'] .' '. $row4['MI'] .' '. $row4['Lname'] .'<br>'.
            'PHONE: ' . $row4['Phone_number'] .'<br>'.
            'ADDRESS: ' . $row4['N_Address'] . '<br>'.
            'AGE: ' . $row4['Age'] . '<br>'.
            'Employee ID: ' . $row4['Employee_ID'] . '<br>';
        }
    }
    echo 'Currently Scheduled for: '.'<br>';
        foreach ($result5 as $row5) {

            echo 'Date: ' . $row5['s_date'] .' at '. $row5['start_time'] .'<br>';
        }
}

?>


    <input type="button" onclick="history.back()" value="Back" />

</body>
</html>