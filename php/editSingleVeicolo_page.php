<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/editSingleVeicolo.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $datiVeicolo = ""; /* DATI FREZZI DAL DB */ 
    $output = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $datiVeicolo = $connessione->getInfoVeicolo("AB001CD"); // PER DEBUG
        $connessione->releaseDB();

        if($datiVeicolo != null){
            $search = ["{placeholder-targa}", "{placeholder-marca}", "{placeholder-modello}", "{placeholder-anno}", "{placeholder-posti}", "{placeholder-colore}", "{placeholder-immagine}", "{placeholder-chilometri}", "{placeholder-descrizione}", "{placeholder-cilindrata}"];
            $replace = [$datiVeicolo['Targa'], $datiVeicolo['marca'], $datiVeicolo['modello'], $datiVeicolo['anno'], $datiVeicolo['posti'], $datiVeicolo['colore_Esterni'], $datiVeicolo['url_Immagine'], $datiVeicolo['chilometri_Percorsi'], $datiVeicolo['descrizione'], $datiVeicolo['cilindrata']];    
            
            echo str_replace($search, $replace, $paginaHTML);

            /*
            echo str_replace("{placeholder-targa}", $datiVeicolo['Targa'], $paginaHTML);
            echo str_replace("{placeholder-marca}", $datiVeicolo['marca'], $paginaHTML);
            echo str_replace("{placeholder-modello}", $datiVeicolo['modello'], $paginaHTML);
            echo str_replace("{placeholder-anno}", $datiVeicolo['anno'], $paginaHTML);
            echo str_replace("{placeholder-posti}", $datiVeicolo['posti'], $paginaHTML);
            echo str_replace("{placeholder-colore}", $datiVeicolo['colore_Esterni'], $paginaHTML);
            echo str_replace("{placeholder-immagine}", $datiVeicolo['url_Immagine'], $paginaHTML);
            echo str_replace("{placeholder-chilometri}", $datiVeicolo['chilometri_Percorsi'], $paginaHTML);
            echo str_replace("{placeholder-descrizione}", $datiVeicolo['descrizione'], $paginaHTML);           
            */
        }   
        else{
            $output = "<p> Non ci sono veicoli modificabili</p>";
        }
    }
    else{
        $output = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    //echo str_replace("{auto-list}", $output, $paginaHTML);
?>