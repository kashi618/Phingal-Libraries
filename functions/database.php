<?php
  // SQL server details
  $servernameDB = "localhost";
  $usernameDB   = "root";
  $passwordDB   = "";
  $nameDB     = "phingal_libraries";

  // Connect to SQL server
  $conn = new mysqli($servernameDB, $usernameDB, $passwordDB, $nameDB);

  // Check if connection is success
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
  else {
    //echo "LOG: Database connected<br>";
  }
?>
