
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
        <form action="../php/inserimentoVeicoliEditor.php" method="post">
            <div class="login_form">
            <h2>Inserimento Veicolo</h2>
            <p>Compila i campi seguenti per inserire un nuovo veicolo</p>
            <hr>
        
            <label for="Targa"><b>Targa</b></label>
            <input type="Targa" placeholder="Inserisci la targa" name="Targa" id="Targa" required>
        
            <label for="marca"><b>Marca</b></label>
            <input type="marca" placeholder="Inserisci la marca" name="marca" id="marca" required>

            <label for="modello"><b>Modello</b></label>
            <input type="modell0" placeholder="Inserisci il modello" name="modello" id="modello" required>

            <label for="cilindrata"><b>Cilindrata</b></label>
            <input type="cilindrata" placeholder="Inserisci la cilindrata" name="cilindrata" id="cilindrata" required>

            <label for="anno"><b>Anno</b></label>
            <input type="anno" placeholder="Inserisci l'anno di immatricolazione" name="anno" id="anno" required>

            <label for="posti"><b>Posti a Sedere</b></label>
            <input type="posti" placeholder="Inserisci i posti per i passeggeri" name="posti" id="posti" required>

            <label for="cambio"><b>Tipologia Cambio</b></label>
            <input type="cambio" placeholder="Inserisci la tipologia di cambio" name="cambio" id="cambio" required>

            <label for="carburante"><b>Carburante</b></label>
            <input type="carburante" placeholder="Inserisci il carburante" name="carburante" id="carburante" required>

            <label for="colore_Esterni"><b>Colore Esterno</b></label>
            <input type="colore_Esterni" placeholder="Inserisci il colore della carrozzeria" name="colore_Esterni" id="colore_Esterni" required>

            <label for="url_immagine"><b>Inserisci l'Immagine</b></label>
            <input type="url_immagine" placeholder="Inserisci l'url dell'immagine" name="url_immagine" id="url_immagine">

            <label for="descrizione"><b>Descrizione</b></label>
            <input type="descrizione" placeholder="Inserisci una descrizione completa" name="descrizione" id="descrizione" required>

            <label for="chilometri_Percorsi"><b>Chilometraggio</b></label>
            <input type="chilometri_Percorsi" placeholder="Inserisci i chilometri percorsi" name="chilometri_Percorsi" id="chilometri_Percorsi" required>

            <label for="disponibile"><b>Disponibilità</b></label>
            <input type="disponibile" placeholder="L'auto è disponibile?" name="disponibile" id="disponibile" required>
        
            <button type="submit" class="submit" name="submit">Inserisci Veicolo</button>

            <?php 
                require_once "database_Manager.php";
                $connessione = new database_Manager();
                $connessioneOK = $connessione->connectToDatabase();
                  if(isset($_POST['submit'])){
                      $Targa = $_POST['Targa'];
                      $marca = $_POST['marca'];
                      $modello = $_POST['modello'];
                      $cilindrata = $_POST['cilindrata'];
                      $anno = $_POST['anno'];
                      $posti = $_POST['posti'];
                      $cambio = $_POST['cambio'];
                      $carburante = $_POST['carburante'];
                      $colore_Esterni = $_POST['colore_Esterni'];
                      $url_immagine = $_POST['url_immagine'];
                      $descrizione = $_POST['descrizione'];
                      $chilometri_Percorsi = $_POST['chilometri_Percorsi'];
                      $disponibile = $_POST['disponibile'];

                      $query = "INSERT INTO Veicolo(Targa,marca,modello,cilindrata,anno,posti,cambio,carburante,colore_Esterni,url_immagine,descrizione,chilometri_Percorsi,disponibile) VALUES('$Targa','$marca','$modello','$cilindrata','$anno','$posti','$cambio','$carburante','$colore_Esterni','$url_immagine','$descrizione','$chilometri_Percorsi','$disponibile');";
                      $queryResult = $connessione->query($query) or die("Errore in inserimentoVeicolo:" . mysqli_error($this->connection));
                      $connessione->releaseDB();


                  }
            ?>
            </div>
        </form>
        </div>
        <?php require_once ('../html/footer.html')?>
        <div class="globalDiv">
    </body>
</html>
