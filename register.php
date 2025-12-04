<?php 
  session_start();
  require 'functions/database.php'
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Phingal Libraries</title>
</head>
<body>
  <?php
    echo "<br>";
    require "functions/header.php";
  ?>
  <br>

  <center><h1>Please Register!</h1></center>

  <form class="register-form" method="post">
  <div class="register-form-column left">
    <label>
      Username
      <input class="register-form-input" type="text" name="username" placeholder="JarlUlfric123">
    </label>
    <label>
      Password
      <input class="register-form-input" type="password" name="password" placeholder="123456">
    </label>
    <label>
      Confirm Password
      <input class="register-form-input" type="password" name="passwordConfirm" placeholder="123456">
    </label>
  </div>
  <div class="register-form-column center">
    <label>
      First Name
      <input class="register-form-input" type="text" name="firstname" placeholder="Ulfric"> 
    </label>
    <label>
      Surname
      <input class="register-form-input" type="text" name="surname" placeholder="Stormcloak">
    </label>
    <label>
      Telephone
      <input class="register-form-input" type="text" name="telephone" placeholder="9876543210">  
    </label>
    <label>
      Mobile
      <input class="register-form-input" type="text" name="mobile" placeholder="0871234567">
    </label>
  </div>
  <div class="register-form-column right">
    <label>
      Address Line
      <input class="register-form-input" type="text" name="addressLine" placeholder="The Winking Skeever">
    </label>
    <label>
      Address Line Other
      <input class="register-form-input" type="text" name="addressLineOther" placeholder="Castle District">
    </label>
    <label>
      City
      <input class="register-form-input" type="text" name="city" placeholder="Solitude">
    </label>
    <label>
      Country
      <input class="register-form-input" type="text" name="country" placeholder="Skyrim">
    </label>
  </div>
  <div class="register-form-buttons">
    <input type="submit" value="Register"> <input type="reset" value="Reset"></p>
  </div>
  </form>

  <div style="font-size: 20px; display: flex; justify-content: center; margin-top: 20px;">
  <br>Have an account?&nbsp<a href="login.php">Login</a>
  </div>

</body>
</html>
