<?php

	$db_con = mysqli_connect('localhost', 'root', 'brogamer980', 'flip_test');

	$dsb = "CREATE TABLE disbursements (
				id INT PRIMARY KEY AUTO_INCREMENT,
				amount DECIMAL(12,0) NOT NULL,
				status VARCHAR(10) NOT NULL,
				timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				bank_code VARCHAR(20) NOT NULL,
				account_number VARCHAR(20) NOT NULL,
				beneficiary_name VARCHAR(30) NOT NULL,
				remark TEXT,
				receipt TEXT,
				time_served TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				fee DECIMAL(12,0)
			)";

	mysqli_query($db_con, $dsb) or die("Creating Disbursements Table Failed. $dsb");

?>