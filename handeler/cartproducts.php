 <?php 
    include '../inc/header.php';  
    require_once "../data/migration.php";
    require_once "../core/functions.php";

    include '../inc/navbar.php';   
    include '../inc/footer.php'; 
    include '../data/conn.php'; 
include '../data/conn.php';


    include '../data/database.php';
    use  data\database\DB;

    $DB = new DB();
?>


<?php 
if (!empty($_GET['id'])){
 $user_id = $_GET['id'];
//  $row = $DB->viewData("*", "carts","`user_id` = '$user_id' and `status`='0'");

    //check if there is a cart
$query = "SELECT * FROM carts WHERE `user_id` = '$user_id' and `status`='0'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if (empty($row)){

  //create cart if didnt find cart
$query = " INSERT INTO carts(`id`,`status`) VALUES ( '0' ,'0' )";
$result = mysqli_query($conn, $query);
$query = " UPDATE  carts SET `id` = LAST_INSERT_ID() where `id` = '0' ";
$result = mysqli_query($conn, $query);
$query = " UPDATE  carts SET `user_id` ='$user_id' where `id` = LAST_INSERT_ID() ";
$result = mysqli_query($conn, $query);

// $DB->updateData("carts", ["user_id"=> "$user_id"],"id= LAST_INSERT_ID()");
// $query = "SELECT * FROM carts WHERE `user_id` = $user_id and `status` = '0' ";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);

$row = $DB->viewData("*", "carts","`user_id` = $user_id and `status` = '0'");
$cart_id = $row['id'];
}else{ // find cart
// $query = "SELECT * FROM carts WHERE `user_id` = $user_id and `status` = '0' ";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
$row = $DB->viewData("*", "carts","`user_id` = $user_id and `status` = '0'");
 $cart_id = $row['id'];}
 
//view cart products
$product_id =$_GET['product_id'] ;
$row = $DB->viewData("*", "cart_products"," `cart_id` = $cart_id and `product_id` = $product_id");
// $query = "SELECT * FROM `cart_products` WHERE `cart_id` = $cart_id and `product_id` = $product_id ";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_array($result);
if (empty($row)){
$query = " INSERT INTO  `cart_products` SET `cart_id` = $cart_id , `product_id` = $product_id , `quantity` = '1' ";
$result = mysqli_query($conn, $query);
// $DB->updateData("cart_products",["product_id"=>"$product_id", "quantity"=>"1",], "id = LAST_INSERT_ID()");
$row =$DB->viewData("*","products","`id` =  $product_id");
$DB->updateData("cart_products",["price"=>"$row[price]","total"=>"price`*`quantity"]," `cart_id` = $cart_id and `product_id` = $product_id");


}else {
  // $DB->updateData("cart_products",[ "quantity"=>"`quantity`+1",], "`cart_id` = $cart_id and `product_id` = $product_id");

  $query = " UPDATE  `cart_products` SET `quantity` = `quantity` + 1 where `cart_id` = $cart_id and `product_id` = $product_id ";
$result = mysqli_query($conn, $query);
   }
  
  $row=$DB->viewData("sum(`total`)","cart_products","`cart_id` = $cart_id ");
  $sum =$row["sum(`total`)"];
  $DB->updateData("carts",["total"=>"$sum"],"`id` = '$cart_id'");
  
  // $query = "SELECT * FROM `products` WHERE `id` =  $product_id ";
  // $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_array($result);
//   $query = " UPDATE  `cart_products` SET `price` = '$row[price]' where `cart_id` = $cart_id and `product_id` = $product_id ";
// $result = mysqli_query($conn, $query);
// $query = " UPDATE  `cart_products` SET `total` = `price` * `quantity` where `cart_id` = $cart_id and `product_id` = $product_id ";
// $result = mysqli_query($conn, $query);

// $query = " SELECT sum(`total`) from `cart_products` where `cart_id` = $cart_id  ";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_array($result);
// $query = " UPDATE  `carts` SET `total` = '$row[0]'  where `id` = '$cart_id'  ";
// $result = mysqli_query($conn, $query);

  redirect("../cart.php");
    die;
  }
?> 
