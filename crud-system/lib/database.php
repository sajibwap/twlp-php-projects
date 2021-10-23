<?php 

class Database {
	public $host 	= DB_HOST;
	public $user 	= DB_USER;
	public $pass 	= DB_PASS;
	public $dbname 	= DB_NAME;

	public $connect;
	public $error;

	/**
	 * Initialize Connection
	 */

	public function __construct(){
		$this->ConnectDB();

	}

	/**
	 * Database connection
	 */

	private function ConnectDB(){
		$this->connect = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
		if (!$this->connect) {
			$this->error = "Connection failed".$this->connect->connect_error;
			return false;
		}
	}
	/**
	 * Fetch or Get data
	 */

	public function select($SQL_Query){
		$result = $this->connect->query($SQL_Query) or die($this->connect->error.__LINE__);
		if ( $result->num_rows > 0 ) {
			return $result;
		}else{
			return false;
		}
	}

	/**
	 * Create or insert data
	 */

	public function insert($SQL_Query){
		$row_insert = $this->connect->query($SQL_Query) or die($this->connect->error.__LINE__);
		if ($row_insert) {
			header('Location: index.php?msg='.urlencode('Data inserted successfully
				'));
			exit();
		}else{
			$error = die("Error:(".$this->connect->errno.")".$this->connect->merror);
		}
	}
	
	/**
	 * update data
	 */
	
	public function update($SQL_Query){
		$row_update = $this->connect->query($SQL_Query) or die($this->connect->error.__LINE__);
		if ($row_update) {
			header('Location: index.php?msg='.urlencode('Data updated successfully
				'));
			exit();
		}else{
			$error = die("Error:(".$this->connect->errno.")".$this->connect->merror);
		}
	}
	
	/**
	 * delete data
	 */
	public function delete($sql){
		$row_delete = $this->connect->query($sql) or die($this->connect->error.__LINE__);
		if ($row_delete) {
			header('Location: index.php?msg='.urlencode('1 Data deleted successfully
				'));
			exit();
		}else{
			$error = die("Error:(".$this->connect->errno.")".$this->connect->merror);
		}
	}


}

?>