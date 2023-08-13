<?php
$db= "localhost";
$user ="root" ;
$password = "";
$dbn = "shop";
 

$conn = mysqli_connect($db,$user,$password);
if(empty($conn)){
    echo mysqli_connect_error($conn);
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbn";   
mysqli_query($conn , $sql);

$conn = mysqli_connect($db,$user,$password, $dbn);
if(empty($conn)){
    echo mysqli_connect_error($conn);
}
$sql = "CREATE TABLE IF NOT EXISTS priv(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(50) 
)";   
mysqli_query($conn , $sql);

$sql = "CREATE TABLE IF NOT EXISTS users(
        `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(50) NOT NULL ,
        `email` VARCHAR(255) NOT NULL ,
        `password` VARCHAR(255) NOT NULL ,
        `address` VARCHAR(255) ,
        `phone` VARCHAR(255) NOT NULL ,
        `priv_id` BIGINT ,
        FOREIGN KEY (priv_id) REFERENCES priv(id)

    )";   
mysqli_query($conn , $sql);

// $sql = "CREATE TABLE IF NOT EXISTS categories(
//     `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
//     `name` VARCHAR(50) NOT NULL 
// )";   
// mysqli_query($conn , $sql);

$sql = "CREATE TABLE IF NOT EXISTS products(
        `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(50) NOT NULL ,
        `price` INT NOT NULL ,
        `description` VARCHAR(255)  ,
        `quantity` BIGINT ,
        `image` varchar(255) ,
        `discount` BIGINT ,
        `category_id` BIGINT 
        /* FOREIGN KEY (category_id) REFERENCES categories(id) */
)";   
mysqli_query($conn , $sql);


$sql = "CREATE TABLE IF NOT EXISTS carts(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT ,
    `total` BIGINT ,
    `status` boolean,
    FOREIGN KEY (user_id) REFERENCES users(id) 

)";   
mysqli_query($conn , $sql);

$sql = "CREATE TABLE IF NOT EXISTS cart_products(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `cart_id` BIGINT ,
    `product_id` BIGINT ,
    `quantity` BIGINT ,
    `price` BIGINT,
    `total` BIGINT,
    FOREIGN KEY (cart_id) REFERENCES carts(id) ,
    FOREIGN KEY (product_id) REFERENCES products(id) 

)";   
mysqli_query($conn , $sql);


$sql = "CREATE TABLE IF NOT EXISTS orders(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT ,
    `order_code` VARCHAR(255) ,
    `address` VARCHAR(255) ,
    `status` INT  ,
    `order_date` DATE  ,
    `total` BIGINT ,
    FOREIGN KEY (user_id) REFERENCES users(id) 
)";   
mysqli_query($conn , $sql);

$sql = "CREATE TABLE IF NOT EXISTS order_products(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `product_id` BIGINT ,
    `order_id` BIGINT  ,
    `quantity` BIGINT  ,
    `total` BIGINT ,
    FOREIGN KEY (product_id) REFERENCES products(id) ,
    FOREIGN KEY (order_id) REFERENCES orders(id) 
)";   
mysqli_query($conn , $sql);





mysqli_close($conn);


