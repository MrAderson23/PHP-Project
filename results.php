<?php
	require_once "conn.php";
	// (A) DATABASE CONFIG - CHANGE TO YOUR OWN!

	// (B) CONNECT TO DATABASE
	$pdo = new PDO(
		"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
		DB_USER,
		DB_PASSWORD,
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]
	);

	// (C) SEARCH
	$stmt = $pdo->prepare(
		"SELECT * FROM `users` WHERE `firstname` LIKE ? OR `email` LIKE ?"
	);
	
	$stmt->execute(["%" . $_POST["search"] . "%", "%" . $_POST["search"] . "%"]);
	$results = $stmt->fetchAll();
	
	if (isset($_POST["ajax"])) {
		echo json_encode($results);
	}
?>
