<?php
    include("config.php");
    /*
    if (!isset($_SESSION)){
        header("location:index.php");
    }
    */
    session_start();

    $veicoli = [];

    $query = 'SELECT * FROM veicolo';
    $result = $mysql->query($query);

    if ($result){
        while ($row = $result->fetch_assoc()){
            array_push($veicoli, $row);
        }
    }
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
                <h1 class="mx-auto my-0 text-white text-center text-uppercase">Modifica prenotazioni prove su strada</h1>
            </div>
            <br>
            <br>
            <div class="container col-md-12 col-lg-4">
                <?php
                    if (!count($veicoli) > 0){
                ?>
                    <div class="container text-white text-center">
                        <h2>
                            Non ci sono prenotazioni disponibili
                        </h2>
                    </div>
                <?php
                        return;
                    }

                    $response = '<div class="container text-left"><table class="table-bordered table-secondary table-responsive mb-sm-5"><tr><th>Veicolo</th><th>Cliente</th><th>Data</th><th>Azioni</th></tr>';

                    for ($i = 0; $i < count($veicoli); $i++){
                        if ($veicoli[$i]['idOperazione'] != null){
                            $operazione = getOperazione($veicoli[$i]['idOperazione']);
                            $cliente = getCliente($operazione['idCliente']);

                            if (strpos($operazione['data'], 'T')){
                                $dataTmp = $operazione['data'];
                            } else {
                                $dataTmp = str_replace(' ', 'T', $operazione['data']);
                            }

                            $response .= '<tr>
                                <td>
                                    '.$veicoli[$i]['marca'].' '.$veicoli[$i]['modello'].' (N° telaio: ' .$veicoli[$i]['numeroTelaio']. ')
                                </td>
                                <td>
                                    '.$cliente['nome'].' '.$cliente['cognome'].'
                                </td>
                                <form method="post">
                                    <td>
                                        <input type="datetime-local" name="txtData" value="'.$dataTmp.'" class="form-control flex-fill mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                                    </td>
                                    <td>
                                        <button type="submit" name="btnEdit" value="' .$i. '" class="btn btn-secondary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Modifica</button>
                                        <button type="submit" name="btnDelete" value="' .$i. '" class="btn btn-danger mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Elimina</button>
                                    </td>
                                </form>
                            </tr>';
                        }
                    }

                    $response .= '</table>
                        </div>
                        <div class="container text-center">
                            <button type="button" onclick="location.href=\'index.php#signup\';" class="btn btn-success mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">
                                Torna alla home
                            </button>
                            <!-- <button type="submit" name="btnSubmit" class="btn btn-primary mx-auto mr-0 mr-sm-2 mb-3 mb-sm-3">Modifica</button> -->
                        </div>';

                    echo $response;

                    if (isset($_POST['btnDelete'])){
                        $idOperazione = $veicoli[$_POST['btnDelete']]['idOperazione'];

                        $query = 'DELETE FROM operazione WHERE idOperazione = ' .$idOperazione;
                        $result = $mysql->query($query);
                        if ($result) {
                            $response = 'Si è verificato un errore durante la modifica del veicolo, riprovare più tardi\n' .$query;
                            echo '<script>alert("' .$response. '")</script>';
                            return;
                        }

                        $query = 'UPDATE veicolo SET idOperazione=NULL WHERE numeroTelaio = ' .$veicoli[$_POST['btnDelete']]['numeroTelaio'];
                        $result = $mysql->query($query);
                        if ($result)
                            echo '<script>alert("Modifica effettuata con successo!)</script>';
                        else{
                            $response = 'Si è verificato un errore durante la modifica del veicolo, riprovare più tardi\n' .$query;
                            echo '<script>alert("' .$response. '")</script>';
                        }
                        echo '<script>window.location.replace("modifica_prenotazioni.php")</script>';
                    } elseif (isset($_POST['btnEdit'])){
                        $idOperazione = $_POST['btnEdit'];
                        $data = $_POST['txtData'];

                        $query = 'UPDATE operazione SET data="' .$data. '" WHERE idOperazione = ' .$idOperazione;
                        $result = $mysql->query($query);

                        if ($result)
                            echo '<script>alert("Modifica effettuata con successo!)</script>';
                        else{
                        	$response = 'Si è verificato un errore durante la modifica del veicolo, riprovare più tardi\n' .$query;
                            echo '<script>alert("' .$response. '")</script>';
                        }
                        echo '<script>window.location.replace("modifica_prenotazioni.php")</script>';
                    }

                    function getOperazione($id){
						include('config.php');
							
                        $query = 'SELECT * FROM operazione WHERE idOperazione = ' .$id. ' ORDER BY data';
                        $result = $mysql->query($query);

                        if ($result){
                            return $result->fetch_assoc();
                        }

                        return null;
                    }

                    function getCliente($id){
						include('config.php');
                        $query = 'SELECT * FROM cliente WHERE idCliente = ' .$id;
                        $result = $mysql->query($query);

                        if ($result){
                            return $result->fetch_assoc();
                        }

                        return null;
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