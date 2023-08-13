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
 $user_id = $_GET['id'];
$query = "SELECT * FROM carts WHERE `user_id` = '$user_id' and `status`='0'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if (empty($row)){
$query = " INSERT INTO carts(`id`,`status`) VALUES ( '0' ,'0' )";
$result = mysqli_query($conn, $query);
$query = " UPDATE  carts SET `id` = LAST_INSERT_ID() where `id` = '0'  ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  carts SET `user_id` ='$user_id' where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);
$query = "SELECT * FROM carts WHERE `user_id` = $user_id and `status` = '0' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$cart_id = $row['id'];
}else{
$query = "SELECT * FROM carts WHERE `user_id` = $user_id and `status` = '0' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
 $cart_id = $row['id'];}
 
//insert products
$product_id =$_GET['product_id'] ;
$query = "SELECT * FROM `cart_products` WHERE `cart_id` = $cart_id and `product_id` = $product_id ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if (empty($row)){
$query = " INSERT INTO `cart_products`(`id`) VALUES ( '0' )";
$result = mysqli_query($conn, $query);
$query = " UPDATE  `cart_products` SET `id` = LAST_INSERT_ID() where `id` = '0'  ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  `cart_products` SET `cart_id` = $cart_id where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  `cart_products` SET `product_id` = $product_id where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  `cart_products` SET `quantity` = '1' where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);



}else {
  $query = " UPDATE  `cart_products` SET `quantity` = `quantity` + 1 where `cart_id` = $cart_id and `product_id` = $product_id ";
$result = mysqli_query($conn, $query);
   }
  }
  $query = "SELECT * FROM `products` WHERE `id` =  $product_id ";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $query = " UPDATE  `cart_products` SET `price` = '$row[price]' where `cart_id` = $cart_id and `product_id` = $product_id ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  `cart_products` SET `total` = `price` * `quantity` where `cart_id` = $cart_id and `product_id` = $product_id ";
$result = mysqli_query($conn, $query);

$query = " SELECT sum(`total`) from `cart_products` where `cart_id` = $cart_id  ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$query = " UPDATE  `carts` SET `total` = '$row[0]'  where `id` = '$cart_id'  ";
$result = mysqli_query($conn, $query);

  redirect("../cart.php");
  die;
?>
