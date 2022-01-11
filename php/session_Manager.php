<?php

require_once('utente_Non_Registrato.php');
require_once('utente_Registrato.php');
require_once('amministratore.php');
require_once('gestione_accessi.php');

class SessionManager
{
    function __construct()
    {}

    public function getLoggedUser(){
        /*try {
            return new amministratore($username);
        } catch (Exception $exc) {
            try {
                return new utente_Registrato($username);
            } catch (Exception $exc) {
                return new utente_Non_Registrato();
            }
        }*/
        return new utente_Non_Registrato();
    }

    public function init() {
        session_start();
        $user = $this->getLoggedUser();
        $user->setSessionVars();
        return $user;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}


?>