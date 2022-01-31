<?php
    include_once ('session_Manager.php');
    include_once ('gestione_accessi.php');
    include_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //$username = createSession();
    $session = new SessionManager ();
    $user = $session->init();
    $gestione_accessi = new  gestione_accessi();
    $page = new Page();

    if(!empty($_POST)){
        $gestione_accessi->inserimentoNuovoUtente($_POST,$user);
        if($gestione_accessi){
            $_SESSION['successMsg'] = 'Registrazione avvenuta con successo';
            header('Location: pagina_avvisi.php');
        }
        else{
            //TROVARE MODO DIRE UTENTE REGISTRAZIONE FALLITA
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Registrazione Utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Registrazione Utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">
        <?php require_once ('header.php')?>
        <div id="content">
        <?php include_once("../html/form-registrazione.html")?>
        </div>
        <?php require_once ('../html/footer.html')?>
        <div class="globalDiv">
    </body>
</html>