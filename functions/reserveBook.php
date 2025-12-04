<?php
	if (!isset($reserve_message)) {
		$reserve_message = '';
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['reserve_isbn'])) {
		return;
	}

	// Get username and ISBN
	$isbn = $_POST['reserve_isbn'];
	$username = $_SESSION['username'];

	// Check if book is already reserved
	$sql = "SELECT ReservedStatus FROM Books WHERE ISBN = '$isbn'";
	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	$isReserved = $result['ReservedStatus'];
	
	// If reserved, tell user its unavailable
	if ($isReserved === 'Y') {
		$reserve_message = 'This book is already reserved.';
		return;
	}
	// If not, reserve the book, tell the user, and update database
	else {
		$sql = "INSERT INTO ReservedBooks (ISBN, Username, ReservedDate) VALUES ('$isbn', '$username', CURDATE())";
		mysqli_query($conn, $sql);
		$sql = "UPDATE Books SET ReservedStatus = 'Y' WHERE ISBN = '$isbn'";
		mysqli_query($conn, $sql);
		
		$reserve_message = 'Book reserved successfully.';
	}
	return;
?>
