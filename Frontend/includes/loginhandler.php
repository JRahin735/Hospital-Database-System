<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login_id = htmlspecialchars($_POST["login_id"]);
    $login_password = htmlspecialchars($_POST["login_password"]);
    $role = htmlspecialchars($_POST["role"]);

   //try {
        require_once "dbh.inc.php";

        // ERROR: Empty Field
        if (empty($login_id) || empty($login_password)) {

            exit();
            header("Location: ../index.php");
        }

        // use login_id and _password to find them in database, match them and give proper login
        if ($role == "admin") {

            //$query = "select * from nurse where Username = '$login_id' and Password = '$login_password'";
           // $result = $conn->query($query);
            
            if ($login_id == 'Admin' && $login_password == 'Password') {
                //alert("Login successful!");
                echo '<script>alert("Login successful!")</script>';
                header ("Location: ../admin.php");
                $_SESSION['Status'] = 1;
                // Additional code for successful login can be added here
            } else {
                //alert ("Login failed. Incorrect username or password.");
               // echo '<script>alert("Login failed. Incorrect username or password.")</script>';
                header("Location: ../index.php");    
                echo '<script>alert("Login failed. Incorrect username or password.")</script>';
            }

            
            die();
        }
        else if ($role == "patient") {
            $query = "select * from patient where Username = '$login_id' and Pass = '$login_password'";
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
                $ID_query = "SELECT patient_PKEY FROM patient WHERE Username = '$login_id' and Pass = '$login_password'";
                $resultID = $conn->query($ID_query);
                $row = $resultID->fetch_assoc();
                //echo "ID: $login_id" . $row["patient_PKEY"];
                $_SESSION['ID'] = $row["patient_PKEY"];
                $_SESSION['Role'] = "Patient";
                $_SESSION['Status'] = 2;
                //echo '<script>alert("Login successful!")</script>';
                header ("Location: ../patient.php");
                // Additional code for successful login can be added here
            }
             else {
                header("Location: ../index.php");   
                echo '<script>alert("Login failed. Incorrect username or password.")</script>';
            }
            die();
        }
        else if ($role == "nurse") {
            $query = "select * from nurse where Username = '$login_id' and Pass = '$login_password'";
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {

                $ID_query = "SELECT nurse_id FROM nurse WHERE Username = '$login_id' and Pass = '$login_password'";
                $resultID = $conn->query($ID_query);
                $row = $resultID->fetch_assoc();
                $_SESSION['ID'] = $row["nurse_id"];
                $_SESSION['Role'] = "Nurse";
                $_SESSION['Status'] = 2;
                echo '<script>alert("Login successful!")</script>';
                header ("Location: ../nurse.php");
                // Additional code for successful login can be added here
            } else {
                //echo '<script>alert("Login failed. Incorrect username or password.")</script>';
                header("Location: ../index.php");
                echo '<script>alert("Login failed. Incorrect username or password.")</script>';

            }

            
            die();
        }
        // change it to different pages according to role of login using if statements.
       

    //} //catch (PDOException $e) {
      //  die( "Query failed: " , $e-›getMessage ( )) ;
    //} 
}
else {
    header("Location: ../index.php");
}

