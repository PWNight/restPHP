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
                    $sql = "SELECT * FROM products WHERE id = $id";
                    $result = mysqli_query($conn,$sql);
                    $result_mass = mysqli_fetch_all($result);
                    if($result_mass == Null){
                        echo json_message(400,false,'No products :)');
                    }else{
                        foreach($result_mass as $value){
                            echo '<div class = "product">';
                            echo "<h1>$value[1]</h1>";
                            echo "<p>$value[2]</p>";
                            echo "<img src = '$value[3]'>";
                            echo "<form action = 'buyProduct.php' method='POST'><button name='id' value='$value[0]' type='submit'>Купить</button></form>";
                            echo '</div>';
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