<?php
	// Tidy up user query
	if (!isset($query)) {
		// Accept either ?query= or ?q= from the UI.
		$requestQuery = $_GET['query'] ?? $_GET['q'] ?? '';
		$query = trim((string)$requestQuery);
	}
	else {
		$query = trim((string)$query);
	}

	// Default variables
	$rows = [];
	$title = '';
	$search_error = null;

	if ($query !== '') {
		$like = "%" . $query . "%";

		$stmt = $conn->prepare(
			"SELECT BookTitle, Author, Edition, Year, ISBN FROM Books WHERE BookTitle LIKE ? OR Author LIKE ? OR ISBN LIKE ? LIMIT 50"
		);
		if ($stmt) {
			$likeTitle = $like;
			$likeAuthor = $like;
			$likeISBN = $like;

			$stmt->bind_param('sss', $likeTitle, $likeAuthor, $likeISBN);
			$stmt->execute();
			$result = $stmt->get_result();

			$title = 'Search results for “' . htmlentities($query) . '”';
			if ($result) {
				$rows = $result->fetch_all(MYSQLI_ASSOC);
			} else {
				$rows = [];
			}

			$stmt->close();
		}
		else {
			// Surface a friendly error while avoiding exposing database details.
			$search_error = 'Error preparing search statement.';
		}

	} 
	else {
		// No query supplied: return a tiny default set for the landing view.
		$stmt = $conn->prepare("SELECT BookTitle, Author, Edition, Year, ISBN FROM Books LIMIT ?");
		if ($stmt) {
			$limit = 5;
			$stmt->bind_param('i', $limit);
			$stmt->execute();
			$result = $stmt->get_result();

			$title = 'Books';
			if ($result) {
				$rows = $result->fetch_all(MYSQLI_ASSOC);
			}
			else {
				$rows = [];
			}

			$stmt->close();
		}
	}
?>
