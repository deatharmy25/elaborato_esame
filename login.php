<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['txtId']) && isset($_POST['txtPassowrd'])){
			$id = mysqli_real_escape_string($db, $_POST['txtId']);
			$password = mysqli_real_escape_string($db, $_POST['txtPassword']);
		} else {
			return;
		}

		$sql = "SELECT * FROM cliente WHERE idCliente LIKE '$id' AND password LIKE '$password'";
		$result = mysqli_query($db, $sql);

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$active = $row['active'];
		$id_user = $row['idCliente'];

		$count = mysqli_num_rows($result);

		if ($count == 1){
			login_confirmed($id, 'cliente');
		} else {
			$sql = "SELECT * FROM agente WHERE idAgente LIKE '$id' AND password LIKE '$password'";
			$result = mysqli_query($db, $sql);
			
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$active = $row['active'];
			$id_user = $row['idAgente'];

			$count = mysqli_num_rows($result);

			if ($count == 1){
				login_confirmed($id, 'agente');
			} else {
				login_error();
			}
		}
	}

	function login_confirmed($id, $type){
		$_SESSION['login_user'] = $id;
		$_SESSION['user_type'] = $type;

		header("Location: index.php");
	}

	function login_error(){
		echo '<script>alert("Errore, ID o password errati")</script>';
	}
?>
