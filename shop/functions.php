<?
	/*
	{
    "email": "admin@admin.ru",
    "password": "Qa1"
	}
	*/
	function connect(){
		$conn = mysqli_connect('127.0.0.1','root','','shop');
		return $conn;
	}
	function json_message($status, $success, $message) {
		$response = array(
			'status' => (int)$status,
			'content-Type' => 'application/json',
			'body' => array(
				'success' => (bool)$success,
				'message' => $message
			)
		);
		return json_encode($response,1);
	}
?>