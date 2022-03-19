<?php
include_once('database_Manager.php');

abstract class utente{
    private $db; 

	public abstract function isReg();

    public function __construct(){
		try {
			$this->db = new database_Manager();
		} catch (Exception $exc) {
			header('Location: '.$_SERVER['PATH_INFO'].'html/404.html');
			exit();
		}
	}

	public function getDBError() {
		return $this->db->getError();
	}

	public function getDB(){
		return $this->db;
	}
}
?>