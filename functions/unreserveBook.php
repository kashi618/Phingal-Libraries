<?php
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['unreserve_isbn'])) {
		return;
	}

	// Get username and isbn
	$username = $_SESSION['username'];
	$isbn = $_POST['unreserve_isbn'];
	
	// Delete book from reservedBook
	$sql = "DELETE FROM ReservedBooks WHERE ISBN = \"$isbn\" AND Username = \"$username\";";
	$result = mysqli_query($conn, $sql);

	// Set book reservation status to N
	$sql = "UPDATE Books SET ReservedStatus = 'N' WHERE ISBN = \"$isbn\";";
	$result = mysqli_query($conn, $sql);

	$unreserve_message = 'Book unreserved successfully.';
?>
