<?php
	$query = $_GET['searchBook'] ?? '';
	$search_message = '';
	$search_error = false;
	$rows = [];
	$title = '';

	// Searchs for books if there is a query
	if ($query != '') {
		// Allows for partial search
		$querySearch = "%".$query."%";


		// SQL for checking if query matches title, author, ISBN, or category
		$sql = "
			SELECT BookTitle, Author, Edition, Year, ISBN
			FROM Books
			WHERE BookTitle LIKE '$querySearch' 
			OR Author LIKE '$querySearch' 
			OR ISBN LIKE '$querySearch' 
			OR Category LIKE '$querySearch';
		";
		$result = mysqli_query($conn, $sql);
		
		if ($result) {
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			// search_error is true if no results found
			if (!$rows) {
            	$search_error = true;
        	}
		}
		else {
			echo "NO BOOKS FOUND";
			$search_error = true;
		}
	}
	
	// Default list if no search term (5 results max)
	else {
		$sql = "SELECT BookTitle, Author, Edition, Year, ISBN FROM Books LIMIT 5";
		$result = mysqli_query($conn, $sql);
		
		// Update the heading for the default view.
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$search_message = "*Due to no search query, top 5 books are shown";
	}
?>
