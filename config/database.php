<?php
	
	class Database {
		private $host 	= "localhost";
		private $user 	= "root";
		private $pass 	= "";
		private $dbname = "flip_test";
		public $conn;

		public function connect() {
			$this->conn = null;
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			try {
			 	$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			  	$this->conn->set_charset("utf8mb4");
			} catch(Exception $e) {
			  	error_log($e->getMessage());
			  	exit('Error connecting to database');
			}

			return $this->conn;
		}

	}

?>