<?php
	$query = $_GET['searchBook'] ?? '';
	$selected_category = $_GET['category'] ?? '';
	$selected_author = $_GET['author'] ?? '';
	$search_error = false;
	$filters_applied = false;
	$rows = [];

	// Preload categories
	$category_results = mysqli_query($conn, "SELECT CategoryID, CategoryDescription FROM Categories ORDER BY CategoryDescription");
	if ($category_results) {
		$categories = mysqli_fetch_all($category_results, MYSQLI_ASSOC);
	}

	// Preload authors
	$author_results = mysqli_query($conn, "SELECT DISTINCT Author FROM Books ORDER BY Author");
	if ($author_results) {
		$authors = mysqli_fetch_all($author_results, MYSQLI_ASSOC);
	}

	// Regular search query
	if ($query != '') {
		$filters_applied = true;
		$escaped_query = mysqli_real_escape_string($conn, $query);
		$conditions[] = "
			(
				BookTitle LIKE '%$query%'
				OR Author LIKE '%$query%'
				OR ISBN LIKE '%$query%'
				OR CategoryDescription LIKE '%$query%'
			)
		";
	}

	// Category filter
	if ($selected_category !== '') {
		$filters_applied = true;
		$conditions[] = "CategoryID = ".intval($selected_category);
	}

	// Author filter
	if ($selected_author !== '') {
		$filters_applied = true;
		$escaped_author = mysqli_real_escape_string($conn, $selected_author);
		$conditions[] = "Author = '$escaped_author'";
	}

	// Results if filter is used (author, category, regular search)
	if ($filters_applied) {
		$sql = "
			SELECT BookTitle, Author, Edition, Year, ISBN, ReservedStatus
			FROM Books
			JOIN Categories USING (CategoryID)
			WHERE ".implode(' AND ', $conditions)."
		";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			if (!$rows) {
				$search_error = true;
			}
		}
		else {
			$search_error = true;
		}
	}
	// Results for if no search query or filters are applied (max 5)
	else {
		$sql = "SELECT BookTitle, Author, Edition, Year, ISBN, ReservedStatus FROM Books LIMIT 5";
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		$search_message = "*Due to no search query, top 5 books are shown";
	}
?>
