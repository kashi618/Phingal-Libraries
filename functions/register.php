<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    session_unset();
    session_destroy();
    header("Location: register.php");
    exit;
  }
?>
