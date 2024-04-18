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
    function json_message($status,$success,$message){
        $responce = ['Status' =>$status, 'Content-Type' => 'application/json',
        'Body' => ['success'=>$success,'message'=>$message]
        ];
        $responce = json_encode($responce,1);
        return $responce;
    }
	function addfile($FILES){
		$file_id = uniqid();
		$file_name = './disc/'.$FILES["filename"]["name"];
		move_uploaded_file($FILES["filename"]["tmp_name"], $file_name);
		
		$responce = ['Status' =>200, 'Content-Type' => 'application/json',
			'Body' => ['success'=>true,'message'=>'Succsess','name'=>$FILES["filename"]["name"],'url'=>'24gr13.rpm.ru/files/disc/'.$file_id,'file_id'=>$file_id]
		];
		$responce = json_encode($responce,1);
				
		return $responce;
	}
?>