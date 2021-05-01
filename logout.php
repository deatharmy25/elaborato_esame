<?php
	session_start();

	//put_token('');

	if(session_destroy()) {
		header("Location: index.html");
	}

	function put_token($token, $id_user){
		$mysql = new mysqli('localhost','romeotechnologies','6K4nHTNFsb8p','my_romeotechnologies');

		$query = "UPDATE utente SET token='$token' WHERE id = $id_user";
		$result = $mysql->query($query);
	}
?>