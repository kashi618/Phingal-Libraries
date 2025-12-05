<?php
    $login_error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
		$password = trim($_POST['password'] ?? '');

	// Check if user has missing values
	if ($username === '' || $password === '') {
	    $login_error = "Please enter both username and password";
	}
	// Checks user's password and username
	else {
	    $sql = "SELECT * FROM UserDetails WHERE Username='$username' AND Password='$password'";
	    $result = mysqli_query($conn, $sql);
	    
	    if ($result && mysqli_num_rows($result) === 1) {
	        $user = mysqli_fetch_assoc($result);
      		
			$_SESSION['username'] = $username;
			header('Location: index.php');
	    	exit;
	    }
	    else {
	        $login_error = "Incorrect username or password";
	    }
	}
    }
?>
