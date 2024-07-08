<?php
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nurse_id = htmlspecialchars($_POST["nurse_id"]);
    $query = "SELECT nurse_id from nurse where Employee_ID = $nurse_id";
    $nurse_key = $conn->query($query);
    $row = $nurse_key->fetch_assoc();
    //echo 'ID:' .  $row["nurse_id"] . '';
    require_once "dbh.inc.php";
    $key = $row["nurse_id"];

    // ERROR: Empty Field
    if (empty($nurse_id)) {

        exit();
        header("Location: ../admin.php");
    }
    
    // Edit Schedule table
    $query2 = "DELETE FROM abc WHERE nurse_id = $key;";
    $result2 = $conn->query($query2);
    // Edit Nurse table
    $query = "DELETE FROM nurse WHERE Employee_ID = $nurse_id;";
    $result = $conn->query($query);

    
    

    
    header("Location: ../admin.php");
}
else {
    header("Location: ../admin.php");
}