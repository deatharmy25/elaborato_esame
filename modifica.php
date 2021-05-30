<?php
    include("config.php");
    /*
    if (!isset($_SESSION)){
        header("location:index.php");
    }
    */
    session_start();

    $veicolo;

    if (isset($_GET['veicolo'])){
        $id_veicolo = $_GET['veicolo'];

        $query = 'SELECT * FROM veicolo WHERE numeroTelaio = ' .$id_veicolo;
        $result = $mysql->query($query);

        if (!$result){
            print_error("Database error 2");
            http_response_code(502);
            return;
        }

        $veicolo = $result->fetch_assoc();
    } else
    	header("Location: index.php#signup");
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
        <title>New Car - Modifica auto</title>
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
                <h1 class="mx-auto my-0 text-white text-center text-uppercase">Modifica auto</h1>
            </div>
            <br>
            <br>
            <div class="container col-md-6 col-lg-4">
                <?php
                    $response = '<form class="text-white" method="POST">
                        <div class="container text-left">
                            <label for="txtMarca">Marca</label>
                            <input type="text" name="txtMarca" value="' .$veicolo['marca']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtModello">Modello</label>
                            <input type="text" name="txtModello" value="' .$veicolo['modello']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtData">Data Immatricolazione</label>
                            <input type="date" name="txtData" value="' .$veicolo['dataImmatricolazione']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtColore">ID Colore</label>
                            <input type="number" name="txtColore" value="' .$veicolo['idColore']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtCategoria">ID Categoria</label>
                            <input type="number" name="txtCategoria" value="' .$veicolo['idCategoria']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtCilindrata">Cilindrata</label>
                            <input type="number" name="txtCilindrata" value="' .$veicolo['cilindrata']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtCilindrata">Velocità massima</label>
                            <input type="number" name="txtVelocitaMassima" value="' .$veicolo['velocitaMassima']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtChilometri">Numero di chilometri</label>
                            <input type="number" name="txtChilometri" value="' .$veicolo['chilometri']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="chkIsNuova">È Nuova?</label>';

                    if ($veicolo['isNuovo'] == 1)
                        $response .= '<input type="checkbox" name="chkIsNuova" checked="yes" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3"><br>';
                    else
                        $response .= '<input type="checkbox" name="chkIsNuova" checked="no" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3"><br>';

                    $response .= '<label for="chkProntaConsegna">È disponibile in pronta consegna?</label>';

                    if ($veicolo['isNuovo'] == 1)
                        $response .='<input type="checkbox" name="chkProntaConsegna" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">';
                    else
                        $response .='<input type="checkbox" name="chkProntaConsegna" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">';

                    $response .= '<br><label for="txtFoto">URL foto</label>
                            <input type="url" name="txtFoto" value="' .$veicolo['foto']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>

                            <label for="txtQrCode">URL QR Code</label>
                            <input type="url" name="txtQrCode" value="' .$veicolo['qrCode']. '" class="flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                            <br>
                        </div>
                        <div class="container text-center">
                            <button type="button" onclick="location.href=\'index.php#showroom\';" class="btn btn-secondary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Annulla</button>
                            <button type="submit" name="btnSubmit" class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Modifica</button>
                        </div>
                    </form>';

                    echo $response;

                    if (isset($_POST['btnSubmit'])){
                        $marca = $_POST['txtMarca'];
                        $modello = $_POST['txtModello'];
                        $data = $_POST['txtData'];
                        $idColore = $_POST['txtColore'];
                        $idCategoria = $_POST['txtCategoria'];
                        $cilindrata = $_POST['txtCilindrata'];
                        $velocitaMassima = $_POST['txtVelocitaMassima'];
                        $chilometri = $_POST['txtChilometri'];
                        $isNuovo = $_POST['chkIsNuova'];
                        $isProntaConsegna = $_POST['chkProntaConsegna'];
                        $foto = $_POST['txtFoto'];
                        $qrCode = $_POST['txtQrCode'];

                        $query = "UPDATE veicolo
                        SET marca='" .$marca. "', modello='".$modello."', dataImmatricolazione='".$data."', idColore='".$idColore."', idCategoria='".$idCategoria."', cilindrata='".$cilindrata."', velocitaMassima='".$velocitaMassima."', chilometri='".$chilometri."', isNuovo='".$isNuovo."', prontaConsegna='".$isProntaConsegna."', foto='".$foto."', qrCode='".$qrCode."'
                        WHERE numeroTelaio = " .$veicolo['numeroTelaio'];

                        $result = $mysql->query($query);

                        if ($result)
                            echo '<script>alert("Modifica effettuata con successo!)</script>';
                        else{
                        	$response = 'Si è verificato un errore durante la modifica del veicolo, riprovare più tardi\n' .$query;
                            echo '<script>alert("' .$response. '")</script>';
                        }
                        echo '<script>window.location.replace("index.php#showroom")</script>';
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