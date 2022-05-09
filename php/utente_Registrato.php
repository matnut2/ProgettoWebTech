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

    public function getID(){
        return $this->ID;
    }

    function getUsername(){
        return $this->username;
    }

    function getEmail(){
        return $this->email;
    }
    
    private function getPassword(){
        return $this->password;
    }

    private function getNome(){
        return $this->nome;
    }

    private function getCognome(){
        return $this->cognome;
    }

    public function getDataCreazione(){
        return $this->data_Creazione;
    }

    public function getUrlImmagine(){
        return $this->url_Immagine;
    }

    private function getDataNascita(){
        return $this->data_Nascita;
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

    public function updateUserInfo ($username, $password, $url_immagine, $data_Nascita){

        if($username!="" && $this->getUsername()!=$username){
            $this->username=$username;
        }
        if($password!="" && $this->getPassword()!=$password){
            $this->password=$password;
        }
        if($url_immagine!="" && $this->getUrlImmagine()!=$url_immagine){
            $this->url_Immagine = $url_immagine;
        }
        if($data_Nascita!="" && $this->getDataNascita()!=$data_Nascita){
            $this->data_Nascita = $data_Nascita;
        }

        $this->getDB()->query(
            "UPDATE Utente SET 
             Utente.url_Immagine='".$this->getUrlImmagine()."',
             Utente.data_nascita='".$this->getDataNascita()."'
             WHERE Utente.Email='".$this->getEmail()."';"
        );

        echo("Sono lo user:".$this->getUsername());
        $this->getDB()->query(
            "UPDATE Account SET Account.username = '".$this->getUsername()."' 
            WHERE Account.email = '".$this->getEmail()."';"
        );


        return $this->getDBError() == 0;
    }
    
}
?>