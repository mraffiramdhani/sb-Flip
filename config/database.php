<?php
	
	class Database {
		private $host = "localhost";
		private $user = "root";
		private $pass = "brogamer980";
		private $dbname = "flip_test";

		public function connect() {
			$conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

			return $conn;
		}

		public function db_connect() {
			$conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);

			return $conn;	
		}
	}

?>