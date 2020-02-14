<?php
	
	include_once 'database.php';

	try{
		$db_con = new Database();
		$conn = $db_con->connect();
		$query = file_get_contents("migration/db_migration.sql");
		mysqli_query($conn, $query);

		echo 'database created successfully.';
	}catch(Exception $e){
		echo $e->getMessage();
	}

?>