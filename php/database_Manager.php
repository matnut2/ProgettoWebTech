<?php 
class database_Manager{

    private const DB_HOST = "localhost";
    private const DB_NAME = "AutoAsta";
    private const USER = "app";
    private const PWD = "appdbpasswd";
    
    private $connection;
    
    public function connectDB(){
        $this->connection = mysqli_connect(database_Manager::DB_HOST, database_Manager::USER, database_Manager::PWD, database_Manager::DB_NAME);
        if(mysqli_connect_errno()){
            return false;
        }
        else{
            return true;
        }
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
}
?>