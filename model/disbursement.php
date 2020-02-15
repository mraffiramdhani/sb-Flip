<?php

	class Disbursement {
		private $conn;
		private $table = 'disbursements';

		public $id;
		public $transaction_id;
		public $amount;
		public $status;
		public $bank_code;
		public $account_number;
		public $beneficiary_name;
		public $remark;
		public $receipt;
		public $time_served;
		public $fee;

		public function __construct($db) {
			$this->conn = $db;
		}

		/**
		 * Read disbursement data from database
		 * 
		 * @return object Result from the query
		 */
		
		public function read() {
			$sql = 'SELECT * FROM ' . $this->table . ' WHERE transaction_id = ' . $this->transaction_id;

			$result = $this->conn->query($sql);
			return $result;
		}

		/**
		 * Insert new disbursement data to database
		 * 
		 * @return object Result from the query
		 */
		
		public function create() {
			$sql = 'INSERT INTO ' . $this->table . ' (transaction_id, amount, status, bank_code, account_number, beneficiary_name, remark, receipt, fee) VALUES (?,?,?,?,?,?,?,?,?)';

			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param(
				'iississsi',
				$this->transaction_id,
				$this->amount,
				$this->status,
				$this->bank_code,
				$this->account_number,
				$this->beneficiary_name,
				$this->remark,
				$this->receipt,
				$this->fee
			);

			$stmt->execute();
			$stmt->close();

			$latest_dsb = $this->read();
			$this->conn->close();

			return $latest_dsb;
		}

		/**
		 *	Update disbursement data
		 * 
		 * @return object Result from the query
		 */
		
		public function update() {
			$sql = 'UPDATE ' . $this->table . ' SET status = ?, receipt = ?, time_served = ? WHERE transaction_id = ?';

			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param(
				'sssi',
				$this->status,
				$this->receipt,
				$this->time_served,
				$this->transaction_id
			);

			$stmt->execute();
			$stmt->close();

			$updated_dsb = $this->read();
			$this->conn->close();

			return $updated_dsb;
		}
	}

?>