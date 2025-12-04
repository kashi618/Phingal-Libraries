<?php
	if (!isset($unreserve_message)) {
		$unreserve_message = '';
	}
	if (!isset($unreserve_error)) {
		$unreserve_error = '';
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['unreserve_isbn'])) {
		return;
	}

	if (!isset($_SESSION['username'])) {
		$unreserve_error = 'Please log in before unreserving.';
		return;
	}

	if (!isset($conn) || !($conn instanceof mysqli)) {
		$unreserve_error = 'Database connection unavailable.';
		return;
	}

	$isbn = trim((string)$_POST['unreserve_isbn']);
	if ($isbn === '') {
		$unreserve_error = 'Invalid book selection.';
		return;
	}

	$username = $_SESSION['username'];

	$delete_stmt = $conn->prepare("DELETE FROM ReservedBooks WHERE ISBN = ? AND Username = ?");
	if ($delete_stmt === false) {
		$unreserve_error = 'Unable to process unreserve request.';
		return;
	}

	$delete_stmt->bind_param('ss', $isbn, $username);
	if (!$delete_stmt->execute()) {
		$unreserve_error = 'Failed to unreserve the book.';
		$delete_stmt->close();
		return;
	}

	if ($delete_stmt->affected_rows === 0) {
		$unreserve_error = 'No matching reservation found.';
		$delete_stmt->close();
		return;
	}
	$delete_stmt->close();

	$still_reserved = false;
	$check_stmt = $conn->prepare("SELECT 1 FROM ReservedBooks WHERE ISBN = ? LIMIT 1");
	if ($check_stmt) {
		$check_stmt->bind_param('s', $isbn);
		$check_stmt->execute();
		$result = $check_stmt->get_result();
		$still_reserved = $result && $result->num_rows > 0;
		if ($result) {
			$result->free();
		}
		$check_stmt->close();
	}

	if (!$still_reserved) {
		$status_stmt = $conn->prepare("UPDATE Books SET ReservedStatus = 'N' WHERE ISBN = ?");
		if ($status_stmt) {
			$status_stmt->bind_param('s', $isbn);
			$status_stmt->execute();
			$status_stmt->close();
		}
	}

	$unreserve_message = 'Book unreserved successfully.';
?>
