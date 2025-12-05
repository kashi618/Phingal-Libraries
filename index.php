<?php 
  session_start();

  require "functions/database.php";
  require "functions/logout.php";
  require "functions/register.php"; 

  $all_books = [];
  $books_query = $conn->query("SELECT BookTitle, Author, Edition, Year, ISBN, ReservedStatus 
    FROM Books ORDER BY BookTitle ASC");
  if ($books_query) {
    $all_books = $books_query->fetch_all(MYSQLI_ASSOC);
  }

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
  <h1>Welcome to Phingal Libraries</h1>

  <div class="home">
    <h2 style="margin-top: -15px;">Getting Started</h2>
    <ul>
      <li>To search for books, go to the <b>"search"</b> tab</li>
      <li>To view books you have reserved, go to the <b>"reserved"</b> tab</li>
      <li>To view information about this website, go to the <b>"about"</b> tab</li>
    </ul>

    <h2>Current Books in Library</h2>
    <table border="1">
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Edition</th>
        <th>Year</th>
        <th>ISBN</th>
        <th>Status</th>
      </tr>
      <?php foreach ($all_books as $book): ?>
        <tr>
          <td><?php echo htmlentities($book['BookTitle']); ?></td>
          <td><?php echo htmlentities($book['Author']); ?></td>
          <td><?php echo htmlentities($book['Edition']); ?></td>
          <td><?php echo htmlentities($book['Year']); ?></td>
          <td><?php echo htmlentities($book['ISBN']); ?></td>
          <td><?php echo htmlentities($book['ReservedStatus']); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    
    
  </div>
</body>
</html>
