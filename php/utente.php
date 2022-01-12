<?php
include_once('database_Manager');

class utente{
    private $db; 

    public function __construct(){
		try {
			$this->db = new database_Manager();
		} catch (Exception $exc) {
			header('Location: '.$_SERVER['PATH_INFO'].'html/404.html');
			exit();
		}
	}
}
?>