<?php 
  session_start();

  require 'functions/database.php';
  require "functions/logout.php";

  //require 'functions/reserveBook.php';
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
</head>
<body>
  <?php
    require "functions/accountMenu.php";
    require "functions/header.php";
    require "functions/navbar.php";
  ?>

  <h1>Search Books</h1>

  
  <!-- Searchbar -->
  <form method="get" action="searchBook.php" class="search-container">
    <input class="searchbar" type="text" name="searchBook" placeholder="SEARCH..." value="<?php echo htmlentities($query); ?>">
    <button class="searchbarButton" type="submit"><i class="fas fa-search"></i></button>
  </form>

  <h2>Books:</h2>

    <?php
      // Embeds user query into URL
      $action_url = 'searchBook.php';
      if ($query !== '') {
          $action_url .= '?searchBook=' . urlencode($query);
      }

      // Creates table of search results
      echo "
      <table border='1'>
      <tr>
        <td>Title</td>
        <td>Author</td>
        <td>Edition</td>
        <td>Year</td>
        <td>ISBN</td>
        <td>Reserve</td>
      </tr>
      ";

      foreach ($rows as $row) {
        echo '<tr><td>'.htmlentities($row['BookTitle']).'</td>';
        echo '<td>'.htmlentities($row['Author']).'</td>';
        echo '<td>'.htmlentities($row['Edition']).'</td>';
        echo '<td>'.htmlentities($row['Year']).'</td>';
        echo '<td>'.htmlentities($row['ISBN']).'</td>';
        echo '<td>';

        
        /*
        echo '<form method="post" action="'.$action_url.'">';
        echo '<input type="hidden" name="reserve_isbn" value="'.htmlentities($row['ISBN']).'">';
        echo '<input type="hidden" name="query" value="'.htmlentities($query).'">';
        echo '<button type="submit">Reserve</button>';
        $isbn = $row['ISBN'];
        $book_query = $conn->prepare("SELECT ReservedStatus FROM Books WHERE ISBN = ?");

        // Bind the ISBN value so we can fetch that book row.
        $book_query->bind_param('s', $isbn);

        // Execute the SELECT query.
        $book_query->execute();
        
        echo '</form>';
        echo '</td></tr>';
        */
        
      }
      echo "</table>\n"; 
      
      if ($search_error == true) {
          echo '<p>No books matched your search.</p>';
      }
    ?>

  <div style="margin-top: 16px; font-size: 20px; font-style:italic;">
    <?php if ($search_message != '') {echo htmlspecialchars($search_message);} ?>
  </div>

</body>
</html>
