<?php
	$reserved_rows = [];
	$reserved_error = null;

	if (!isset($conn) || !($conn instanceof mysqli)) {
		$reserved_error = 'Database connection is missing.';
		return;
	}

	if (!isset($_SESSION['username'])) {
		$reserved_error = 'You must be logged in to view reserved books.';
		return;
	}

	$username = $_SESSION['username'];
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
		WHERE r.Username = ?
		ORDER BY r.ReservedDate DESC, b.BookTitle ASC
	";

	$stmt = $conn->prepare($sql);
	if ($stmt === false) {
		$reserved_error = 'Unable to prepare reserved books query: '.$conn->error;
		return;
	}

	$stmt->bind_param('s', $username);

	if (!$stmt->execute()) {
		$reserved_error = 'Unable to execute reserved books query: '.$stmt->error;
		$stmt->close();
		return;
	}

	$result = $stmt->get_result();
	if ($result !== false) {
		$reserved_rows = $result->fetch_all(MYSQLI_ASSOC);
		$result->free();
	}
	else {
		$reserved_error = 'Unable to fetch reserved books: '.$stmt->error;
	}

	$stmt->close();
?>
