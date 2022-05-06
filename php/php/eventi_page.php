<?php
    require_once "database_Manager.php";


    $paginaHTML= file_get_contents("../html/eventi.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $eventi = ""; 
    $listaEventi = "";

        if($connessioneOK){
            $connessione->acquistaBiglietto();
            $eventi = $connessione->getEventiList();
            //$checkDate = $connessione->checkEventiDate($eventi);
            if($eventi != null){
                $index= 0;
                foreach($eventi as $evento){
                    $listaEventi .= '<dt class = "eventTitle" > ' . $evento['nome'] .' '. $evento['data'].'</dt>';
                    $listaEventi .= '<dd class= "eventDescription">
                        <img class="eventImg" src="../img/' . $evento['url_immagine'] . '"/>
                        <p class="eventParagraph"> ' . $evento['descrizione'] . '</p>';
                        if(//$checkDate[$index]){
                            0){
                            $listaEventi.= '<a class="notAvailable" >PECCATO, QUESTO EVENTO &Egrave TRASCORSO </a></dd>'; 
                        }
                        else {
                            $listaEventi .= '
                            <form method="POST">
                        <input type="submit" name="acquista" value="Acquista Biglietto"/></dd>';
                    
                        }
                    $index++;
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