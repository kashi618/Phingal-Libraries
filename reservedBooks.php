<?php 
  session_start();
  
  require "functions/database.php";
  require "functions/logout.php";
  require "functions/reserved.php";

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
  
  <h1>Reserved Books</h1>

  <?php
    if ($reserved_error !== null) {
      echo '<p>'.htmlentities($reserved_error).'</p>';
    }
    elseif (empty($reserved_rows)) {
      echo '<p>You have not reserved any books yet.</p>';
    }
    else {
      $has_reserved_date = array_key_exists('ReservedDate', $reserved_rows[0]);
      $has_due_date = array_key_exists('DueDate', $reserved_rows[0]);
      echo "<table border='1'>\n";
      echo '<tr><td>Title</td><td>Author</td><td>Edition</td><td>Year</td><td>ISBN</td>';
      if ($has_reserved_date) {
        echo '<td>Reserved On</td>';
      }
      if ($has_due_date) {
        echo '<td>Due Date</td>';
      }
      echo "</tr>\n";
      foreach ($reserved_rows as $row) {
        echo '<tr>';
        echo '<td>'.htmlentities($row['BookTitle']).'</td>';
        echo '<td>'.htmlentities($row['Author']).'</td>';
        echo '<td>'.htmlentities($row['Edition']).'</td>';
        echo '<td>'.htmlentities($row['Year']).'</td>';
        echo '<td>'.htmlentities($row['ISBN']).'</td>';
        if ($has_reserved_date) {
          $reserved_on = $row['ReservedDate'] ?? '';
          echo '<td>'.htmlentities($reserved_on).'</td>';
        }
        if ($has_due_date) {
          $due_on = $row['DueDate'] ?? '';
          echo '<td>'.htmlentities($due_on).'</td>';
        }
        echo "</tr>\n";
      }
      echo "</table>\n";
    }
  ?>
  
</body>
</html>
