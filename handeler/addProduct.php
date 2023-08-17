<?php
session_start();
require_once '../core/functions.php' ;
require_once '../core/validation.php';
require '../core/validations.php';
require '../data/database.php';
use core\Validations;
use data\database\DB;

$val = new Validations();
$DB = new DB();

$errors = [];
if(checkRequestMethod("POST") && $val->checkInput('name')){

   

    foreach($_POST as $key => $value){
        $$key = $val->santzieInput($value);
    }
 //name validation required => min:3 , max:15
if(!$val->checkInput($name))
{$errors [] = "name is required";
}elseif ($val->CheckLength($name , 2 , 15)){
    $errors [] = "Name must be between 2 and 15 chars";
}

// price validation required 
if(!$val->checkInput($price) || $price == 0)
{$errors [] = "price is required";
}elseif ($val->CheckLength($price , 0 , 8)){
    $errors [] = "price must be between 0 and 8 chars";
}

// category required ,  min:3 , max:20
if(!$val->checkInput($category))
{$errors [] = "category is required";
}elseif ($val->CheckLength($category , 3 , 20)){
    $errors [] = "category must be between 3 and 20 chars";
}

if( !$val->checkInput($quantity) || $quantity == 0)
{$errors [] = "quantity is required";
}elseif ($val->CheckLength($quantitiy , 0 , 8)){
    $errors [] = "quantity must be between 0 and 8 chars";
}



if(!$val->checkInput($description))
{$errors [] = "description is required";
}elseif ($val->CheckLength($description , 6 , 50)){
    $errors [] = "description must be between 6 and 50 chars";
}

if($_FILES['img']['size'] == 0){
    $errors [] ="image not found!";

}else{
    $nameImage =$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/". $_FILES['img']['name']);
  }

  


if (empty($errors)){
    $store =[];
    foreach($_POST as $key =>$value){
            $store[$key]= $value;
    }
    // $conn = mysqli_connect("localhost","root","","shop");
    //         if(!$conn){
    //              echo mysqli_connect_error($conn);
    //                 }
    // $sql="INSERT INTO `products`(`name`,`price`,`description`,`quantity`,`image` ) values('$store[name]','$store[price]','$store[description]','$store[quantity]','$nameImage' )";
    // $result = mysqli_query($conn , $sql);


    $DB->insertData("products",["name"=>"$store[name]","price"=>"$store[price]","description"=>"$store[description]","quantity"=>"$store[quantity]","image"=>"$nameImage"]);


   $_SESSION['success'] = "product has been successfully added";
   redirect("../StoreProduct.php");
   die;
}else{
    $_SESSION['errors']= $errors ;
    redirect('../StoreProduct.php');
    die;
}

}
?>