<?php
class SQL {
	private $_PDO;
	private $_PDO_DNS;
	
	private $_PDO_CONFIG;
	
	public function Connect() {
		try {
			$this->_PDO_CONFIG = parse_ini_file("config.ini", true);
			$this->_PDO_DNS = "mysql:host=".$this->_PDO_CONFIG["SQL"]["HOSTNAME"].";dbname=".$this->_PDO_CONFIG["SQL"]["DATABASE"];
			$this->_PDO = new PDO($this->_PDO_DNS, $this->_PDO_CONFIG["SQL"]["USERNAME"], $this->_PDO_CONFIG["SQL"]["PASSWORD"], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING));
		} catch (Exception $e) {
			header("Content-Type: text/plain");
			echo "[SQL][CONNECT] ", $e->getMessage();
			die();
		}
	}
	
	public function Query($_Query) {
		$_SQL_Query = $this->_PDO->query($_Query);
		if($_SQL_Query == false) {
			header("Content-Type: text/plain");
			echo "[SQL][QUERY] Query Error : ".$_Query;
			die();
		}else{
			return $_SQL_Query;
		}
	}
	
	public function Prepare($_Prepare, $_Prepare_Parms) {
		$_SQL_Prepare = $this->_PDO->prepare($_Prepare);
		if($_SQL_Prepare == false) {
			header("Content-Type: text/plain");
			echo "[SQL][QUERY] Prepare Error : ".$_Prepare;
			die();
		}else{
			return $_SQL_Prepare->execute($_Prepare_Parms);
		}
	}
	
	public function Quote($value) {
		return $this->_PDO->quote($value);
	}
	
	public function lastInsertId() {
		return $this->_PDO->lastInsertId();
	}
}
?>
