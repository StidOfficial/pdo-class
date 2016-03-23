<?php
class SQL {
	
	private $_PDO;
	private $_PDO_DNS;
	
	private $_PDO_CONFIG;
	
	public function Connect() {
		try {
			$this->_PDO_CONFIG = parse_ini_file("sql.ini.php", true);
			$this->_PDO_DNS = "mysql:host=".$this->_PDO_CONFIG["SQL"]["HOSTNAME"].";dbname=".$this->_PDO_CONFIG["SQL"]["DATABASE"];
			$this->_PDO = new PDO($this->_PDO_DNS, $this->_PDO_CONFIG["SQL"]["USERNAME"], $this->_PDO_CONFIG["SQL"]["PASSWORD"]);
		} catch (Exception $e) {
			header("Content-Type: text/plain");
			echo "[SQL][CONNECT] ", $e->getMessage();
			die();
		}
	}
	
	public function Query($_Query) {
		$_Query_Result = $this->_PDO->query($_Query);
		if($_Query_Result == false) {
			header("Content-Type: text/plain");
			echo "[SQL][QUERY] Query Error : ".$_Query;
			die();
		}else{
			return $_Query_Result;
		}
	}
	
	public function lastInsertId() {
		return $this->_PDO->lastInsertId();
	}
}
?>
