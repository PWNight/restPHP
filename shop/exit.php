<?php
    include('function.php');
    session_start();
    if(isset($_SESSION['token'])){
        session_destroy();
        header('Location: index.php');
    }else{
        header('Location: login.php');
    }
?>