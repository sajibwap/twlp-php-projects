<?php 


/**
 * Database Class
 */

class Database{
	private $db_host 	= "localhost";
	private $db_name 	= "twlp_lr";
	private $db_username = "root";
	private $db_password = "";
	public $pdo;

    /**
     * Connect Database
     */

    public function __construct(){
        if (!isset($this->pdo)) {
        	try{
        		$conn = new PDO(
                    "mysql:host=localhost;dbname={$this->db_name}",
                    $this->db_username,
                    $this->db_password
                );
        		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        		$this->pdo = $conn;
        	}catch(PDOException $e){
        		die("Connection failed ".$e->getMessage());
        	}
        }
    }
}