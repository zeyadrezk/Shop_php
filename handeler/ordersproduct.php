<?php   include '../inc/header.php';  
require_once "../data/migration.php";
require_once "../core/functions.php";
?>
<?php   include '../inc/navbar.php';   ?>
<?php   include '../inc/footer.php'; ?>
<?php include '../data/conn.php'; 
?>

<?php
if (!empty($_GET['id'])){
    $user_id = $_SESSION['auth']['0'] ;  
    $cart_id = $_GET['id'];
    // crating order 
   $query = "SELECT * FROM orders WHERE `user_id` = '$user_id' and `status`='0'";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_array($result);
if (empty($row)){
$query = " INSERT INTO orders(`id`,`status`) VALUES ( '0' ,'0' )";
$result = mysqli_query($conn, $query);
$query = " UPDATE  orders SET `id` = LAST_INSERT_ID() where `id` = '0'  ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  orders SET `user_id` ='$user_id' ,`order_date` = NOW() , `order_code`=rand() where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);
$query = " SELECT  * FROM `carts` WHERE `id` = '$cart_id' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$query = " UPDATE  orders SET total = $row[total]  WHERE  user_id = $user_id and `status` = '0' ";
$result = mysqli_query($conn, $query);
$query = " SELECT  * FROM `orders` WHERE `user_id` = '$user_id' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$order_id = $row['id'];
}else{
    $query = " SELECT  * FROM `carts` WHERE `id` = '$cart_id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $query = " UPDATE  orders SET total = $row[total]  WHERE  user_id = $user_id and `status` = '0' ";
    $result = mysqli_query($conn, $query);
    $query = " SELECT  * FROM `orders` WHERE `user_id` = '$user_id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $order_id = $row['id'];

     }

     // order products
     $query = "SELECT * FROM order_products WHERE `order_id` = '$order_id' ";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);  
     if (empty($row)){
        $query = " INSERT INTO  order_products(product_id , quantity , total ,order_id) SELECT  product_id , quantity , total ,$order_id FROM cart_products WHERE cart_id =$cart_id  ";
        $result = mysqli_query($conn, $query);

        }else{
            

            $query = " SELECT * FROM `cart_products` WHERE cart_id =$cart_id  ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $query = " UPDATE  order_products SET product_id =$row[product_id] , quantity =$row[quantity] , total = $row[total] WHERE product_id=$row[product_id]  ";
            $result = mysqli_query($conn, $query);

    
        }

        $_SESSION['order_id']=$order_id ;
        redirect("../order.php");
        die;
    




}

redirect("../cart.php");
die;
