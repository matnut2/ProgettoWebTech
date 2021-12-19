<?php 
class database_Manager{

    private static $instance = null;
    private $conn;

    private $host = "localhost"; //da modificare
    private $user = 'app';
    private $pass = 'appdbpasswd';
    private $database = 'AutoAsta';


    private function __constructor(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if ($this->conn->connect_errno) {
            die("Connection to db failed");
        }
    }

     
    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new database_Manager();
        }
    
        return self::$instance;
    }

    function __destruct() {
        $this->conn->close();
    }
}
?>