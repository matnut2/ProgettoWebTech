<?php 
    require_once ('session_Manager.php');
    require_once('page.php');
    require_once('veicolo.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user = createSession();

    if($_SESSION["isAdmin"] != 1){
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Modifica Veicolo - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Pagina di Modifica dei Veicoli di Auto Asta"/>
        <meta name="keywords" content="auto, asta, edit, modifica, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>
        <div id='content'>
        <?php require_once ('editSingleVeicolo_page.php')?>
        </div>

        </div>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>