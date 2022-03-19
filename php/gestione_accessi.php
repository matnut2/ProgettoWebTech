<?php

require_once('page.php');
require_once('utente_Non_Registrato.php');
require_once('utente_Registrato.php');

class gestione_accessi extends page{
    public function inserimentoNuovoUtente ($post, utente_Non_Registrato $utente){
        $utente -> iscrizione($post['email'],$post['username'], $post['psw'], 0,$post['nome'],$post['cognome']
        ,$post['url_immagine'],$post['data_nascita']);
        if($utente){
            return true;
        }
        else return false;
    }
}
?>