<?php 
  session_start();

  require "functions/database.php";
  require "functions/logout.php";
  require "functions/register.php"; 

  // If not logged in, send to login page
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Phingal Libraries</title>
</head>
<body>
  <?php
    require "functions/accountMenu.php";
    require "functions/header.php";
    require "functions/navbar.php";
  ?>

  <!-- Library/Home page -->
  <h1>Library</h1>

</body>
</html>
