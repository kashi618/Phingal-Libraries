<?php
	$reserved_rows = [];
	$reserved_error = null;
	$username = $_SESSION['username'];

	// SQL query to get reserved books from the user
	$sql = "
		SELECT 
			b.BookTitle AS BookTitle,
			b.Author AS Author,
			b.Edition AS Edition,
			b.Year AS Year,
			b.ISBN AS ISBN,
			r.ReservedDate AS ReservedDate
		FROM `ReservedBooks` r
		INNER JOIN Books b ON b.ISBN = r.ISBN
		WHERE r.Username = '{$username}'
		ORDER BY r.ReservedDate DESC, b.BookTitle ASC
	";

	// Call sql query, and return results
	$result = mysqli_query($conn, $sql);
	$reserved_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
