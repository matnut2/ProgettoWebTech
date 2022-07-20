<?php
    require_once ('session_Manager.php');
    require_once('page.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user = createSession();

    if($_SESSION["isAdmin"] != 1){
        $_SESSION['errorMsg'] = "Devi essere un amministratore per accedere alla funzionalit&agrave; di aggiunta veicolo";
        header('Location: ../php/pagina_avvisi.php');
        exit;
    }

    if(!empty($_POST)){
         $user->deleteVeicoli($_POST['Targa']);
        if($checkIns){
            $_SESSION['successMsg'] = "Veicolo eliminato con successo";
        }
        $_SESSION['errorMsg'] = "Impossibile eliminare il veicolo richiesto";
        header('Location: ../php/pagina_avvisi.php');
        exit;
    }
    */
        
?>
<?php
    require_once "database_Manager.php";

    // Leggere il risultato dal database e stamparlo a schermo (impaginandolo)

    $paginaHTML= file_get_contents("../html/veicoli.html");
    $connessione = new database_Manager();
    $connessioneOK = $connessione->connectToDatabase();
    $veicoli= ""; /* DATI  DAL DB */ 
    $listaVeicoli = ""; /* CODICE DI HTML DA DARE IN OUTPUT */

    if($connessioneOK){
        $veicoli= $connessione->getVeicoliList();
        $connessione->releaseDB();

        if($veicoli!= null){

            foreach($veicoli as $veicolo){
                $listaVeicoli .='<article class = "carArticle">';
                $listaVeicoli .= '<form action="post">';
                $listaVeicoli .= '<h3 > ' . $veicolo['marca'].' '.$veicolo['modello'] .'</h3>';
                $listaVeicoli .= '
                    <img class="imgListaAuto" src="../img/' . $veicolo['url_Immagine'] . '"/>
                    <p class="eventParagraph"> ' . $veicolo['descrizione'] . '</p>   
                    <p class="carPrice">Prezzo base: '.$veicolo['base_Asta'].'&euro;</p>
                    <button type="submit" class="register_btn" name="submit">Elimina Veicolo</button>
                </article>';
            }

        }
        else{
            $listaVeicoli = "<p> Non ci sono informazioni relative ai veicoli </p>";
        }
    }
    else{
        $listaVeicoli = "<p> I Sistemi sono Attualmente Fuori Uso </p>";
    }
    echo str_replace("{auto-list}", $listaVeicoli, $paginaHTML);
?>