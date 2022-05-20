<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)
    if($_SESSION["isAdmin"] != 1){
        header('Location: index.php');
        exit;
    }

    $paginaHTML= file_get_contents("../html/editorVeicoli.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $veicoli = ""; /* DATI FREZZI DAL DB */ 
    $ListaVeicoli = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $veicoli = $connessione->getVeicoliList();
        $connessione->releaseDB();

        if($veicoli != null){

            foreach($veicoli as $veicolo){
                $ListaVeicoli .='<article class = "carArticle">';
                $ListaVeicoli .= '<h3 > ' . $veicolo['marca'].' '.$veicolo['modello'] . ' - Targa ' . $veicolo['Targa']  .'</h3>';
                $ListaVeicoli .= '
                    <img class="imgListaAuto" src="../img/' . $veicolo['url_Immagine'] . '"/>
                    <p class="eventParagraph"> ' . $veicolo['descrizione'] . '</p>   
                <a class="eventButton" href="editSingleVeicolo.php?Targa='.$veicolo['Targa'].'">Modifica</a>
                </article>';
            }

        }
        else{
            $ListaVeicoli = "<p> Non ci sono veicoli modificabili</p>";
        }
    }
    else{
        $ListaVeicoli = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{auto-list}", $ListaVeicoli, $paginaHTML);
?>