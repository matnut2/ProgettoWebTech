<?php
    require_once 'session_Manager.php';
    require_once 'database_Manager.php';
    require_once 'page.php';
    
    $username = createSession();
    $page = new page();

    $id_Evento = $_GET['ID'];     

    if($_SESSION['email']!=-1){
        if($username->buyTicket($_SESSION['email'],$id_Evento)){
            echo("ACQUISTO AVVENUTO CON SUCCESSO");
        }
    }
    else{
        echo("DEVI ESSERE LOGGATO PER EFFETTUARE L'ACQUISTO");
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Scheda utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Scheda utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, utente, scheda, profilo, personale, area riservata"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
    </head>
    <body>
        <div class="globalDiv">     
            <?php require_once ('header.php')?>
            <div id="content" tabindex="8">

                </div>
            <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>