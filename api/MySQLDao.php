<?php
	require_once("enums.php");

	class MySQLDao {
		public $dbConfig;
		public $conn;

		function __construct() {
			$this->dbConfig = include('config.php');
			$this->conn = new PDO('mysql:host='.$this->dbConfig->host.';dbname='.$this->dbConfig->database, 
									$this->dbConfig->username, 
									$this->dbConfig->pass, 
									array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   		}


		public function getConnection() {
			return $this->conn;
		}

		public function closeConnection() {
			$this->conn = null;
		}

		//GENERIC FUNCTIONS
		public function getFromTable($tableName) {
			$sth = $this->conn->prepare('SELECT * FROM ' . $tableName);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}


		public function getFromTableById($tableName, $id) {
			$sth = $this->conn->prepare('SELECT * FROM ' . $tableName . 'WHERE id = ' . $id);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}

		//CUSTOM FUNCTIONS

        public function getStoritve($kategorijaId) {
			$sth = $this->conn->prepare('SELECT * FROM Storitev WHERE Kategorija_id = ' . $kategorijaId);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}
	}
?>