<?php
session_start();
require_once "includes/dbh.inc.php";
$currentID = $_SESSION['ID'];
$currentRole = $_SESSION['Role'];

$NQ = "SELECT * from patient where patient_PKEY = $currentID;";
$Name = $conn->query($NQ);
$row = $Name->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PATIENT PAGE </title>
</head>
<body>

    <h1 style="text-align:center"> Patient Portal </h1>


    <br><br>
    <?php echo '<b>Patient Name: </b>'. $row["Fname"] . '<b> Age: </b>' . $row["Age"]; ?>
    <h3> LookUp your Information </h3><br>
    <form class = "searchForm" action= "includes/admin_search.php" method = "post"> 
        <input type = "hidden" name = "username" value = "" />
        <input type = "hidden" name = "role" value = "" />
      <button type ="submit"> More info!! </button>

    </form>

    <br><br>

    <form action= "includes/updatepatientinfo.php" method = "post"> 

        <label for="first_name"> First Name </label>
        <input id="first_name" type="text" name="first_name" placeholder="FIRST NAME">

        <label for="middle_initials"> Middle Initials </label>
        <input id="middle_initials" type="text" name="middle_initials" placeholder="MI">


        <label for="last_name"> Last Name </label>
        <input id="last_name" type="text" name="last_name" placeholder="LAST NAME">

        <br><br>

        <label for="ssn"> SSN </label>
        <input id="ssn" type="text" name="ssn" placeholder="SSN">

        <label for="age"> Age </label>
        <input id="age" type="text" name="age" placeholder="AGE">

        <label for="gender" > Gender </label>
        <select id="gender" name ="gender">
            <option value="male"> Male </option>
            <option value="female"> Female </option>
        </select>

        <label for="race"> Race </label>
        <input id="race" type="text" name="race" placeholder="RACE">

        <label for="occupation_class"> Occupation Class </label>
        <input id="occupation_class" type="text" name="occupation_class" placeholder="Occupation class">

        <br><br>

        <label for="phone_number"> Phone Number </label>
        <input id="phone_number" type="text" name="phone_number" placeholder="PHONE NUMBER">

        <label for="address"> Address </label>
        <input id="address" type="text" name="address" placeholder="ADDRESS">

        <button type ="submit"> Update </button>

    </form>

    <br><br>

    <h2> Vaccination Scheduling </h2>

    <h3> Add yourself in a schedule </h3>

    <?php 
    
    $query = "SELECT s_date FROM abc";
    $dates_available = $conn->query($query);

    $query2 = "SELECT start_time FROM abc";
    $times_available = $conn->query($query2);

    
    $query3 = "SELECT VaccineName FROM vaccine v
        JOIN inventory i ON v.Vaccine_id = i.Vaccine_ID
        WHERE i.available_amt >= 1;  ";
        
    $vaccines_available = $conn->query($query3);

    ?>

    <form action= "includes/patientscheduleformhandler.php" method = "post"> 

        <label for="date" > Date </label>
        <select id="date" name ="date">
            <?php
                // Output data of each row
                while ($row = $dates_available->fetch_assoc()) {
                    echo "<option value='" . $row["s_date"] . "'>" . $row["s_date"] . "</option>";
                }
            ?>
        </select>

        <label for="time" > Time </label>
        <select id="time" name ="time">
            <?php
                // Output data of each row
                while ($row = $times_available->fetch_assoc()) {
                    echo "<option value='" . $row["start_time"] . "'>" . $row["start_time"] . "</option>";
                }
            ?>
        </select>

        <label for="vaccine" > Vaccine </label>
        <select id="vaccine" name ="vaccine">
            <?php
                // Output data of each row
                while ($row = $vaccines_available->fetch_assoc()) {
                    echo "<option value='" . $row["VaccineName"] . "'>" . $row["VaccineName"] . "</option>";
                }
            ?>
        </select>

        <label for="dose_num" > Dose Number </label>
        <select id="dose_num" name ="dose_num">
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
        </select>

        <button type ="submit"> Schedule </button>

    </form>
    
    <br><br>

    <h3> Remove yourself from a schedule </h3>

    <br><br>

    <?php 
    
    $query = "SELECT p_date FROM patientSched WHERE patient_id = $currentID";
    $result = $conn->query($query);

    $query2 = "SELECT start_time FROM patientSched WHERE patient_id = $currentID";
    $result2 = $conn->query($query2);
        
    ?>

    <form action= "includes/removepatientfromscheduleformhandler.php" method = "post"> 

       
    <label for="date" > Date </label>
        <select id="date" name ="date">
            <?php
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["p_date"] . "'>" . $row["p_date"] . "</option>";
                }
            ?>
        </select>

        <label for="time" > Time </label>
        <select id="time" name ="time">
            <?php
                // Output data of each row
                while ($row2 = $result2->fetch_assoc()) {
                    echo "<option value='" . $row2["start_time"] . "'>" . $row2["start_time"] . "</option>";
                }
            ?>
        </select>
        <button type ="submit"> Remove </button>

    </form>
    
    <br><br>

    <input type="button" onclick="location.href='index.php';" value="logout" />



</body>
</html>