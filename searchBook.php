<?php 
  session_start();

  require 'functions/database.php';
  require "functions/logout.php";

  require 'functions/reserveBook.php';
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
    <select name="category">
      <option value="">All categories</option>
      <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlentities($category['CategoryID']); ?>"<?php echo htmlentities($category['CategoryDescription']); ?></option>
      <?php endforeach; ?>
    </select>
    <select name="author">
      <option value="">All authors</option>
      <?php foreach ($authors as $author): ?>
        <option value="<?php echo htmlentities($author['Author']); ?>"><?php echo htmlentities($author['Author']); ?></option>
      <?php endforeach; ?>
    </select>
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
        <th>Title</th>
        <th>Author</th>
        <th>Edition</th>
        <th>Year</th>
        <th>ISBN</th>
        <th>Status</th>
        <th>Reserve</th>
      </tr>
      ";

      // Table format
      foreach ($rows as $row) {
        echo '
        <tr><td>'.htmlentities($row['BookTitle']).'</td>'.
        '<td>'.htmlentities($row['Author']).'</td>'.
        '<td>'.htmlentities($row['Edition']).'</td>'.
        '<td>'.htmlentities($row['Year']).'</td>'.
        '<td>'.htmlentities($row['ISBN']).'</td>';

        // Red Green Reserve Status
        $status = $row['ReservedStatus'] ?? '';
        if ($status === 'Y') {
          $status_class = 'status-reserved';
          $status_text = 'Reserved';
        }
        else {
          $status_class = 'status-available';
          $status_text = 'Available';
        }
        echo '<td><span class="'.htmlentities($status_class).'">'.htmlentities($status_text).'</span></td>';
        
        echo "
          <td>
          <form method=\"post\" action=\"". htmlentities($action_url) . "\" style=\"margin:0;\">
          <input type=\"hidden\" name=\"reserve_isbn\" value=\"" . htmlentities($row['ISBN']) . "\">
          <input type=\"hidden\" name=\"searchBook\" value=\"" . htmlentities($query) . "\">
          <button type=\"submit\">Reserve</button>
          </form>
          </td></tr>
        ";
      }
      echo "</table>\n"; 
      
      // Success message
      if ($reserve_message !== '') {
        echo '<p class="success-message">'.htmlspecialchars($reserve_message).'</p>';
      }
      // Error message
      if ($search_error == true) {
          echo '<p>No books matched your search.</p>';
      }
    ?>

  <div style="margin-top: 16px; font-size: 20px; font-style:italic;">
    <?php if ($search_message != '') {echo htmlspecialchars($search_message);} ?>
  </div>

</body>
</html>
