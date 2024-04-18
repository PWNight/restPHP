<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: *');
	header('Content-Type: application/json');
    include('functions.php');

    $ip = $_SERVER['REMOTE_ADDR'];
    $conn = connect();
    $sql = "SELECT * FROM auth WHERE ip = '$ip'";
    $result = mysqli_query($conn,$sql);
    $result_mass = mysqli_fetch_assoc($result);
    if($result_mass == Null){
        echo json_message('422','false',"No authorized");
    }else{
        $sql = "SELECT from_u, content, created_at FROM messages";
        $result = mysqli_query($conn,$sql);
        $result_mass = mysqli_fetch_all($result);
        $result_mass = json_encode($result_mass,1);
        echo json_message(200,true,"$result_mass");
    }
?>