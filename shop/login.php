<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: *');
	header('Content-Type: application/json');
    include('functions.php');
    session_start();
    
    if(!isset($_SESSION['token'])){
        if(isset($_POST['login'],$_POST['password'])){
            $data = file_get_contents("php://input");
            $conn = connect();
            $login = $data['login'];
            $password = md5($data['password']);
            $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
            $result = mysqli_query($conn,$sql);
            $result_mass = mysqli_fetch_assoc($result);
            if($result_mass == Null){
                return json_message(400,false,"Login failed");
            }
            $token = md5($login);
            $_SESSION["token"] = $token;
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }
?>