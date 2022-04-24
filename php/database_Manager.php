<?php 
class database_Manager{
    private $DB_HOST = "127.0.0.1";
    private $DB_NAME = "autoasta";
    private $USER = "root";
    private $PWD = "";
    private $connection;

    public function __construct(){
		if (!$this->connectToDatabase($this->DB_NAME))
			throw new Exception();
	}

	public function DatabaseConnection($host,$username,$password,$connection) {
		$this->DB_HOST = $host;
		$this->USER = $username;
		$this->PWD = $password;
		if (!$this->connectToDatabase($DB_NAME))
			throw new Exception();
	}

	public function connectToDatabase() {
		$this->connection = mysqli_connect($this->DB_HOST,$this->USER,$this->PWD,$this->DB_NAME);
		if (!$this->connection)
			return false;
		else
			return true;
	}
    
    public function releaseDB(){
        mysqli_close($this->connection);
    }
    
    public function getEventiList(){
        $query = "SELECT * FROM Evento ORDER BY data ASC;";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getEventiList:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }

    public function getVeicoliList(){
        $query = "SELECT * FROM Veicolo ";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getVeicoliList:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }
    
    public function getVeicoli(){
        $query = "SELECT * FROM Veicolo ";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getVeicoliList:" . mysqli_error($this->connection));
        return $queryResult;

        /*if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
       /* else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
        */
    }
    
    public function query($query) {
		return mysqli_query($this->connection,$query);
	}

    public function getError() {
		return $this->connection->errno;
	}

    public function getInfoVeicolo($targa){
        $query = "SELECT * FROM Veicolo WHERE Targa='$targa'";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore nel recupero dei dati del veicolo:" . mysqli_error($this->connection));

        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }else{
            
            $info = mysqli_fetch_object($queryResult);
        }
        
        $queryResult->free();
        $output = json_decode(json_encode($info), true);
        return $output;

    }
    public function insertVeicolo(){
        $query = "INSERT INTO Veicolo(Targa,marca,modello,cilindrata,anno,posti,cambio,carburante,colore_Esterni,url_immagine,descrizione,chilometri_Percorsi,disponibile) VALUES($Targa,$marca,$modello,$cilindrata,$anno,$posti,$cambio,$carburante,$colore_Esterni,$url_immagine,$descrizione,$chilometri_Percorsi,$disponibile);";
        //$query = "INSERT INTO Veicolo(Targa,marca,modello,cilindrata,anno,posti,cambio,carburante,colore_Esterni,url_immagine,descrizione,chilometri_Percorsi,disponibile) VALUES('AP001CV','Romeo','147','2000','2001','5','Manuale','Benzina','Nero','../img/AudiA5.jpg','ciao','1500','1');";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in inserimentoVeicolo:" . mysqli_error($this->connection));

       /* if(mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else{
            $result = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            
            $queryResult->free();
            return $result;
        }
    }*/
//}
}
}

?>