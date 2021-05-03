<?php
	include('config.php');
	//session_start();

	$logged_in = false;

	if(!isset($_SESSION['login_user'])){
		//header("Location: index.php");
		$logged_in = false;
		return;
		//die();
	} else {
		$logged_in = true;
		$user_check = $_SESSION['login_user'];
		$user_type = $_SESSION['user_type'];

		if ($user_type == 'agente'){
			$ses_sql = mysqli_query($db, "SELECT idAgente FROM agente WHERE idAgente LIKE '$user_check'");

			$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
			$login_session = $row['idAgente'];
		} elseif ($user_type == 'cliente'){
			$ses_sql = mysqli_query($db, "SELECT idCliente FROM cliente WHERE idClietne LIKE '$user_check'");
			
			$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
			$login_session = $row['idCidAgenteliente'];
		}
	}
?>