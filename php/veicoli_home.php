<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/veicoli_home.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $personaggi = ""; /* DATI  DAL DB */ 
    $listaPersonaggi = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $personaggi = $connessione->getNewVeicoli();
        $connessione->releaseDB();

        if($personaggi != null){
            foreach($personaggi as $personaggio ){
                $listaPersonaggi .='<article class = "carArticle">';
                $listaPersonaggi .= '<h3 > ' . $personaggio['marca'].' '.$personaggio['modello'] .'</h3>';
                $listaPersonaggi .= '
                    <img class="imgListaAuto" src="../img/' . $personaggio['url_Immagine'] . '"/>
                <a class="eventButton" href="">MAGGIORI INFORMAZIONI</a>
                </article>';
            }
        }
        else{
            $listaPersonaggi = "<p> Non ci sono informazioni relative ai veicoli </p>";
        }
    }
    else{
        $listaPersonaggi = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{auto-list}", $listaPersonaggi, $paginaHTML);
?>