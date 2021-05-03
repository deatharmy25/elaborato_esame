<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8" />
		<title>New Car - Sign up</title>
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
				<a class="navbar-brand js-scroll-trigger" href="index.php#page-top">
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
                </div>
            </div>
        </nav>
        <section class="signup-section" id="signup">
            <form  class="text-white text-center" method="POST">
                <div>
                    <i class="fas fa-user-plus fa-2x mb-2 text-white"></i>
                    <h1 class="text-white mb-5">Registrazione cliente</h1>
                </div>

                <div class="account-details">
                    <div>
                        <input type="text" name="txtNome" placeholder="Nome..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                        <input type="text" name="txtCognome" placeholder="Cognome..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                    </div>
                    <div>
                        <input type="password" name="txtPassword" placeholder="Password..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                        <input type="password" name="txtPasswordRepeat" placeholder="Ripeti password..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                    </div>
                </div>
                <fieldset>
                    <div class="personal-details">
                        <div>
                            <input type="text" name="txtStato" placeholder="Stato..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                            <input type="text" name="txtCitta" placeholder="Città..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                            <input type="text" name="txtIndirizzo" placeholder="Indirizzo..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                        </div>
                        <div>
                            <input type="text" name="txtCodiceFiscale" placeholder="Codice fiscale..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" maxlength="16" required>
                        </div>
                        <div>
                            <div>
                                <label for="chkSposato">Sposato</label>
                                <input type="checkbox" name="chkSposato"><br>
                                <label for="chkFigli">Figli</label>
                                <input type="checkbox" name="chkFigli"><br>
                                <label for="chkNewsLetter">Vuoi iscriverti alla News Letter?</label>
                                <input type="checkbox" name="chkNewsLetter"><br>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="button" onclick="location.href='index.php#signup';" class="btn btn-secondary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Annulla</button>
                <button type="submit" name="btnSubmit" class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Sign up</button>
            </form>
            <?php
                if (isset($_POST['btnSubmit'])){
                    if ($_POST['txtPassword'] != $_POST['txtPasswordRepeat']){
                        echo '<script>alert("Attenzione, password non corrispondenti")</script>';
                        return;
                    }

                    $nome = $_POST['txtNome'];
                    $cognome = $_POST['txtCognome'];
                    $password = $_POST['txtPassword'];
                    $stato = $_POST['txtStato'];
                    $citta = $_POST['txtCitta'];
                    $indirizzo = $_POST['txtIndirizzo'];
                    $codiceFiscale = strtoupper($_POST['txtCodiceFiscale']);

                    if (strlen($codiceFiscale) != 16){
                        echo '<script>alert("Attenzione, il codice fiscale è incorretto")</script>';
                        return;   
                    }
                    
                    $indirizzoResidenza = $indirizzo .' - ' .$citta. '(' .$stato. ')';

                    $componentiFamiglia = '';
                    if (isset($_POST['chkSposato']))
                        $componentiFamiglia .= 'Sposato';
                    if (isset($_POST['chkFigli']))
                        $componentiFamiglia .= ' con figli.';

                    if (isset($_POST['chkNewsLetter']))
                        $newsLetter = 1;
                    else
                        $newsLetter = 0;

                    $mysql = new mysqli('localhost', 'root', '', 'esame');
                    if (!$mysql){  
                        print_error("Database error");
                        http_response_code(501);
                        return;
                    }

                    $query = "INSERT INTO cliente (nome, cognome, codiceFiscale, indirizzoResidenza, componentiFamiglia, newsLetter, password)
                    VALUES ('$nome', '$cognome', '$codiceFiscale', '$indirizzoResidenza', '$componentiFamiglia', $newsLetter, '$password')";
                    $result = $mysql->query($query);

                    if ($result){
                        echo '<script>alert("Registrazione completata\nUsa ' .getIdByCodiceFiscale($codiceFiscale). ' come ID per accedere ai nostri servizi")</script>';
                        echo '<script>window.location.replace("index.php#signup")</script>';
                    } else {
                        //echo $query;
                        echo '<script>alert("Errore utente già registrato")</script>';
                        http_response_code(502);
                    }
                }

                function getIdByCodiceFiscale($codiceFiscale){
                    $mysql = new mysqli('localhost', 'root', '', 'esame');
                    $query = "SELECT idCliente FROM cliente WHERE codiceFiscale LIKE '$codiceFiscale'";
                    $result = $mysql->query($query);

                    if ($result->num_rows == 1){
                        if ($row = $result->fetch_assoc())
                            return $row['idCliente'];
                    }
                }
            ?>
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