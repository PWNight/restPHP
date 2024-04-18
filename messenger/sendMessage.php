<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: *');
	header('Content-Type: application/json');
    include('functions.php');
    $data = json_decode(file_get_contents("php://input"));
    $message = $data->message;
    $ip = $_SERVER['REMOTE_ADDR'];

    if(!isset($message)){
        echo json_message('422','false',"Message required");
    }else{
        $conn = connect();
        $sql = "SELECT * FROM auth WHERE ip = '$ip'";
        $result = mysqli_query($conn,$sql);
        $result_mass = mysqli_fetch_assoc($result);
        if($result_mass == Null){
            echo json_message('422','false',"No authorized");
        }else{
            $login = $result_mass['user'];
            $sql = "INSERT INTO `messages`(`from_u`, `content`) VALUES ('$login','$message')";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo json_message(200,true,"Success");
            }
        }
    }
?>