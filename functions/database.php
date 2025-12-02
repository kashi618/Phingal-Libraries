<?php
  // SQL server details
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "phingal_libraries";

  // Connect to SQL server
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check if connection is success
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
  else {
    //echo "LOG: Database connected<br>";
  }
?>
