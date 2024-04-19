<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: *');
	header('Content-Type: application/json');
    include('functions.php');
    $data = json_decode(file_get_contents("php://input"));
    $ip = $_SERVER['REMOTE_ADDR'];
    $login = $data->login;
    $password = $data->password;
    $conn = connect();
    $sql = "SELECT * FROM auth WHERE ip = '$ip'";
    $result = mysqli_query($conn,$sql);
    $result_mass = mysqli_fetch_assoc($result);
    if($result_mass != Null){
        echo json_message(200,true,"$ip");
    }else{
        if(!$login || !$password){
            echo json_message('422',false,"Fields or one of field can not be empty");
        }else{
            $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
            $result = mysqli_query($conn,$sql);
            $result_mass = mysqli_fetch_assoc($result);
            if($result_mass == Null){
                echo json_message(403,false,"Login failed");
            }else{
                $sql = "INSERT INTO `auth`(`user`, `ip`) VALUES ('$login','$ip')";
                echo $sql;
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo json_message(200,true,"$ip");
                }
            }
        }
    }
?>