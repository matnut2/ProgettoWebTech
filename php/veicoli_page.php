<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/veicoli.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectDB();
    $personaggi = ""; /* DATI FREZZI DAL DB */ 
    $listaPersonaggi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $personaggi = $connessione->getVeicoliList();
        $connessione->releaseDB();

        if($personaggi != null){

            foreach($personaggi as $personaggio){
                $listaPersonaggi .='<article class = "carArticle">';
                $listaPersonaggi .= '<h3 > ' . $personaggio['marca'].' '.$personaggio['modello'] .'</h3>';
                $listaPersonaggi .= '
                    <img class="imgListaAuto" src="../img/' . $personaggio['url_Immagine'] . '"/>
                    <p class="eventParagraph"> ' . $personaggio['descrizione'] . '</p>   
                <a class="eventButton" href="">APRI SCHEDA VEICOLO</a>
                </article>';
            }

        }
        else{
            $listaPersonaggi = "<p> Non ci sono informazioni relative ai personaggi </p>";
        }
    }
    else{
        $listaPersonaggi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{auto-list}", $listaPersonaggi, $paginaHTML);
?>