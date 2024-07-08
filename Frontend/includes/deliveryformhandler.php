<?php
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vaccine_id = htmlspecialchars($_POST["vaccine_id"]);
    $delivery_amt = htmlspecialchars($_POST["delivery_amt"]);

    // ERROR: Empty Field
    if (empty($vaccine_id) || empty($delivery_amt)) {

        exit();
        header("Location: ../admin.php");
    }
    // Edit Inventory table  
    else
    {
        $query = "UPDATE inventory SET instock_amt = instock_amt + $delivery_amt WHERE Vaccine_ID = $vaccine_id; ";
        $result = $conn->query($query);
        $query2 = "UPDATE inventory SET available_amt = available_amt + $delivery_amt WHERE Vaccine_ID = $vaccine_id; ";
        $result2 = $conn->query($query2);
        header("Location: ../admin.php");
    }
}
else {
    header("Location: ../admin.php");
}