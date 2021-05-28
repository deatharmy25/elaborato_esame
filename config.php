<?php
	session_start();

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'my_romeotechnologies');

	$mysql = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	if (!$mysql){
		print_error("Database error: login error");
		http_response_code(501);
		return;
	}
?>