<html>
    <body>
        <?php
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Credentials: true");
            include('functions.php');
            session_start();
            
            //if(!isset($_SESSION['token'])){
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    $conn = connect();
                    $sql = "SELECT amount FROM storage WHERE product_id = $id";
                    $result = mysqli_query($conn,$sql);
                    $result_mass = mysqli_fetch_assoc($result);
                    if($result_mass == Null){
                        echo json_message(400,false,'No product :)');
                    }else{
                        $amount = $result_mass['amount'];
                        if($amount != 0){
                            $newAmount = $amount - 1;
                            $sql = "UPDATE storage set amount = $newAmount WHERE product_id = $id";
                            $result = mysqli_query($conn,$sql);
                            if($result){
                                header('Location: products.php');
                            }else{
                                echo json_message(400,false,'SQL error :)');
                            }
                        }else{
                            echo json_message(400,false,'Product unavailable :)');
                        }
                    }
                }else{
                    header('Location: products.php');
                }
            //}else{
            //    header('Location: login.php');
            //}
        ?>
    </body>
</html>