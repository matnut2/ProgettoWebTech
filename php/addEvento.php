<?php
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user = createSession();

    if($_SESSION["isAdmin"] != 1){
        $_SESSION['errorMsg'] = "Devi essere un amministratore per accedere alla funzionalit&agrave; di aggiunta veicolo";
        header('Location: ../php/pagina_avvisi.php');
        exit;
    }

    if(!empty($_POST)){
        $checkIns = $user->addEvento($_POST['id_Evento'],$_POST['capienza'],$_POST['dataEvento'],$_POST['indirizzo'],$_POST['nome'],$_POST['descrizione'],$_POST['prezzo'],$_POST['url_immagine']);
        //if($checkIns == 0){
            $_SESSION['successMsg'] = "Evento aggiunto con successo";
        //}
        //$_SESSION['errorMsg'] = "Impossibile aggiungere l'evento";
        header('Location: ../php/pagina_avvisi.php');
        exit;
        
    }
    
?>
<!DOCTYPE html>
 <html lang="it">
     <head>
         <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
         <title>Login Utente - Auto Asta</title>
         <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
         <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
         <meta charset="UTF-8"/>
         <meta name="description" content="Login Utente di Auto Asta"/>
         <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
         <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>  
         <script src="../JS/script.js"></script>     
     </head>
     <body>
         <div class="globalDiv">
         <?php require_once ('header.php')?>
         <div id="content">
         <form action="../php/addEvento.php" method="post" id="formAddEvento">
             <div class="registration_form">
             <h2>Inserimento Evento</h2>
             <p>Compila i campi seguenti per inserire un nuovo evento</p>
             <hr>
             
             <fieldset name="id" form="formAddEvento">
                 <label for="id"><b>id_Evento</b></label>
                 <input type="number" placeholder="Inserisci l'id_Evento" name="id" id="id">
             </fieldset>

             <fieldset name="nome" form="formAddEvento">
                 <label for="nome"><b>Nome</b></label>
                 <input type="text" placeholder="Inserisci il nome" name="nome" id="nome">
             </fieldset>
            
             <fieldset name="capienza" form="formAddEvento">
                <label for="capienza"><b>Capienza</b></label>
                <input type="number" placeholder="Inserisci la capienza" name="capienza" id="capienza">
             </fieldset>

             <fieldset name="dataEvento" form="formAddEvento">
                 <label for="dataEvento"><b>Data</b></label>
                 <input type="date" placeholder="Inserisci la data" name="dataEvento" id="dataEvento">
             </fieldset>

             <fieldset name="indirizzo" form="formAddEvento">
                 <label for="indirizzo"><b>Indirizzo</b></label>
                 <input type="text" placeholder="Inserisci l'indirizzo" name="indirizzo" id="indirizzo">
             </fieldset>
            
             <fieldset name="descrizione" form="formAddEvento">
                <label for="descrizione"><b>Descrizione</b></label>
                <input type="text" placeholder="Inserisci la descrizione" name="descrizione" id="descrizione">
             </fieldset>

             <fieldset name="prezzo" form="formAddEvento">
                <label for="prezzo"><b>Prezzo</b></label>
                <input type="number" placeholder="Inserisci il prezzo del biglietto" name="prezzo" id="prezzo">
             </fieldset>

             <fieldset name="url_immagine" form="formAddEvento">
                <label for="url_immagine"><b>url Immagine</b></label>
                <input type="text" placeholder="Inserisci l'url dell'immagine" name="url_immagine" id="url_immagine">
             </fieldset>
    
             <button type="submit" class="register_btn" name="submit">Inserisci Evento</button>
             <input type="reset" class="reset_btn">
             </div>
         </form>
         </div>
         <?php require_once ('../html/footer.html')?>
        </div>
     </body>
 </html>