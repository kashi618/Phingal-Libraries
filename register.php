<?php require 'functions/database.php' ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
   <div class="topbar">
    <a class="active" href="#home">Library</a>
    <a href="#news">Reserved Books</a>
    <a href="#contact">Account</a>
    <a href="#about">About</a>
  </div> 

  <center>
  <form method="post">
    <p>Username</p>
    <input type="text" name="username" placeholder="JarlUlfric123">

    <p>Password</p>
    <input type="password" name="password" placeholder="123456">

    <p>Confirm Password</p>
    <input type="password" name="passwordConfirm" placeholder="123456">

    <p>First Name</p>
    <input type="text" name="firstname" placeholder="Ulfric"> 

    <p>Surname</p>
    <input type="text" name="surname" placeholder="Stormcloak">

    <p>Address Line</p>
    <input type="text" name="addressLine" placeholder="The Winking Skeever">

    <p>Address Line Other</p>
    <input type="text" name="addressLineOther" placeholder="Castle District">

    <p>City</p>
    <input type="text" name="city" placeholder="Solitude">

    <p>Country</p>
    <input type="text" name="country" placeholder="Skyrim">

    <p>Telephone</p>
    <input type="text" name="telephone" placeholder="9876543210">  

    <p>Mobile</p>
    <input type="text" name="mobile" placeholder="0871234567">

    <p><input type="submit" value="Login"> <input type="reset" value="Reset"></p>
  </form>
  </center>
</body>
</html>
