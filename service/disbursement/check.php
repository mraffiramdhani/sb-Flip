<?php
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once '../../config/database.php';
	include_once '../../config/http.php';
	include_once '../../model/disbursement.php';

	$database = new Database();
	$db = $database->connect();

	$helper = new Http();

	$dbs = new Disbursement($db);

	$dbs_id = (int)$_GET['id'];

	if($dbs_id){

		$request = json_decode($helper->request("disburse/".$dbs_id, "GET"));

		$dbs->transaction_id = $dbs_id;
		$dbs->status 		 = $request->status;
		$dbs->receipt		 = $request->receipt;
		$dbs->time_served	 = $request->time_served;

		$db_exec = $dbs->update()->fetch_assoc();

		$res_array = array(
			"id" 				=> $db_exec["transaction_id"],
			"amount" 			=> $db_exec["amount"],
			"status"			=> $db_exec["status"],
			"timestamp"			=> $db_exec["timestamp"],
			"bank_code"			=> $db_exec["bank_code"],
			"account_number"	=> $db_exec["account_number"],
			"beneficiary_name"	=> $db_exec["beneficiary_name"],
			"remark" 			=> $db_exec["remark"],
			"receipt"			=> $db_exec["receipt"],
			"time_served"		=> $db_exec["time_served"],
			"fee"				=> $db_exec["fee"]
		);

		$response = $helper->response("success", "Data Found.", $res_array);

		echo json_encode($response);
	}
	else {
		http_response_code(400);

		$response = $helper->response("failed", "Unable to check disbursement status. Transaction id is invalid or empty");

		echo json_encode($response);
	}

?>