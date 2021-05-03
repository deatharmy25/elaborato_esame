<?php
	//include('session.php');
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		if (!isset($_GET['veicolo']) || !isset($_GET['txtCerca'])){
			print_error("Syntax error Get 1");
			http_response_code(401);
			return;
		}

		$mysql = new mysqli('localhost', 'root', '', 'esame');
		if (!$mysql){
			print_error("Database error: login error");
			http_response_code(501);
			return;
		}
		
		if (isset($_GET['veicolo']))
			$veicolo = $_GET["veicolo"];
		elseif (isset($_GET['txtCerca']))
			$veicolo = $_GET["txtCerca"];
		else {
			print_error("Syntax error Get 1");
			http_response_code(401);
			return;
		}

		if (is_numeric($veicolo)) {
			// Ricerca per un numero di telaio specifico
			$query = "SELECT * FROM veicolo WHERE numeroTelaio = " .$veicolo;
		} elseif ($veicolo == 'all'){
			// Ottenimento di tutti i veicoli
			$query = "SELECT * FROM veicolo";
		} else {
			// Ricerca per marca e/o modello
			$query = "SELECT * FROM veicolo WHERE marca LIKE '%" .$veicolo. "%' OR modello LIKE '%" .$veicolo. "%'";
		}

		$result = $mysql->query($query);

		if (!$result){
			print_error("Database error 2");
			http_response_code(502);
			return;
		}

		if ($result->num_rows > 0){
			$response = '{"status": "ok", "veicoli": [';

			while($row = $result->fetch_assoc()){
				$response .= '{marca: "' .$row['marca']. '",modello: "' .$row['modello']. '",isNuovo: ' .$row['isNuovo']. ',prontaConsegna: ' .$row['prontaConsegna']. ',chilometri: ' .$row['chilometri']. ',foto: "' .$row['foto']. '",cilindrata: ' .$row['cilindrata']. ',idColore: ' .$row['idColore']. ',dataImmatricolazione: "' .$row['dataImmatricolazione']. '",velocitaMassima: ' .$row['velocitaMassima']. ',idCategoria: ' .$row['idCategoria']. ',idTrattativa: ' .$row['idTrattativa']. ',qrCode: "' .$row['qrCode']. '"},';
				/*
					// Stessa cosa che c'è scritta sopra ma in formato leggibile
					$response = '{
						marca: "' .$row['marca']. '",
						modello: "' .$row['modello']. '",
						isNuovo: ' .$row['isNuovo']. ',
						prontaConsegna: ' .$row['prontaConsegna']. ',
						chilometri: ' .$row['chilometri']. ',
						foto: "' .$row['foto']. '",
						cilindrata: ' .$row['cilindrata']. ',
						idColore: ' .$row['idColore']. ',
						dataImmatricolazione: "' .$row['dataImmatricolazione']. '",
						velocitaMassima: ' .$row['velocitaMassima']. ',
						idCategoria: ' .$row['idCategoria']. ',
						idTrattativa: ' .$row['idTrattativa']. ',
						qrCode: "' .$row['qrCode']. '"
					}';
				*/
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
	/*
		// POST - Dato un file JSON col voto, valore, descrizione e codice della materia
		elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$f=file_get_contents("php://input");
			if (!$f){
				print_error("Syntax error 1");
				http_response_code(400);
				return;
			}

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
	else {
		print_error("Metodo sconosciuto");
		http_response_code(400);
	}

	function print_error($error_message){
		$response = '{"status": "err", "desc": "' .$error_message. '"}';
		header('Content-type: application/json');

		echo $response;
	}

	function print_confirm(){
		$response = '{"status": "ok"}';
		header('Content-type: application/json');

		echo $response;
	}
?>