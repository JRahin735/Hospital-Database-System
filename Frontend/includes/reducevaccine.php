<?php
//Update Vaccine: in any case some vaccine (not on-hold) are removed from the repository, admin updates the number of vaccines.
require_once "dbh.inc.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vaccine_id = htmlspecialchars($_POST["vaccine_id"]);
    $amt = htmlspecialchars($_POST["amt"]);

    // ERROR: Empty Field
    if (empty($vaccine_id) || empty($amt)) {

        exit();
        header("Location: ../admin.php");
    }
    // Edit Inventory table
    else
    {
        $query = "UPDATE inventory SET instock_amt = instock_amt - $amt WHERE Vaccine_ID = $vaccine_id; ";
        $result = $conn->query($query);
        $query2 = "UPDATE inventory SET available_amt = available_amt - $amt WHERE Vaccine_ID = $vaccine_id; ";
        $result2 = $conn->query($query2);
        header("Location: ../admin.php");
    }
}
else {
    header("Location: ../admin.php");
}