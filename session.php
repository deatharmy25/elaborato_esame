<?php
	include('config.php');
	session_start();

	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($db, "SELECT username, id, token FROM utente WHERE username LIKE '$user_check'");
	$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

	$login_session = $row['username'];
	$login_session_id = $row['id'];

	if(!isset($_SESSION['login_user']) && !isset($_GET['token'])){
		header("location:login.html");
		die();
	}
?>