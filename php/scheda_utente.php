<?php
    require_once 'session_Manager.php';
    require_once 'page.php';
    
    $username = createSession();
    $page = new page();
    
    
    if (!empty($_POST)){
        $user = login($_POST['email'], $_POST['psw']);
        $page->setErrors(!$user->isReg());
        if (!$page->hasErrors()){
            header("Location: scheda_utente.php");
            exit();
        }
        else {
            $_SESSION['errorMSG'] = "Devi prima effettuare l\'accesso per visualizzare questa pagina";
            header("Location: pagina_avvisi.php");
            exit();
        }
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
                <a href="logout.php">CLICCA QUI PER USCIRE</a>
            </div>
            <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>
