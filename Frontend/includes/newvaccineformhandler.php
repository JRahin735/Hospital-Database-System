<?php
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vaccine_name = htmlspecialchars($_POST["vaccine_name"]);
    $vaccine_company = htmlspecialchars($_POST["vaccine_company"]);
    $total_dose_req = htmlspecialchars($_POST["total_dose_req"]);
    $description = htmlspecialchars($_POST["description"]);

    // ERROR: Empty Field
    if (empty($vaccine_name) || empty($vaccine_company) || empty($total_dose_req)) {

        exit();
        header("Location: ../admin.php");
    }

    // Edit Vaccine table
                                // variable names need changes
    $query = "INSERT INTO vaccine (VaccineName, company, total_doses, v_description)
            VALUES ('$vaccine_name', '$vaccine_company', $total_dose_req, '$description'); ";
    $result = $conn->query($query);
    header("Location: ../admin.php");

    
  
}
else {
    header("Location: ../admin.php");
}
