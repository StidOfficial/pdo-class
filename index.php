<?php
require_once("pdo.class.php");
$_SQL = new SQL;
$_SQL->Connect();
$_Query = $_SQL->Query("SELECT * FROM test");
$_Query->setFetchMode(PDO::FETCH_OBJ);
while($_Result = $_Query->fetch()) {
	echo $_Result->id;
}
?>