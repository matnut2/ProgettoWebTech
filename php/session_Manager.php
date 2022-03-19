<?php

require_once('utente_Non_Registrato.php');
require_once('utente_Registrato.php');
require_once('amministratore.php');
require_once('gestione_accessi.php');


function getLoggedUser($email){
    try {
        return new amministratore($email);
    } catch (Exception $exc) {
        try {
            return new utente_Registrato($email);
        } catch (Exception $exc) {
            return new utente_Non_Registrato();
        }
    }
}

function login ($email, $password){
    $user = getLoggedUser($email);
    if($user -> isReg() && !$user->checkPassword($password)){
        $user = new utente_Non_Registrato();
    }
    $user->setVarSession();
    return $user;
}

function logout()
{
    session_unset();
    session_destroy();
}

function createSession(){
    session_start();
    $user = getLoggedUser($_SESSION['email']);
    $user->setVarSession();
    return $user;
}

?>