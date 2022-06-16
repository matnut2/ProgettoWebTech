<?php
    require_once ('session_Manager.php');
    require_once('page.php');
    require_once('veicolo.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user = createSession();

    if($_SESSION["isAdmin"] != 1){
        header('Location: err-404.php');
        exit;
    }

    if(!empty($_POST)){
        $checkIns = $user->addVeicolo($_POST['Targa'],$_POST['marca'],$_POST['modello'],$_POST['cilindrata'],$_POST['anno'],$_POST['posti'],$_POST['cambio'],$_POST['carburante'],$_POST['colore_esterni'],$_POST['url_immagine'],$_POST['descrizione'],$_POST['chilometri_Percorsi'],1);

        if($checkIns){
            echo("INSERIMENTO AVVENUTO CON SUCCESSO");
        }
        else echo("FAILED: $checkIns");
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
     </head>
     <body>
         <div class="globalDiv">
         <?php require_once ('header.php')?>
         <div id="content">
         <form action="../php/addVeicolo.php" method="post" id="formAddVeicolo">
             <div class="registration_form">
             <h2>Inserimento Veicolo</h2>
             <p>Compila i campi seguenti per inserire un nuovo veicolo</p>
             <hr>

             <label for="Targa"><b>Targa</b></label>
             <input type="text" placeholder="Inserisci la targa" name="Targa" id="Targa" required >

             <label for="marca"><b>Marca</b></label>
             <select id ="marca" name = "marca" form = "formAddVeicolo">
                <option value="Volvo">Volvo</option>
                <option value="Mercedes">Mercedes</option>
                <option value="Opel">Opel</option>
                <option value="Audi">Audi</option>      
             </select>

             <label for="modello"><b>Modello</b></label>
             <input type="text" placeholder="Inserisci il modello" name="modello" id="modello"  >

             <label for="cilindrata"><b>Cilindrata</b></label>
             <input type="number" placeholder="Inserisci la cilindrata" name="cilindrata" id="cilindrata"  >

             <label for="anno"><b>Anno</b></label>
             <input type="number" placeholder="Inserisci l'anno di immatricolazione" name="anno" id="anno"  min="1900">

             <label for="posti"><b>Posti a Sedere</b></label>
             <input type="number" placeholder="Inserisci i posti per i passeggeri" name="posti" id="posti" max="10" >

             <label for="cambio"><b>Tipologia Cambio</b></label>
             <select id ="cambio" name = "cambio" form = "formAddVeicolo">
                <option value="Automatico">Automatico</option>
                <option value="Manuale">Manuale</option>
                <option value="SemiAutomatico">Semi Automatico</option>
             </select>

             <label for="carburante"><b>Carburante</b></label>
             <select id ="carburante" name = "carburante" form = "formAddVeicolo">
                <option value="Benzina">Benzina</option>
                <option value="Diesel">Diesel</option>
                <option value="Elettrico">Elettrico</option>
                <option value="Ibrido">Ibrido</option>
                <option value="Gasolio">Gasolio</option>
                <option value="GPL">GPL</option>
            </select>
             <label for="colore_esterni"><b>Colore Esterno</b></label>
             <input type="text" placeholder="Inserisci il colore della carrozzeria" name="colore_esterni" id="colore_esterni"  >

             <label for="url_immagine"><b>Inserisci l'Immagine</b></label>
             <input type="file" placeholder="Inserisci l'url dell'immagine" name="url_immagine" id="url_immagine">

             <label for="descrizione"><b>Descrizione</b></label>
             <input type="text" placeholder="Inserisci una descrizione completa" name="descrizione" id="descrizione"  >

             <label for="chilometri_Percorsi"><b>Chilometraggio</b></label>
             <input type="number" placeholder="Inserisci i chilometri percorsi" name="chilometri_Percorsi" id="chilometri_Percorsi"  value ="0" min="0">

             <input type="reset" class="reset_btn">
             <button type="submit" class="register_btn" name="submit">Inserisci Veicolo</button>
             </div>
         </form>
         </div>
         <?php require_once ('../html/footer.html')?>
        </div>
     </body>
 </html>