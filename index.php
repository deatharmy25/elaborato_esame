<html lang="it">
	<head>
		<meta charset="utf-8" />
		<title>New Car</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
		<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
		<link href="css/styles.css" rel="stylesheet" />
	</head>
	<body id="page-top">
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top">
					<img src="assets/img/favicon.ico" alt="New Car Icon">
					New Car
					<!-- <i class="fas fa-home"></i> -->
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
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="index.php#signup">
	                            Login
	                            <i class="fas fa-sign-in-alt"></i>
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
					<h2 class="text-white-50 mx-auto mt-2 mb-5">		Concessionaria FCI<br>Elaborato d'esame, maturità 2021
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
							New Car è une delle sedi concessionarie del gruppo FCI! Qui puoi trovare un ampia scelta di veicoli sia nuovi che usati.
						</p>
					</div>
				</div>
			</div>
		</section>
		<section class="projects-section bg-light" id="showroom">
			<div class="container">
				<h1 class="text-center">Showroom</h1>
				<div class="row justify-content-center no-gutters mb-5 mb-lg-0">
					<form class="form-inline d-flex" method="GET">
						<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" type="text" name="txtCerca" placeholder="Marca e/o modello da cercare..."/>
						<button class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-10" name="btnCerca" type="submit">Cerca</button>
					</form>
					<!--
					<?php
						/*
						if (isset($_GET['btnCerca'])){include('session.php');
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

								if (isset($_GET['txtCerca'])) {
									$elemento_ricerca = $_GET['txtCerca'];
									$query = "SELECT * FROM veicolo WHERE marca LIKE '%$elemento_ricerca%' OR modello LIKE '%$elemento_ricerca%'";
								} else
									$query = "SELECT * FROM veicolo";

								$result = $mysql->query($query);

								if (!$result){
									print_error("Database error 2");
									http_response_code(502);
									return;
								}

								if ($result->num_rows > 0){
									$response = '<div class="col-md-12 col-lg-4 mx-auto text-center"><table><tr><td>N°</td><td>Marca</td><td>
									Modello</td><td>Numero di telaio</td><td>Data immatricolazione</td><td>Cilindrata</td><td>Velocità massima
									</td><td>Categoria</td><td>Colore</td><td>Foto</td><td>QR Code</td><td>Trattativa in corso</td><td>È nuova?
									</td><td>È disponibile la pronta consenga?</td></tr>';

									$counter = 0;

									while ($row = $result->fetch_assoc()){
										$counter++;
										$response .= '<tr>
											<td>
												' .$counter. '
											</td>
											<td>
												' .$row["marca"]. '
											</td>
											<td>
												' .$row["modello"]. '
											</td>
											<td>
												' .$row["numeroTelaio"]. '
											</td>
											<td>
												' .$row["dataImmatricolazione"]. '
											</td>
											<td>
												' .$row["cilindrata"]. '
											</td>
											<td>
												' .$row["velocitaMassima"]. '
											</td>
											<td>
												' .$row["idCategoria"]. '
											</td>
											<td>
												' .$row["idColore"]. '
											</td>
											<td>
												' .$row["foto"]. '
											</td>
											<td>
												' .$row["qrCode"]. '
											</td>
											<td>
												' .$row["idTrattativa"]. '
											</td>
											<td>
												' .$row["isNuova"]. '
											</td>
											<td>
												' .$row["isProntaConsegna"]. '
											</td>
											</tr>';
									}
									
									$response .= '</table></div>',

									echo $response;
								} else { 
									print_error("Database error 3");
									http_response_code(503);
									return;
								}      
							}
						}
						*/
					?>
					-->
				</div>
			</div>
		</section>
		<section class="signup-section" id="signup">
			<div class="container col-md-6 col-lg-4">
				<h1 class="text-center text-white mb-4">Sezione utente</h1>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-4 mx-auto text-center">
						<i class="fas fa-sign-in-alt fa-2x mb-2 text-white"></i>
						<h2 class="text-white mb-5">Accedi</h2>
						<form class="form-inline d-flex">
							<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" type="text" name="txtId" placeholder="ID..."/>
							<input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" type="password" name="txtPassword" placeholder="Password..."/>
							<button class="btn btn-secondary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3" type="submit">Login</button>
						</form>
					</div>
					<div class="col-md-6 col-lg-4 mx-auto text-center">
						<i class="fas fa-user-plus fa-2x mb-2 text-white"></i>
						<h2 class="text-white mb-5">Registrati</h2>
						<button class="btn btn-primary mx-auto mr-0 mr-sm-0 mb-3 mb-sm-3" onclick="location.href='signup.php';">Sign Up</button>
					</div>
				</div>
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
								<div class="small text-black-50"><a href="mailto:armyromy25@gmail.com">armyromy25@gmail.com</a></div>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="card py-4 h-100">
							<div class="card-body text-center">
								<i class="fab fa-github text-primary mb-2"></i>
								<h4 class="text-uppercase m-0">GitHub</h4>
								<hr class="my-4" />
								<div class="small text-black-50"><a href="https://github.com/deatharmy25/elaborato_esame.git" target="_blank">Prpgetto GitHub</a></div>
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
