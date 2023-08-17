<?php 

// lsa t3dylat database
        include '../inc/header.php';  
        require_once "../data/migration.php";
        require_once "../core/functions.php";

        include '../inc/navbar.php';   
        include '../inc/footer.php'; 
        include '../data/conn.php'; 
        include  '../data/database.php';
use data\database\DB;


$DB = new DB();


?>

<?php
if (!empty($_GET['id'])){
    $user_id = $_SESSION['auth']['0'] ;  
    $cart_id = $_GET['id'];
    // crating order 
    //    $query = "SELECT * FROM orders WHERE `user_id` = '$user_id' and `status`='0'";
    //    $result = mysqli_query($conn, $query);
    //    $row = mysqli_fetch_array($result);
    $row = $DB->viewData("*","orders","`user_id` = '$user_id' and `status`='0'");
    if (empty($row)){
    $query = " INSERT INTO orders(`status`) VALUES ( '0' )";
    $result = mysqli_query($conn, $query);
    // $query = " UPDATE  orders SET `id` = LAST_INSERT_ID() where `id` = '0'  ";
    // $result = mysqli_query($conn, $query);
    $query = " UPDATE  orders SET `user_id` ='$user_id' ,`order_date` = NOW() , `order_code`=rand() where `id` = LAST_INSERT_ID() ";
    $result = mysqli_query($conn, $query);
    // $query = " SELECT  * FROM `carts` WHERE `id` = '$cart_id' ";
    // $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    
    // $query = " UPDATE  orders SET total = $row[total]  WHERE  user_id = $user_id and `status` = '0' ";
    // $result = mysqli_query($conn, $query);
    // $query = " SELECT  * FROM `orders` WHERE `user_id` = '$user_id' ";
    // $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    // $DB->insertData("orders",["id"=>0,"status"=>0]);
    // $DB->updateData("orders",["user_id" =>"$user_id" ,"order_date"=> NOW(), "order_code"=> rand() , "id" => LAST_INSERT_ID()]);
    $row = $DB->viewData("*","carts","`id` = '$cart_id'");
    $DB->updateData("orders",["total"=> "$row[total] "], "user_id = $user_id and `status` = '0'");
    $row = $DB->viewData("*","orders","`user_id` = '$user_id'");
    $order_id = $row['id'];
}else{
    // $query = " SELECT  * FROM `carts` WHERE `id` = '$cart_id' ";
    // $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    // $query = " UPDATE  orders SET total = $row[total]  WHERE  user_id = $user_id and `status` = '0' ";
    // $result = mysqli_query($conn, $query);
    // $query = " SELECT  * FROM `orders` WHERE `user_id` = '$user_id' ";
    // $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    
    $row = $DB->viewData("*","carts","`id` = '$cart_id'");
    $DB->updateData("orders",["total" => "$row[total]"], "`user_id` = '$user_id' and `status` = '0'");
    $row = $DB->viewData("*","orders","`user_id` = '$user_id'");
    $order_id = $row['id'];

     }

          // order products

    //  $query = "SELECT * FROM order_products WHERE `order_id` = '$order_id' ";
    //  $result = mysqli_query($conn, $query);
    //  $row = mysqli_fetch_array($result);  

     $rows = $DB->viewData("*","order_products","`order_id` = '$order_id'");
     if (empty($row)){
        $DB->deleteData("order_products","order_id=$order_id");
        $row = $DB->viewData("*","cart_products","cart_id =$cart_id");
        // $DB->insertData("order_products",["product_id"=>"$row[product_id]","quantity"=>"$row[quantity]"])
        $query = " INSERT INTO  order_products(product_id , quantity , total ,order_id) SELECT  product_id , quantity , total ,$order_id FROM cart_products WHERE cart_id =$cart_id and product_id ";
        $result = mysqli_query($conn, $query);

        }else{
            
            // $row = $DB->viewData("*","cart_products","cart_id =$cart_id ");
            $query = " SELECT * FROM `cart_products` WHERE cart_id =$cart_id  ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $DB->deleteData("order_products","order_id=$order_id");
            $query = " INSERT INTO  order_products(product_id , quantity , total ,order_id) SELECT  product_id , quantity , total ,$order_id FROM cart_products WHERE cart_id =$cart_id  ";
            $result = mysqli_query($conn, $query);
    
            // $DB->updateData("order_products",["product_id" =>"$row[product_id]","quantity" =>"$row[quantity]","total" => "$row[total]"],"product_id=$row[product_id]" );
            $query = " UPDATE  order_products SET product_id =$row[product_id] , quantity =$row[quantity] , total = $row[total] WHERE product_id=$row[product_id]  ";
            $result = mysqli_query($conn, $query);

    
        }
    
      $_SESSION['order_id']=$order_id ;
        redirect("../order.php");
        die;
    



        
}else{
        redirect("../cart.php");
        die;

}

