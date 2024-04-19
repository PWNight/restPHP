<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    include('functions.php');
    session_start();
    
    if(!isset($_SESSION['token'])){
        if(isset($_POST['login'],$_POST['password'],$_POST['nickname'])){
            $conn = connect();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $nickname = $_POST['nickname'];
            $sql = "SELECT * FROM users WHERE login = '$login'";
            $result = mysqli_query($conn,$sql);
            $result_mass = mysqli_fetch_assoc($result);
            var_dump($result_mass);
            if($result_mass != Null){
                echo json_message(400,false,'Account already registred');
            }
            $sql = "INSERT INTO users(login, password, nickname) VALUES('$login','$password','$nickname')";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                echo json_message(400,false,'SQL error');
            }
            $token = md5($login);
            $_SESSION["token"] = $token;
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }
?>
<html>
    <body>
        <p>rgrgr</p>
    </body>
</html>