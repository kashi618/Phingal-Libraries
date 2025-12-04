<?php 
  session_start();
  require 'functions/database.php';

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
<head>
<body>
  <?php
    require "functions/accountMenu.php";
    require "functions/header.php";
    require "functions/navbar.php";
  ?>

  <h1>About</h1>
  <h2>By Neil Jiang (C24510496)</h2>
  <h3>Github Repository: <a href="https://github.com/kashi618/Phingal-Libraries">kashi618/Phingal-Libraries</a></h3>
</body>
</html>
