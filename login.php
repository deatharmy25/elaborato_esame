<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['username']) && isset($_POST['password'])){
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
		} else {
			return;
		}

		$sql = "SELECT * FROM cliente, agente WHERE cliente.idCliente LIKE '$username' AND cilente.password LIKE '$password' OR agente.idAgente LIKE '$username' AND agente.password LIKE '$password'";
		$result = mysqli_query($db, $sql);

		//$id_user = $result->fetch_assoc();

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$active = $row['active'];
		$id_user = $row['id'];

		$count = mysqli_num_rows($result);

		if($count == 1) {
			//session_register("username"); // Non so a cosa servisse ma senza funziona
			$_SESSION['login_user'] = $username;

			header("location: ../index.html");
		} else {
			echo '<p class=".error">Account non trovato. <a href="signup.html">Registrati</a></p>';
		}
	}
?>
