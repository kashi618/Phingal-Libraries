<?php 
  session_start();

  require 'functions/database.php';
  require "functions/logout.php";
  require 'functions/search.php';

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Phingal Libraries</title>
<head>
<body>
  <?php
    require "functions/accountMenu.php";
    require "functions/header.php";
    require "functions/navbar.php";
  ?>

  <h1>Search Books</h1>

  
  <!-- Searchbar -->
  <?php $query = $_GET['q'] ?? ''; ?>
  <form method="get" action="searchBook.php" class="search-container">
    <input class="searchbar" type="text" name="q" placeholder="SEARCH..." value="<?php echo htmlentities($query); ?>">
    <button class="searchbarButton" type="submit"><i class="fas fa-search"></i></button>
  </form>

    <?php
    if ($search_error !== null) {
      echo '<p>'.htmlentities($search_error).'</p>';
    } else {
      echo '<h2>'.htmlentities($title).'</h2>';

      if (!empty($rows)) {
        echo "<table border='1'>\n";
        echo "<tr><td>Title</td><td>Author</td><td>Edition</td><td>Year</td><td>ISBN</td></tr>\n";
        foreach ($rows as $row) {
          echo '<tr><td>'.htmlentities($row['BookTitle']).'</td>';
          echo '<td>'.htmlentities($row['Author']).'</td>';
          echo '<td>'.htmlentities($row['Edition']).'</td>';
          echo '<td>'.htmlentities($row['Year']).'</td>';
          echo '<td>'.htmlentities($row['ISBN']).'</td></tr>';
        }
        echo "</table>\n";
      } else {
        // Message depends on whether it was a search or default listing
        if ($query !== '') {
          echo '<p>No books matched your search.</p>';
        } else {
          echo '<p>No books available.</p>';
        }
      }
    }
    ?>

</body>
</html>
