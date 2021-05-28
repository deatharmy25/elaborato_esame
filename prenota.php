<?php
	include('config.php');
	/*
	if (!isset($_SESSION)){
		header("location:index.php");
	}
	*/
	session_start();
?>
<html lang="it">
	<head>
		<meta charset="utf-8" />
		<title>New Car - Prenota prova su strada</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Elaborato d'esame di maturità 2021">
		<meta name="author" content="Armando Romeo">
		<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
		<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body id="page-top" style="background-color:black;">
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
							<a class="nav-link js-scroll-trigger" href="index.php#about">Informazioni sulla Concessionaria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="index.php#showroom">Concessionaria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="index.php#signup">Sezione utente</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="index.php#contacts">Contatti</a>
						</li>
					</ul>
					<hr>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="index.php#signup">
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
		<section class="signup-section" id="book">
			<div class="container col-md-6 col-lg-4">
				<h1 class="mx-auto my-0 text-white text-center text-uppercase">Prenotazione prova su strada</h1>
			</div>
			<br>
			<br>
			<div class="container col-md-6 col-lg-4">
				<?php
					if (isset($_GET['veicolo'])){
						$id_veicolo = $_GET['veicolo'];

						$query = 'SELECT * FROM veicolo WHERE numeroTelaio = ' .$id_veicolo;
						$result = $mysql->query($query);

						if (!$result){
							print_error("Database error 2");
							http_response_code(502);
							return;
						}

						if ($row = $result->fetch_assoc()){
							echo '<h2 class="text-white text-center mb-sm-5">
								Prenotazione ' .$row['marca']. ' ' .$row['modello']. '
							</h2>';
						}
					} else {
						echo '<h2 class="text-white text-center mb-sm-5">
							Prenotazione di un auto dalla concessionaria
						</h2>';

					}
				?>
				<form class="text-white text-center" method="POST">
					<input type="datetime-local" name="txtData" class="form-control flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3" required>
					<button type="submit" name="btnSubmit" class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Prenota!</button>
				</form>

				<?php
					if (isset($_POST['btnSubmit'])){
						$idCliente = $login_session_id;

						do{
							$idAgente = getAgenteRandom();
						}while (!$idAgente > 0);

						$datatmp = $_POST['txtData'];

						$query = 'INSERT INTO operazione (idCliente, idAgente, data, tipo)
						VALUES ("' .$idCliente. '", "' .$idAgente. '", "' .$datatmp. '", "prenotazione")';

						$result = $mysql->query($query);

						$query = 'SELECT idOperazione FROM operazione WHERE idCliente = ' .$idCliente. ' AND idAgente = ' .$idAgente. ' AND data = "' .$datatmp. '" AND tipo LIKE "prenotazione"';
						$result = $mysql->query($query);

						if (!$result){
							echo 'Errore 1';
							return;
						}

						$row = $result->fetch_assoc();
						$idOperazione = $row['idOperazione'];
						$idVeicolo = $_GET["veicolo"];

						$query = 'UPDATE veicolo SET idOperazione = ' .$idOperazione. ' WHERE numeroTelaio = '.$idVeicolo;
						$result = $mysql->query($query);
						if (!$result){
							echo 'Errore 2';
							return;
						}
						else {
							echo '<script>alert("Prenotazione effettuata\nL\'agente di riferimento sarà ' .getEmailAgente($idAgente). '\nTi verrà inviata una mail con ulteriori informazioni")</script>';
						}

						header("Location: index.php#showroom");
					}

					function getEmailAgente($id){
						include('config.php');

						$query = 'SELECT * FROM agente WHERE idAgente = $id';
						$result = $mysql->query($query);

						if ($result && $row = $result->fetch_assoc()){
							return $row['email'];
						}
					}

					function getAgenteRandom(){
						include('config.php');

						$query = 'SELECT * FROM agente';
						$result = $mysql->query($query);

						if ($result->num_rows > 0){
							$agenti = [];

							while($row = $result->fetch_assoc()){
								array_push($agenti, $row['idAgente']);
							}

							$index = rand(0, count($agenti));
							return $agenti[$index];
						}
					}
				?>
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