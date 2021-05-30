<?php
	include('config.php');

	session_start();
	/*
	if (!isset($_SESSION)){
		session_start();
		$_SESSION["loggedIn"] = false;
	}
	*/

	// Controllo del browser
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE){
		print_browser_alert('Internet Explorer');
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE){ //For Supporting IE 11
	    print_browser_alert('Internet Explorer');
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
		print_browser_alert('Firefox');
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE){}
	elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE){}
	elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE){}
	elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE){}
	else{
	   	print_browser_alert('un Browser Sconosiuto');
	}

	function print_browser_alert($browser){
		echo '<script>alert("Attenzione, sembra che tu stia usando ' .$browser. '\nÈ possibile che alcune funzioni non siano disponibili o che non funzionino correttamente.\nUtilizzare un browser come Google Chrome oppure derivate di Chromium (Esempio: Microsoft Edge o Brave)")</script>';
	}
?>

<html lang="it">
	<head>
		<meta charset="utf-8" />
		<title>New Car</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Elaborato d'esame di maturità 2021">
		<meta name="author" content="Armando Romeo">
		<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
		<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body id="page-top" onload="document.tabellaVeicoli">
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="index.php">
					<img src="assets/img/favicon.ico" alt="New Car Icon">
					New Car
				</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					Menu
					<i class="fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#about">Informazioni sulla Concessionaria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#showroom">Concessionaria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#signup">Sezione utente</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#contacts">Contatti</a>
						</li>
					</ul>
					<hr>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#signup">
								<?php
									if (!$_SESSION["loggedIn"]){
										echo 'Login
										<i class="fas fa-sign-in-alt"></i>';
									} else {
										echo 'Logout
										<i class="fas fa-sign-out-alt"></i>';
									}
								?>
							</a>
                        </li>
                    </ul>
				</div>
			</div>
		</nav>
		<header class="masthead">
			<div class="container d-flex h-100 align-items-center">
				<div class="mx-auto text-center">
					<h1 class="mx-auto my-0 text-uppercase">New Car</h1>
					<h2 class="text-white-50 mx-auto mt-2 mb-5">
						Concessionaria FCI<br>Elaborato d'Esame, maturità 2021
					</h2>
					<a class="btn btn-primary js-scroll-trigger" href="#about">Scopri di più</a>
				</div>
			</div>
		</header>
		<section class="about-section text-center" id="about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="text-white mb-4">Informazioni</h1>
						<p class="text-white-50">
							La “<b><i>NewCar</i></b>” è una piccola società all'interno della nostra regione (<a href="https://it.wikipedia.org/wiki/Valle_d%27Aosta" target="_blank">Valle d'Aosta</a>) operante nel settore del commercio di automobili del gruppo automobilistico <b>FCI</b>.
							<br>
							Offriamo servizi online per la consultazione e la vendita di veicoli nuovi in pronta consegna e usato tramite il nostro Showroom virtuale!

						</p>
					</div>
				</div>
			</div>
		</section>
		<section class="projects-section bg-light" id="showroom">
			<div class="container col-6">
				<h1 class="text-center">Showroom</h1>
				<div class="justify-content-center no-gutters mb-5 mb-lg-0">
					<form method="GET" name='tabellaVeicoli'>
						<div class="row form-inline">
							<label for="txtCerca" class="mr-0 mr-sm-2 mb-3 mb-sm-3">Veicolo da cercare:</label>
							<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" type="text" name="txtCerca" placeholder="Esempio: Maserati Levante"/>
						</div>
						<div class="row">
							<div class="col-xl-6">
								<div class="container">
									<label class="mr-0 mr-sm-2 mb-3 mb-sm-3">Filtri di ricerca</label>
								</div>
								<div class="container">
									<div class="container">
										<input class="mr-0 mr-sm-2 mb-3 mb-sm-3" type="radio" name="chkStato" value="nuovo"/>
										<label for="chkNuovo" class="mr-0 mr-sm-2 mb-3 mb-sm-3">Nuovo</label>
									</div>
									<div class="container">
										<input class="mr-0 mr-sm-2 mb-3 mb-sm-3" type="radio" name="chkStato" value="usato"/>
										<label for="chkNuovo" class="mr-0 mr-sm-2 mb-3 mb-sm-3">Usato</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<button class="form-control flex-fill btn-primary mx-auto" name="btnCerca" type="submit" formaction="#showroom">
								Cerca
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="container col-4 align-content-center">
				<?php
					if (isset($_GET['btnCerca'])){
						if ($_SERVER['REQUEST_METHOD'] == 'GET'){
							if (isset($_GET['chkStato'])) {
								if ($_GET['chkStato'] == 'nuovo'){
									$value = 1;
								} elseif ($_GET['chkStato'] == 'usato') {
									$value = 0;
								}

								if (isset($_GET['txtCerca']) && strlen($_GET['txtCerca']) > 0){
									$elemento_ricerca = $_GET['txtCerca'];
									$query = "SELECT * FROM veicolo WHERE isNuovo = $value AND marca LIKE '%$elemento_ricerca%' OR modello LIKE '%$elemento_ricerca%' AND isNuovo = $value";
								} else {
									$query = "SELECT * FROM veicolo WHERE isNuovo = $value";
								}
							} else {
								$query = 'SELECT * FROM veicolo';

								if (isset($_GET['txtCerca']) && strlen($_GET['txtCerca']) > 0){
									$elemento_ricerca = $_GET['txtCerca'];
									$query .= " WHERE marca LIKE '%$elemento_ricerca%' OR modello LIKE '%$elemento_ricerca%'";
								}
							}

							//echo $query;
							$result = $mysql->query($query);

							if ($result && $result->num_rows > 0){
								$errore = false;
								$response = '<div class="text-center"><table class="table-bordered table-secondary table-responsive"><tr><th>N°</th><th>Foto</th><th>Informazioni</th>';

								if ($_SESSION['user_type'])
									$response .= '<th>Altro</th>';

								$responde .= '</tr>';
								$counter = 0;

								while ($row = $result->fetch_assoc()){
									$counter++;
									$response .= '<tr>
										<td>
											' .$counter. '
										</td>
										<td>
											<img src="' .$row["foto"]. '" style="width:100%;max-width:300px">
										</td>
										<td>
											<ul>
												<li>
													' .$row["marca"]. ' ' .$row["modello"]. '
												</li>
												<li>
													Codice di telaio: ' .$row["numeroTelaio"]. '
												</li>
												<li>
													Data immatricolazione: ' .$row["dataImmatricolazione"]. '
												</li>
												<li>
													Colore: ' .getElementFromQuery('nome', 'colore', 'idColore', $row['idColore']).'
												</li>
												<li>
													Categoria: ' .getElementFromQuery('nomeCategoria', 'categoria', 'idCategoria', $row['idCategoria']).'
												</li>
												<li>
													Cilindrata:' .$row["cilindrata"]. ' cc
												</li>
												<li>
													Velocità massima: ' .$row["velocitaMassima"]. ' km/h
												</li>
												<li>
													Chilometri totali: ' .$row['chilometri']. ' km
												</li>
												<li>
													&Egrave in trattativa? ';

												if ($row["idTrattativa"] == null)
													$response .= 'Nessuna';
												else
													$response .= $row["idTrattativa"];

												$response .= '</li>
												<li>
													&Egrave nuova? ';

												if ($row["isNuovo"] == 0)
													$response .= 'No';
												else
													$response .= 'Sì';

												$response .= '</li><li>
													&Egrave disponibile la pronta consegna? ';

												if ($row["prontaConsegna"] == 0)
													$response .= 'No';
												else
													$response .= 'Sì';

												$response .= '</li>
												<img src="' .$row["qrCode"]. '" style="width:100%;max-width:150px">
											</ul>
										</td>';

										if ($_SESSION['user_type'] == 'cliente')
											$response .= '<td><a href="prenota.php?veicolo=' .$row["numeroTelaio"]. '">Prova su strada</a>';
										elseif ($_SESSION['user_type'] == 'agente')
											$response .= '<td><a href="modifica.php?veicolo=' .$row["numeroTelaio"]. '">Modifica</a>';

										$response .= '</tr>';
								}
								$response .= '</table></div>';
								
								echo $response;
							} else {
								$errore = true;
							}
						}
					}

					if (!$errore && isset($_GET['btnCerca'])){
						if ($_SESSION['user_type'])
							echo '<div class="text-center">Sessione ' .$_SESSION['user_type']. '</div>';
						else
							echo '<div class="text-center">Sessione ospite</div>';
					} elseif (isset($_GET['btnCerca'])){
						echo '<div class="text-center"><h2 class="mb-4">Non è stato trovato nessun veicolo "' .$elemento_ricerca. '"</h2></div>';
					}

					function getElementFromQuery($column, $table, $condition, $element){
						include('config.php');

						$query = 'SELECT ' .$column. ' FROM ' .$table. ' WHERE ' .$condition. ' = ' .$element;
						$result = $mysql->query($query);

						if (!$result){
							return '';
						}

						if ($result->num_rows > 0){
							$response = '';
							while ($row = $result->fetch_assoc()){
								$response .= $row[$column];
							}
							return $response;
						} else
							return '';
					}
				?>
			</div>
		</section>
		<section class="signup-section" id="signup">
			<div class="container col-md-6 col-lg-4">
				<h1 class="text-center text-white mb-4">Sezione utente</h1>
			</div>
			<div class="container">
				<?php
					// Login e Sign up form
					if (!$_SESSION["loggedIn"]){
				?>
				<div class="row">
					<div class="col-md-6 col-lg-4 mx-auto text-center">
						<i class="fas fa-sign-in-alt fa-2x mb-2 text-white"></i>
						<h2 class="text-white mb-5">Accedi</h2>
						<form method="POST" class="form-inline d-flex">
							<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3 text-capitalize" type="email" name="txtId" placeholder="Email..." required/>
							<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3 text-capitalize" type="password" name="txtPassword" id="txtPassword" placeholder="Password..." required/>
							<a onclick="showPassword()">
								<!--<i class="fas fa-key fa-2x mb-2 text-secondary" title="Mostra/Nascondi password"></i>-->
								<i class="fas fa-low-vision flex-fill fa-2x mb-2 text-secondary" title="Mostra/Nascondi password"></i>
							</a>
							<button name="btnLogin" class="btn btn-secondary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3" type="submit">Login</button>
						</form>
						<script type="text/javascript">
							function showPassword() {
								var x = document.getElementById("txtPassword");
								if (x.type === "password") {
									x.type = "text";
								} else {
									x.type = "password";
								}
							}
						</script>
					</div>
					<div class="col-md-6 col-lg-4 mx-auto text-center">
						<i class="fas fa-user-plus fa-2x mb-2 text-white"></i>
						<h2 class="text-white mb-5">Registrati</h2>
						<button class="btn btn-primary mx-auto mr-0 mr-sm-0 mb-3 mb-sm-3" onclick="location.href='signup.php';">Sign Up</button>
					</div>
				</div>
				<?php
					} else {
				?>
				<div class="row">
					<?php
						if ($_SESSION['user_type'] == 'agente'){
					?>
					<div class="col-md-12 col-lg-4 mx-auto text-center">
						<a href="modifica_prenotazioni.php">
							<i class="fas fa-road fa-2x mb-2 text-white"></i>
							<h2 class="text-white mb-5">Visualizza prove su strada programmate</h2>
						</a>
					</div>
					<?php
						}
					?>
					<div class="col-md-12 col-lg-4 mx-auto text-center">
						<a href="logout.php">
							<i class="fas fa-sign-out-alt fa-2x mb-2 text-white"></i>
							<h2 class="text-white mb-5">Esci</h2>
						</a>
					</div>
				</div>
				<?php
					}
					if (isset($_POST['btnLogin'])){
						$id = $_POST['txtId'];
						$password = $_POST['txtPassword'];

						$query = "SELECT * FROM cliente WHERE email LIKE '" .$id. "' AND password LIKE '" .$password. "'";
						$result = $mysql->query($query);

						if ($result->num_rows == 1){
							$_SESSION['loggedIn'] = true;
							$_SESSION['login_user'] = $id;
							$_SESSION['user_type'] = 'cliente';

							$row = $result->fetch_assoc();
							$_SESSION['login_user_id'] = $row['idCliente'];

							echo '<script>window.location.replace("index.php")</script>';
						} else {
							$query = "SELECT * FROM agente WHERE email LIKE '" .$id. "' AND password LIKE '" .$password. "'";
							$result = $mysql->query($query);

							if ($result->num_rows == 1){
								$_SESSION['loggedIn'] = true;
								$_SESSION['login_user'] = $id;
								$_SESSION['user_type'] = 'agente';

								$row = $result->fetch_assoc();
								$_SESSION['login_user_id'] = $row['idAgente'];

								echo '<script>window.location.replace("index.php")</script>';
							} else {
								$_SESSION['loggedIn'] = false;
								echo '<script>alert("Errore, mail o password errati")</script>';
								echo '<script>window.location.replace("index.php#signup")</script>';
							}
						}
					}
				?>
			</div>
		</section>
		<section class="contact-section bg-black" id="contacts">
			<h1 class="text-center text-white mb-4">Contatti</h1>
			<div class="container">
				<div class="row">
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="card py-4 h-100">
							<div class="card-body text-center">
								<i class="fas fa-map-marked-alt text-primary mb-2"></i>
								<h4 class="text-uppercase m-0">Indirizzo</h4>
								<hr class="my-4" />
								<div class="small text-black-50">
									<a href="https://www.google.com/maps/place/ISIT+Innocent+Manzetti/@45.7353125,7.3200405,19z/data=!4m13!1m7!3m6!1s0x478920ba8a4794ef:0x5824f953ba378844!2sVia+B.+Festaz,+27,+11100+Aosta+AO!3b1!8m2!3d45.735335!4d7.3206507!3m4!1s0x478920ba7142b477:0xd13a98bfbea8aaed!8m2!3d45.7353154!4d7.3201852" target="_blank">
										ISIT - I. Manzetti<br>
										Via Festaz 27/a Aosta (AO) Italia
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="card py-4 h-100">
							<div class="card-body text-center">
								<i class="fas fa-envelope text-primary mb-2"></i>
								<h4 class="text-uppercase m-0">Email</h4>
								<hr class="my-4" />
								<div class="small text-black-50"><a href="mailto:armyromy25@gmail.com" target="_blank">armyromy25@gmail.com</a></div>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="card py-4 h-100">
							<div class="card-body text-center">
								<i class="fab fa-github text-primary mb-2"></i>
								<h4 class="text-uppercase m-0">GitHub</h4>
								<hr class="my-4" />
								<div class="small text-black-50"><a href="https://github.com/deatharmy25/elaborato_esame.git" target="_blank">Progetto GitHub</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer class="footer bg-black small text-center text-white-50">
			<div class="container">Romeo Armando 5BIT</div>
			<div class="container">New Car - Concessionaria FCI - Copyright © 2021</div>
		</footer>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
