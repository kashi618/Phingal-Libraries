<?php session_start(); ?>

<?php require 'functions/database.php'; ?>
<?php require 'functions/logout.php'; ?>

<?php
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
  <form method="post"><input type="submit" value="logout" name="logout"></form> 
  <?php require "functions/header.php"?>

  <nav>
    <a href="index.php">HOME</a>
    <a href="search.php">SEARCH</a>
    <a href="reserved.php">RESERVED</a>
    <a href="about.php">ABOUT</a>
  </nav>
  <hr>


  <!-- Library/Home page -->
  <h1>Library</h1>

</body>
</html>
