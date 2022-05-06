<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/eventi_home.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $personaggi = ""; /* DATI FREZZI DAL DB */ 
    $listaPersonaggi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $personaggi = $connessione->getNextEvento();
        $connessione->releaseDB();

        if($personaggi != null){

            foreach($personaggi as $personaggio){
                $listaPersonaggi .= '<dt class = "eventTitle" > ' . $personaggio['nome'] .' '. $personaggio['data'].'</dt>';
                $listaPersonaggi .= '<dd class= "eventDescription">
                    <img class="eventImg" src="../img/' . $personaggio['url_immagine'] . '"/>
                    <p class="eventParagraph"> ' . $personaggio['descrizione'] . '</p>
                    <a class="eventButton" href="">MAGGIORI INFORMAZIONI</a>
                </dd>';
            }

        }
        else{
            $listaPersonaggi = "<p> Non ci sono informazioni relative ai personaggi </p>";
        }
    }
    else{
        $listaPersonaggi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{event-list}", $listaPersonaggi, $paginaHTML);
?>