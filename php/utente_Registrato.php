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

    public function __construct($email_user) {
		parent::__construct();

		$query = $this->getDBConnection()->query("SELECT * FROM Utente,Account WHERE Utente.Email = '$email_user' AND Utente.Email = Account.email");
		if ($query->num_rows > 0) {
			$result = $query->fetch_assoc();
			$this->ID = $result['ID'];
			$this->username = $result['username'];
			$this->password = $result['password'];
			$this->email = $email_user;
            $this->nome = $result['nome'];
            $this->cognome = $result['cognome'];
            $this->data_Creazione = $result['data_Creazione'];
            $this->url_Immagine = $result['url_Immagine'];
            $this->data_Nascita = $result['data_Nascita'];
		} else {
			throw new Exception("Utente non esistente");
		}
	}

}
?>