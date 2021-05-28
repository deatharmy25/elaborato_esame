<?php
	include('config.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		if (!isset($_GET['veicolo']) && !isset($_GET['txtCerca'])){
			print_error("Syntax error Get 1");
			http_response_code(401);
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
				$response .= '{"marca": "' .$row['marca']. '","modello": "' .$row['modello']. '","isNuovo": ' .$row['isNuovo']. ',"prontaConsegna": ' .$row['prontaConsegna']. ',"chilometri": ' .$row['chilometri']. ',"foto": "' .$row['foto']. '","cilindrata": ' .$row['cilindrata']. ',"idColore": ' .$row['idColore']. ',"dataImmatricolazione": "' .$row['dataImmatricolazione']. '","velocitaMassima": ' .$row['velocitaMassima']. ',"idCategoria": ' .$row['idCategoria']. ',"idOperazione": ';
					
				if ($row['idOperazione'] == null)
					$response .= '"null"';
				else
					$response .= $row['idOperzione'];

				$response .= ',"qrCode": "' .$row['qrCode']. '"},';
				/*
					// Stessa cosa che c'è scritta sopra ma in formato leggibile
					$response .= '{
						"marca": "' .$row['marca']. '",
						"modello": "' .$row['modello']. '",
						"isNuovo": ' .$row['isNuovo']. ',
						"prontaConsegna": ' .$row['prontaConsegna']. ',
						"chilometri": ' .$row['chilometri']. ',
						"foto": "' .$row['foto']. '",
						"cilindrata": ' .$row['cilindrata']. ',
						"idColore": ' .$row['idColore']. ',
						"dataImmatricolazione": "' .$row['dataImmatricolazione']. '",
						"velocitaMassima": ' .$row['velocitaMassima']. ',
						"idCategoria": ' .$row['idCategoria']. ',
						"idOperazione": ';
						
						if (idTrattativa == null)
							$response .= '"null"';
						else
							$response .= $row['idTrattativa'];
						$response .= ',"qrCode": "' .$row['qrCode']. '"';
					},';
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
	} else {
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