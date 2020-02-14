<?php

	class Disbursement {
		private $db_con;

		public $id;
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
			$this->db_con = $db;
		}

		public function read() {
			$sql = 'SELECT * FROM disbursements WHERE id = ' . $this->id;

			$result = $this->conn->query($sql);
			return $result;
		}

		public function create() {
			$sql = 'INSERT INTO disbursements (amount, status, bank_code, account_number, beneficiary_name, remark, receipt, fee) VALUES (';
			$sql .= $this->amount . ', ';
			$sql .= $this->status . ', ';
			$sql .= $this->bank_code . ', ';
			$sql .= $this->account_number . ', ';
			$sql .= $this->beneficiary_name . ', ';
			$sql .= $this->remark . ', ';
			$sql .= $this->receipt . ', ';
			$sql .= $this->fee . ')';

			$result = $this->conn->query($sql);

			$last_insert_id = (int)$this->conn->insert_id;
			$latest_dsb = $this->read($last_insert_id);
			$this->conn->close();

			return $latest_dsb;
		}

		public function update() {
			$sql = 'UPDATE disbursements SET status = ' . $this->status . ', receipt = ' . $this->receipt . ' WHERE id = ' . $this->id;

			$result = $this->conn->query($sql);

			$updated_dsb = $this->read($this->id);
			$this->conn->close();

			return $updated_dsb;
		}
	}

?>