<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"/* || $_SERVER['REQUEST_METHOD'] == 'GET'*/) {
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['username']) && isset($_GET['password'])){
			// username and password sent from url
			$myusername = $_GET['username'];
			$mypassword = $_GET['password'];
		} else {
			// username and password sent from form
			$myusername = mysqli_real_escape_string($db, $_POST['username']);
			$mypassword = mysqli_real_escape_string($db, $_POST['password']);
			$token = mysqli_real_escape_string($db, $_POST['token']);
		}

		$sql = "SELECT id FROM utente WHERE username LIKE '$myusername' AND password LIKE '$mypassword'";
		$result = mysqli_query($db, $sql);

		//$id_user = $result->fetch_assoc();

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$active = $row['active'];
		$id_user = $row['id'];

		$count = mysqli_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row

		if($count == 1) {
			//session_register("myusername"); // Non so a cosa servisse ma senza funziona
			$_SESSION['login_user'] = $myusername;

			if ($token != 1){
				header("location: ../index.html");
			} else {
				$token = gen_token();
				put_token($token, $id_user);

				$response = "{\"Status\": \"Ok\",\"Token\": \"" .$token. "\"}";
				header('Content-type: application/json');

				echo $response;
			}
			
		}else {
			$response = "{\"Status\": \"Err\",\"Desc\": \"Your Login Name or Password is invalid\"}";
			header('Content-type: application/json');

			echo $response;
		}
	}

	function gen_token(){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$result = '';

		for ($index = 0; $index < 16; $index++)
			$result .= $characters[mt_rand(0, 61)];

		return $result;
	}

	function put_token($token, $id_user){
		$mysql = new mysqli('localhost','romeotechnologies','6K4nHTNFsb8p','my_romeotechnologies');

		$query = "UPDATE utente SET token='$token' WHERE id = $id_user";
		$result = $mysql->query($query);
	}
?>
