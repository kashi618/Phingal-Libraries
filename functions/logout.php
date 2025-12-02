<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    echo "logout";
    session_unset();
    session_destroy();
    header("Location: login.php");
  } 
?>
