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
			$sth = $this->conn->prepare(
				'SELECT * FROM Storitev WHERE Kategorija_id = ' . $kategorijaId
			);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}

		public function getKategorije($hotelId) {
			$sth = $this->conn->prepare(
				'SELECT * FROM Kategorija WHERE Hotel_id = ' . $hotelId
			);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}

		
		public function addNarocilo($uporabnikId, $casStoritve) {
			$time_stamp = date('Y-m-d H:i:s');
			$sth = $this->conn->prepare(
				'INSERT INTO Narocilo (timestamp, cas_storitve, Uporabnik_id)
				VALUES (:time_stamp, :cas_storitve, :Uporabnik_id)'
			);

			$sth->bindParam(':time_stamp', $time_stamp, PDO::PARAM_STR);
			$sth->bindParam(':cas_storitve', $casStoritve, PDO::PARAM_STR);
			$sth->bindParam(':Uporabnik_id', $uporabnikId, PDO::PARAM_INT);

			$sth->execute();
			return $this->conn->lastInsertId();
		}
		
		public function getNarocila($uporabnikId) {
			$sth = $this->conn->prepare(
				'SELECT * FROM Narocilo WHERE Uporabnik_id = ' . $uporabnikId
			);
			$sth->execute();

			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

			$returnValue = array();

			return json_encode($rows);
		}

		
	}
?>