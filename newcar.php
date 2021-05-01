<?php
	// http://romeotechnologies.altervista.org/index.php?materia=Francese
	// GET - Data una materia in input, restituisce tutti i voti di quella materia
	/*
	 * Modifiche da fare per POST
	 *	- POST tramite JSON di un voto
	 *	- POST tramite JSON di una materia
	*/
	include('session.php');

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		if (!isset($_GET['materia']) && !isset($_GET['materie'])){  
			print_error("Syntax error Get 1");
			http_response_code(401);
			return;
		}

		// accesso al database
		$mysql = new mysqli('localhost','root','*****','my_romeotechnologies');
		if (!$mysql){
			print_error("Database error: login error");
			http_response_code(501);
			return;
		}

		if (isset($_GET['token'])){
			$user_token = $_GET['token'];

			$query = "SELECT id FROM utente WHERE utente.token LIKE '$user_token'";
			$result = $mysql->query($query);

			if ($result->num_rows != 1){
				print_error("User not authorised (" .$result->num_rows. ")");
				http_response_code(511);
				return;
			}
			
			$id_user = $result->fetch_assoc()['id'];
		} else 
			$id_user = $login_session_id;
		
		if (isset($_GET['materia'])){
			// reperimento parametri con $_GET
			$materia = $_GET["materia"];

			if (strlen($materia) > 2){
				$materia = strtoupper($materia);

				// query ed estrazione risultati
				$query = "SELECT * FROM voto AS v, materia AS m WHERE UPPER(m.nome) LIKE '%$materia%' AND m.codiceMateria = v.codiceMateria AND v.userID = $id_user";
			} else
				$query = "SELECT * FROM voto AS v WHERE v.codiceMateria = $materia AND v.userID = $id_user";
		} elseif (isset($_GET['materie']))
			$query = "SELECT * FROM materia";

		$result = $mysql->query($query);

		if (!$result){
			print_error("Database error 2");
			http_response_code(502);
			return;
		}

		if ($result->num_rows > 0){
			if (isset($_GET['materia'])){
				$response = "{\"Status\": \"Ok\",\"Voti\":[";

				while ($row = $result->fetch_assoc()){
					$response .= "{\"Voto\": " .$row['voto']. ",\"Valore\": " .$row['valore']. ",\"Datetime\": \"" .$row['datetime']. "\",\"Descrizione\": \"" .$row['descrizione']. "\",\"CodiceMateria\": " .$row['codiceMateria']. "},";
					/*
						// Stessa cosa che c'è scritta sopra ma in formato leggibile
						$response .= "{
							\"Voto\": " .$row['voto']. ",
							\"Valore\": " .$row['valore']. ",
							\"Datetime\": \"" .$row['datetime']. "\",
							\"Descrizione\": \"" .$row['descrizione']. "\",
							\"CodiceMateria\": " .$row['codiceMateria']. "
						},";
					*/
				}
			} else {
				$response = "{\"Status\": \"Ok\",\"Materie\":[";

				while ($row = $result->fetch_assoc()){	
					$response .= "{\"Nome\": \"" .$row['nome']. "\",\"CodiceMateria\": " .$row['codiceMateria']. ",\"Professore1\": \"" .$row['professore1']. "\",\"Professore2\": \"" .$row['professore2']. "\"},";
					/*
						// Stessa cosa che c'è scritta sopra ma in formato leggibile
						$response .= "{
							\"Nome\": \"" .$row['nome']. "\",
							\"CodiceMateria\": " .$row['codiceMateria']. ",
							\"Professore1\": \"" .$row['professore1']. "\",
							\"Professore2\": \"" .$row['professore2']. "\"
						},";
					*/
				}
			}

			$response = substr($response, 0, -1);
			$response .= "]}";


			header('Content-type: application/json');
			echo $response;
		} else { 
			print_error("Database error 3");
			http_response_code(503);
			return;
		}      
	}
	// POST - Dato un file JSON col voto, valore, descrizione e codice della materia
	elseif($_SERVER['REQUEST_METHOD'] == 'POST'){ //Inserimento
		//reperimento dati di post
		$f=file_get_contents("php://input");
		if (!$f){
			print_error("Syntax error 1");
			http_response_code(400);
			return;
		}

		//parsificazione dati
		$json = json_decode($f);
		if (!$json){
			print_error("Syntax error 2");
			http_response_code(401);
			return;
		}

		//reperimento dati seguendo la struttura di tag annidati del documento json
		if (!$json->Voto || !$json->Valore || !$json->Descrizione || !$json->CodiceMateria){
			print_error("Syntax error 3");
			http_response_code(402);
			return;
		}  
		$voto = $json->Voto;
		$valore = $json->Valore;
		$descrizione = $json->Descrizione;
		$codiceMateria = $json->CodiceMateria;

		//accesso al database
		$mysql = new mysqli('localhost','romeotechnologies','6K4nHTNFsb8p','my_romeotechnologies');
		if (!$mysql){  
			print_error("Database error");
			http_response_code(501);
			return;
		}

		//query di inserimento
		$query = "INSERT INTO voto (voto, valore, descrizione, codiceMateria, userId) VALUES ($voto,$valore,'$descrizione',$codiceMateria,$login_session_id)";
		$result = $mysql->query($query);
		if ($result)
			//print_confirm()
			http_response_code(200);
		else{  
			print_error("Errore nella query");
			http_response_code(502);
		}
	}
	/*
	// DELETE
	elseif($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		//controllo che sia stato passato il parametro id
		if (!isset($_GET['id'])){  
			echo "Syntax error";
			http_response_code(400);
			return;
		}
		//reperimento parametri con $_GET
		$id=$_GET["id"];
		$array = explode(" ", $id);
		//controllo numero dei parametri
		if (count($array)!=2){  
			echo "Syntax error";
			http_response_code(401);
			return;
		}
		$nome=$array[0];
		$cognome=$array[1];
		//accesso al database
		$mysql = new mysqli('localhost','rob','roby1963','rubrica');
		if (!$mysql){  
			echo "Database error";
			http_response_code(501);
			return;
		}
		//query di cancellazione
		$query="DELETE FROM persone WHERE nome='".$nome."' AND cognome='".$cognome."'";
		$result = $mysql->query($query);
		if ($result)
			http_response_code(200);
		else{  
			echo "Errore nella query";
			http_response_code(502);
		}
	}
	// PUT
	elseif($_SERVER['REQUEST_METHOD'] == 'PUT'){
		//controllo che sia stato passato il parametro id
		if (!isset($_GET['id'])){  
			echo "Syntax error";
			http_response_code(400);
			return;
		}
		//reperimento parametri con $_GET
		$id=$_GET["id"];
		$array = explode(" ", $id);
		//controllo numero dei parametri
		if (count($array)!=2){  
			echo "Syntax error";
			http_response_code(401);
			return;
		}
		$nome=$array[0];
		$cognome=$array[1];
		//accesso al database
		$mysql = new mysqli('localhost','rob','roby1963','rubrica');
		if (!$mysql){  
			echo "Database error";
			http_response_code(501);
			return;
		}
		//reperimento dati di put
		$f=file_get_contents("php://input");
		if (!$f){
			echo "Syntax error";
			http_response_code(400);
			return;
		}
		//parsificazione dati
		echo $f;
		$xml = simplexml_load_string($f);
		if (!$xml){
			echo "Syntax error";
			http_response_code(400);
			return;
		}
		if (!$xml->telefono){
			echo "Syntax error";
			http_response_code(400);
			return;
		}  
		//reperimento dati seguendo la struttura di tag annidati del documento xml
		$telefono=$xml->telefono;
		//query di aggiornamento
		$query="UPDATE persone SET tel='".$telefono."' WHERE nome='".$nome."' AND cognome='".$cognome."'";
		//echo $query;
		$result = $mysql->query($query);
		if ($result)
			http_response_code(200);
		else{  
			echo "Errore nella query";
			http_response_code(502);
		}
	}
	*/
	else {//errore
		print_error("Metodo sconosciuto");
		http_response_code(400);
	}

	function print_error($error_message){
		$response = "{\"Status\": \"Err\",\"Desc\": \"" .$error_message. "\"}";
		header('Content-type: application/json');

		echo $response;
	}

	function print_confirm(){
		$response = "{\"Status\": \"Ok\"}";
		header('Content-type: application/json');

		echo $response;
	}
?>