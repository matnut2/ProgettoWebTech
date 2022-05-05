<?php 
    require_once('utente.php');

class utente_Registrato extends utente{
    private $ID = null;
    private $username = null;
    private $password = null;
    private $email = null;
    private $nome = null;
    private $cognome = null;
    private $data_Creazione = null;
    private $url_Immagine = null;
    private $data_Nascita = null;
    private $isAdmin = 0;

    public function __construct($email_user) {
		parent::__construct();

		$query = $this->getDB()->query("SELECT * FROM Utente,Account WHERE Utente.Email = '$email_user' AND Utente.Email = Account.email");
		if ($query->num_rows > 0) {
			$result = $query->fetch_assoc();
			$this->ID = $result['id_Account'];
			$this->username = $result['username'];
			$this->password = $result['password'];
			$this->email = $email_user;
            $this->nome = $result['nome'];
            $this->cognome = $result['cognome'];
            $this->data_Creazione = $result['data_Creazione'];
            $this->url_Immagine = $result['url_Immagine'];
            $this->data_Nascita = $result['data_nascita'];
            $this->isAdmin = $result['isAdmin'];
		} else {
			throw new Exception("Utente non esistente");
		}
	}

    public function isReg(){
        return true;
    }

    public function checkPassword($psw){
        //return sha1($psw) == $this->password;
        return $psw == $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getID(){
        return $this->ID;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function setSessionVars(){
        $_SESSION['email'] = $this->getEmail();
        $_SESSION['ID'] = $this->getID();
        $_SESSION['isAdmin'] = $this->getIsAdmin();
    }

    public function addVeicolo($targa,$marca,$modello,$cilindrata,$anno,$posti,$cambio,$carburante,$colori_Esterni,$url_Immagine,$descrizione,$chilometri_Percorsi,$disponibile){
        date_default_timezone_set("Europe/Rome");
        $data_Aggiunta = date("Y-m-d");

        $this->getDB()->query(
            "INSERT INTO VEICOLO (Targa, marca, modello, cilindrata, anno, posti, cambio,carburante, colore_Esterni, url_Immagine, descrizione, chilometri_Percorsi, disponibile, data_Aggiunta)
            VALUES ('$targa','$marca','$modello','$cilindrata','$anno','$posti','$cambio','$carburante','$colori_Esterni','$url_Immagine','$descrizione','$chilometri_Percorsi','$disponibile','$data_Aggiunta');"
        );

        return $this->getDBError() == 0;
    }
    
}
?>