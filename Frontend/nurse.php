<?php
session_start();
require_once "includes/dbh.inc.php";
$currentID = $_SESSION['ID'];
$currentRole = $_SESSION['Role'];
$NQ = "SELECT Fname from nurse where nurse_id = $currentID;";
$NurseName = $conn->query($NQ);
$row = $NurseName->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NURSE PAGE </title>
</head>
<body>

    <h1 style="text-align:center"> Nurse Portal </h1>

    <br>
    <?php echo 'Nusre Name: '. $row["Fname"]; ?>
    <br>
    <form class = "searchForm" action= "includes/admin_search.php" method = "post"> 
        <input type = "hidden" name = "username" value = "" />
        <input type = "hidden" name = "role" value = "" />
      <button type ="submit"> More info! </button>
    </form>
    <br>

    <h3> Edit info </h3>
    <br>

    <form action= "includes/nurseupdateformhandler.php" method = "post"> 


        <label for="address" > Address </label>
        <input id ="address" type ="text" name ="address" placeholder ="ADDRESS">

        <label for="phone" > Phone </label>
        <input id ="phone" type ="text" name ="phone" placeholder ="PHONE">

        <button type ="submit"> Update </button>

    </form>

    <br>

    <h2 > Schedule Management </h2>

    <h3> Add yourself in a schedule </h3>

    <br>

    <form action= "includes/nursescheduleformhandler.php" method = "post"> 

        <label for="date" > Date(yyyy-mm-dd)</label>
        <input id ="date" type ="text" name ="date" placeholder ="Date">

        <label for="time" > Time </label>
        <select id="time" name ="time">
            <option value="8"> 8-9 </option>
            <option value="9"> 9-10 </option>
            <option value="10"> 10-11 </option>
            <option value="11"> 11-12 </option>
            <option value="12"> 12-13 </option>
            <option value="13"> 13-14 </option>
            <option value="14"> 14-15 </option>
            <option value="15"> 15-16 </option>
            <option value="16"> 16-17 </option>
            <option value="17"> 17-18 </option>
        </select>

        <button type ="submit"> Schedule </button>

    </form>
    
    <br>

    <h3> Remove yourself from a schedule </h3>

    <?php 
    
    $query = "SELECT s_date FROM abc WHERE nurse_id = $currentID";
    $result = $conn->query($query);

    $query2 = "SELECT start_time FROM abc WHERE nurse_id = $currentID";
    $result2 = $conn->query($query2);
        
    ?>


    <br>

    <form action= "includes/removefromscheduleformhandler.php" method = "post"> 

    <label for="date" > Date </label>
        <select id="date" name ="date">
            <?php
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["s_date"] . "'>" . $row["s_date"] . "</option>";
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

    <h2> Add a Vaccination record </h2>

    <br>
    <?php $query3 = "SELECT VaccineName FROM vaccine v
        JOIN inventory i ON v.Vaccine_id = i.Vaccine_ID
        WHERE i.onhold_amt >= 1;  ";
        
    $vaccines_available = $conn->query($query3);
    ?>
    <form action= "includes/vaccinationrecordformhandler.php" method = "post"> 

    <label for="vaccine" > Vaccine </label>
        <select id="vaccine" name ="vaccine">
            <?php
                // Output data of each row
                while ($row = $vaccines_available->fetch_assoc()) {
                    echo "<option value='" . $row["VaccineName"] . "'>" . $row["VaccineName"] . "</option>";
                }
            ?>
        </select>

      <label for="patient_id" > Patient ID </label>
      <input id ="patient_id" type ="text" name ="patient_id" placeholder ="PATIENT ID">

      <label for="dose_num" > Dose Number </label>
        <select id="dose_num" name ="dose_num">
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
        </select>

      <button type ="submit"> Record </button>

    </form>

    <br><br>


    <input type="button" onclick="location.href='index.php';" value="logout" />



</body>
</html>