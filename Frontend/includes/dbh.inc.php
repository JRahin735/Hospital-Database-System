<?php
 $server="localhost";
 $username="root";
 $password="";
 $dbname="480db";
 $conn = new mysqli($server, $username, $password, $dbname);
 if($conn->connect_error) die("connection failed");
 