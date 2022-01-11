<?php 
class database_Manager{

    private $DB_HOST = "localhost";
    private $DB_NAME = "AutoAsta";
    private $USER = "app";
    private $PWD = "appdbpasswd";
    
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
    
    public function query($query) {
		return mysqli_query($this->connection,$query);
	}

    public function getError() {
		return $this->connection->errno;
	}
}
?>