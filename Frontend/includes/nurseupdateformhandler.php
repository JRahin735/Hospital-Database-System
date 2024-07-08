<?php
session_start();
$currentID = $_SESSION["ID"];

require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nurse_id = htmlspecialchars($_POST["nurse_id"]);
    $address = htmlspecialchars($_POST["address"]);
    $phone = htmlspecialchars($_POST["phone"]);

    // ERROR: Empty Field
    
    if (empty($address)) {
        
    }
    else {
        if (empty($phone)) {
            
        }
        else{
            $query = "UPDATE nurse SET Phone_number = '$phone' WHERE nurse_id = $currentID; ";
            $result = $conn->query($query);
        }
    
        $query = "UPDATE nurse SET N_Address = '$address' WHERE nurse_id = $currentID; ";
        $result = $conn->query($query);
    }

   

    header("Location: ../nurse.php");
}
else {
    header("Location: ../nurse.php");
}
