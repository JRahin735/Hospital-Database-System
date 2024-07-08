<?php
session_start();
$currentID = $_SESSION['ID'];
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);

    // ERROR: Empty Field
    if (empty($date) || empty($time)) {

        exit();
        header("Location: ../index.php");
    }

 
    $query1 = "SELECT nurse_id FROM abc WHERE start_time = $time and s_date = '$date';";
    $nurse_available = $conn->query($query1);
    echo 'Nurses Registered for the Slot: ' . $nurse_available->num_rows .'<br>';
    if ($nurse_available->num_rows < 12) {
        $query2 = "INSERT INTO abc (s_date, start_time, nurse_id)
            VALUES ('$date', $time, $currentID);";
        $result = $conn->query($query2);
    }
    else {
        echo 'Error:You cannot register for this time, as max nurse limit reached';
    }
    // back button
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><input type="button" onclick="history.back()" value="Back" /><br>
</body>
</html>