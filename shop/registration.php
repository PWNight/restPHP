<?php
    include('function.php');
    session_start();
    
    if(!isset($_SESSION['token'])){
        if(isset($_POST['login'],$_POST['password'])){
            $conn = connect();
            $login = $_POST['login'];
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
            $result = mysqli_query($conn,$sql);
            $result_mass = mysqli_fetch_assoc($result);
            var_dump($result_mass);
            /*if($result_mass != None){
                return message(400,false,'Account already registred')
            }*/
            //TODO: Добавить поля role, nickname, created_at
            $sql = "INSERT INTO users(login, password) VALUES('$login','$password')";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                return json_message(400,false,'SQL error');
            }
            $token = md5($login);
            $_SESSION["token"] = $token;
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }
?>