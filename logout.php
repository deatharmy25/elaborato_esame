<?php
	/*
	if (!isset($_SESSION)){
		session_start();
	*/
	session_start();

	$_SESSION["loggedIn"] = false;

	session_unset();
	session_destroy();
	
	header("Location: index.php");
?>