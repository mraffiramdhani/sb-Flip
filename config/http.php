<?php

	include_once 'config.php';

	class Http {

		private $config;

		public function __construct(){
			$this->config = new Config();
		}

		/**
		 * Wrap HTTP Request Response or any other data into an array ready to be encoded into json.
		 * 
		 * @param  String $status Indicate status of the request
		 * @param  String $message Custom message to be shown
		 * @param  array $data The data to be shown
		 * @return array Array of data
		 */
		
		public function response(String $status, String $message, $data = array()) {
			return array(
				"status" => $status,
				"message" => $message,
				"data" => $data
			);
		}

		/**
		 * Wrap HTTP Request from the given data
		 * 
		 * @param  String $endpoint Indicate the designated endpoint
		 * @param  String $method Indicate the method used in the HTTP Request
		 * @param  array $data The data to be sended with the HTTP Request
		 * @return String Response from HTTP Request
		 */
		
		public function request(String $endpoint, String $method, $data = array()) {
			$url = $this->config->API_URI . $endpoint;
			$auth = base64_encode($this->config->SECRET_KEY . ':');

			$options = array(
				"http" => array(
					"method" => $method,
					"content" => http_build_query($data),
					"header" => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Basic $auth\r\n"
				)
			);

			$context = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			return $result;
		}
	}

?>