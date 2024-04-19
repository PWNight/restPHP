<?
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    include('functions.php');
    session_start();
    if(!isset($_SESSION['token'])){
        if(isset($_POST['login'],$_POST['password'])){
            $conn = connect();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
            $result = mysqli_query($conn,$sql);
            $result_mass = mysqli_fetch_assoc($result);
            if($result_mass == Null){
                echo json_message(400,false,"Login failed");
            }else{
                $token = md5($login);
                $_SESSION["token"] = $token;
                header('Location: index.php');
            }
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