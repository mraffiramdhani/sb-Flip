<?php

	include_once 'config.php';
	
	class Database {
		
		private $config;
		public $conn;

		public function __construct(){
			$this->config = new Config();
		}

		/**
		 * Make a database connection
		 * 
		 * @return object Connection to the database
		 */
		
		public function connect() {
			$this->conn = null;
			
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			try {
			 	$this->conn = new mysqli($this->config->DB_HOST, $this->config->DB_USER, $this->config->DB_PASS, $this->config->DB_NAME);
			  	$this->conn->set_charset("utf8mb4");
			} catch(Exception $e) {
			  	error_log($e->getMessage());
			  	exit('Error connecting to database');
			}

			return $this->conn;
		}

	}

?>