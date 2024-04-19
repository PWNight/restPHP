<html>
    <body>
        <?php
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Credentials: true");
            include('functions.php');
            session_start();
            
            //if(!isset($_SESSION['token'])){
                    $conn = connect();
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn,$sql);
                    $result_mass = mysqli_fetch_all($result);
                    if($result_mass == Null){
                        echo json_message(400,false,'No products :)');
                    }else{
                        foreach($result_mass as $value){
                            $id = (int)$value[0];
                            $sql = "SELECT amount FROM storage WHERE product_id = $id";
                            $result = mysqli_query($conn,$sql);
                            $mass = mysqli_fetch_assoc($result);
                            $amount = $mass['amount'];
                            
                            echo '<div class = "product">';
                            echo "<h1>$value[1]</h1>";
                            echo "<p>$value[2]</p>";
                            echo "<p>В наличии $amount шт.</p>";
                            echo "<img src = '$value[3]'>";
                            echo "<form action = 'product.php' method='POST'><button name='id' value='$value[0]' type='submit'>Подробнее</button></form>";
                            echo '</div>';
                        }
                    }
            //}else{
            //    header('Location: login.php');
            //}
        ?>
    </body>
</html>