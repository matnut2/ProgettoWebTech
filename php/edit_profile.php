<?php
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $gestione_Update = new  page();
    $session = createSession();

    if(!empty($_POST)){
        $user = getLoggedUser($_SESSION['email']);
        if(!empty($_POST)){
            $checkUpdate = $gestione_Update->updateUserInfo($_POST,$user);
            if($checkUpdate){
               //UPDATE AVVENUTO CON SUCCESSO
               /*header("Location: scheda_utente.php");
               exit();*/
            }else echo("ERRORE NELLA QUERY");
        }
    }

?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Aggiorna informazioni Utente - Auto Asta</title>
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
                <form action="../php/edit_profile.php" method="post">
                    <div class="registration_form">
                    <h2>FORM MODIFICA DATI UTENTE </h2>
                    <p>Compila solamente i campi dati che vuoi modificare </p>
                    <hr>
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Inserisci la tua  password" name="psw" id="psw" >  
                    <label for="psw-repeat"><b>Ripeti Password</b></label>
                    <input type="password" placeholder="Ripeti la password scelta" name="password-repeat" id="password-repeat" >
            
                    <label for="name"><b>Username</b></label>
                    <input type="text" placeholder="Inserisci il tuo username" name="username" id="username">

                    <label for="birthday"><b>Data nascita</b></label>
                    <input type="date" name="data_nascita" id="data_nascita" >

                    <label for="profile_image"><b>Carica foto profilo</b></label>
                    <input type="file" name="url_immagine" id="url_immagine" accept=".jpg,.png,.jpeg">

                    <button type="submit" class="register_btn">AGGIORNA DATI</button>
                    </div>
                </form>
            </div>
            <?php require_once ('../html/footer.html')?>
      </div>
    </body>
</html>