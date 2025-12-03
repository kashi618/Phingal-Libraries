<?php require 'functions/database.php'; ?>
<?php include 'functions/search.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Phingal Libraries</title>
<head>
<body>
<!-- Header -->
  <br>
  <?php require 'functions/header.php'; ?>
<!-- Navbar -->
  <?php require 'functions/navbar.php'; ?>

  <br>

<!-- new search -->
  <input class="searchbar" type="text" name="text" placeholder="search...">

  <?php
    $sql = "SELECT BookTitle, Author, Edition, Year, ISBN FROM Books LIMIT 5";
    $result = $conn->query($sql);
    
    echo "<h2>Books</h2>";

    if($result->num_rows > 0) {
      echo "
      <table border='1'>
      <tr><td>Title</td>
      <td>Author</td>
      <td>Edition</td>
      <td>Year</td>
      <td>ISBN</td></tr>
      ";
      while ($row = $result->fetch_assoc()) {
	echo "<tr><td>".htmlentities($row["BookTitle"])."</td>";
	echo "<td>".htmlentities($row["Author"])."</td>";
	echo "<td>".htmlentities($row["Edition"])."</td>";
	echo "<td>".htmlentities($row["Year"])."</td>";
	echo "<td>".htmlentities($row["ISBN"])."</td></tr>";
      }
      echo "</table>";
    }
  ?>  

</body>
</html>
