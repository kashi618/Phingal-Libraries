<?php require 'functions/database.php';  ?>
<?php require 'functions/loginForm.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Phingal Libraries</title>
</head>
<body>

  <!-- User Login --!>
  <center>
  <h1>Please Login!</h1>
  <form method="post">
    <p>Username</p>
    <input type="text" name="username" placeholder="Enter your Username">

    <p>Password</p>
    <input type="password" name="password" placeholder="Enter your password">
    <p><input type="submit" value="Login"> <input type="reset"  value="Reset"></p>
  </form>
  
  <p style="color:red; font-style:italic;">
  <?php if ($login_error != '') {echo htmlspecialchars($login_error);} ?>
  </p>

  <p><br>Don't have an account? <a href="register.php">Create account</a></p>
  </center>

</body>
</html>
