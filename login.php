<?php
  session_start();
  
  require "functions/database.php";
  require "functions/loginForm.php";
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Phingal Libraries</title>
</head>
<body>
  By Neil Jiang - C24510496
  <?php require 'functions/header.php'; ?>

  <center><h1>Please Login!</h1></center>

  <form method="post">
  <div class="login-form">  
    <label>
      Username
      <input type="text" name="username" placeholder="Enter your Username">
    </label>
    
    <label>
      Password
      <input type="password" name="password" placeholder="Enter your password">
    </label>
  </div>

  <div class="login-form-buttons">
    <input type="submit" value="Login"><input type="reset"  value="Reset">
  </div>  
  </form>
  
  <div style="display: flex; justify-content: center; margin-top: 10px; font-size: 20px; color:red; font-style:italic;">
  <?php if ($login_error != '') {echo htmlspecialchars($login_error);} ?>
</div>

  <div style="font-size: 20px; display: flex; justify-content: center; margin-top:16px;">
    <br>Don't have an account?&nbsp<a href="register.php">Create account</a>
  </div>

</body>
</html>
