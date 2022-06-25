<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Eventi - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Homepage di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>

            <div id="content" tabindex="8">
            <?php
                require_once "database_Manager.php";

                // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

                $paginaHTML= file_get_contents("../html/eventi.html");
                $connessione = new database_Manager();
                $connessioneOK = $connessione->connectToDatabase();
                $eventi = ""; /* DATI FREZZI DAL DB */ 
                $listaEventi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

                if($connessioneOK){
                    $biglietti = $connessione->getListaBiglietti($_SESSION['email']);
                    if($biglietti != null){
                        $index = 0;
                        foreach($biglietti as $biglietto){
                            $evento = $connessione->getEventoInfo($biglietto['evento']);
                            $listaEventi .= '<dt class = "eventTitle" > Fiera di: ' . $evento[0]['nome'] .'</dt>';
                            $listaEventi .= '<img class="eventImg" src="../img/' . $evento[0]['url_immagine'] . '"/>';
                            $listaEventi .= '<dd class= "eventDescription">
                                <ul class="eventParagraph">
                                <li>INTESTATO A: ' . $biglietto['utente'] . '</li>
                                <li>ACQUISTATO IL GIORNO: ' . $biglietto['data_Acquisto'].'</li>
                                <li>VALIDO IL GIORNO: ' . $evento[0]['data'] . '</li>
                                </ul>';
                            $listaEventi .='<p class="idBiglietto">IDENTIFICATIVO BIGLIETTO: '. $biglietto['Id_Biglietto'].'</p>';
                        }
                        $connessione->releaseDB();
                    }
                    else{
                        $listaEventi = "<p> Non ci sono informazioni relative ai eventi </p>";
                    }
                }
                else{
                    $listaEventi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
                }
                echo str_replace("{event-list}", $listaEventi, $paginaHTML);
            ?>
            </div>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>


