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
                    <i class="fas fa-home"></i>
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
                    <input type="text" name="txtNome" placeholder="Nome..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                    <input type="text" name="txtCognome" placeholder="Cognome..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/><br>
                    <input type="password" name="txtPassword" placeholder="Password..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/>
                    <input type="password" name="txtPasswordRepeat" placeholder="Ripeti password..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required/><br>
                </div>
                <fieldset>
                    <div class="personal-details">
                        <div>
                            <input type="text" name="txtStato" placeholder="Stato..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                            <input type="text" name="txtCitta" placeholder="Città..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                            <input type="text" name="txtResidenza" placeholder="Indirizzo..." class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                        </div>
                        <div>
                            <div>
                                <label>Gender*</label>
                                <div class="gender">
                                    <input type="radio" value="m" id="male" name="gender" required/>
                                    <label for="male" class="radio">Maschio</label>
                                    <input type="radio" value="f" id="female" name="gender" required/>
                                    <label for="female" class="radio">Femmina</label>
                                    <input type="radio" value="o" id="other" name="gender" required/>
                                    <label for="other" class="radio">Altro</label>
                                </div>
                            </div>
                            <div class="birthdate">
                                <label>Data di nascita*</label>
                                <div class="bdate-block">
                                    <select class="giorno" required>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select class="mese" required>
                                        <option value="Gennaio">Gennaio</option>
                                        <option value="Febbraio">Febbraio</option>
                                        <option value="Marzo">Marzo</option>
                                        <option value="Aprile">Aprile</option>
                                        <option value="Maggio">Maggio</option>
                                        <option value="Giugno">Giugno</option>
                                        <option value="Luglio">Luglio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Settembre">Settembre</option>
                                        <option value="Ottobre">Ottobre</option>
                                        <option value="Novembre">Novembre</option>
                                        <option value="Dicembre">Dicembre</option>
                                    </select>
                                    <input type="number" name="txtAnno" placeholder="Anno..." value="2021" class="flex-fill mr-0 mr-sm-2 mb-3 mb-sm-3" required>
                                </div>
                            </div>
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
                <button type="button" name="btnSubmit" class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Sign up</button>
            </form>
            <?php
                if (isset($_POST['txtSubmit'])){
                    $nome = $_POST[''];
                    $cognome = $_POST[''];
                    $password = $_POST[''];
                    $passwordRepeat = $_POST[''];
                    $stato = $_POST[''];
                    $citta = $_POST[''];
                    $indirizzo = $_POST[''];
                    $sesso = $_POST[''];
                    $giorno = $_POST[''];
                    $mese = $_POST[''];
                    $anno = $_POST[''];

                    if (isset($_POST['chkSposato']))
                        $sposato = true;
                    else
                        $sposato = false;

                    if (isset($_POST['chkSposato']))
                        $figli = true;
                    else
                        $figli = FALSE;

                    if (isset($_POST['chkSposato']))
                        $newsLetter = true;
                    else
                        $newsLetter = true;

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