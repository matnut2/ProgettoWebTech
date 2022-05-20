<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    if(empty($_POST)){
        $paginaHTML= file_get_contents("../html/editSingleVeicolo.html");
        $connessione = new database_Manager();
        $connessioneOK = $connessione->connectToDatabase();
        $datiVeicolo = ""; /* DATI FREZZI DAL DB */ 
        $output = ""; /* CODICE DI HTML DA DARE IN OUTPUT */
    
        if($connessioneOK){
            if(!empty($_GET))
              $targa = $_GET['targa'];
            else $targa = null;
            $datiVeicolo = $connessione->getInfoVeicolo($targa); // PER DEBUG
            $connessione->releaseDB();
    
            if($datiVeicolo != null){
                $search = ["{placeholder-targa}", "{placeholder-marca}", "{placeholder-modello}", "{placeholder-anno}", "{placeholder-posti}","{placeholder-cambio}","{placeholder-carburante}", "{placeholder-colore}", "{placeholder-immagine}", "{placeholder-chilometri}", "{placeholder-descrizione}", "{placeholder-cilindrata}"];
                $replace = [$datiVeicolo['Targa'], $datiVeicolo['marca'], $datiVeicolo['modello'], $datiVeicolo['anno'], $datiVeicolo['posti'],$datiVeicolo['cambio'],$datiVeicolo['carburante'] ,$datiVeicolo['colore_Esterni'], $datiVeicolo['url_Immagine'], $datiVeicolo['chilometri_Percorsi'], $datiVeicolo['descrizione'], $datiVeicolo['cilindrata']];    
                
                echo str_replace($search, $replace, $paginaHTML);
            }   
            else{
                $output = "<p> Non ci sono veicoli modificabili</p>";
            }
        }
        else{
            $output = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
        }
    }
?>