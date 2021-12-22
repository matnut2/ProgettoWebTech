<?php 
class database_Manager{

    private static $instance = null;
    private $conn;

    private $host = "localhost"; //da modificare
    private $user = 'app';
    private $pass = 'appdbpasswd';
    private $database = 'AutoAsta';


    private function __construct(){
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

    public function query($queryString,$className = "stdClass")
    {
        $results = [];
        $res = $this->conn->query($queryString);
        if ($res == false)
            return null;
        if ($res === true || $res === false)
        {
            return $res;
        }
        while ($row = $res->fetch_object($className)) {
            array_push($results, $row);
        }
        return $results;
    }

    function __destruct() {
        $this->conn->close();
    }
}
?>