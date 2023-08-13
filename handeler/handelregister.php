<?php
session_start();
require_once '../core/functions.php' ;
//require_once '../core/validation.php';
include '../core/validations.php';
include  '../data/database.php';
use data\database\DB;
use core\validations;


$DB = new DB();

$val = new Validations();
$errors = [];
if($val->checkInput("POST") && $val->checkInput('name')){
    foreach($_POST as $key => $value){
        $$key = $val->santzieInput($value);
    }


 //name validation required => min:3 , max:15
if(!$val->checkInput($name))
{$errors [] = "name is required";
}elseif ($val->CheckLength($name,3,15)){
    $errors [] = "Name must be between 3 and 15 chars";
}

// email validation required , email
if(!$val->checkInput($email))
{$errors [] = "Email is required";
}elseif ($val->EmailValidate($email)){
    $errors [] = "Type a valid email " ;
}
$rows =$DB->viewData("email","users");
foreach ($rows as $row){
    if($row == $email){
       $errors[] = "email is exists";
       continue;
    }
}

// password required ,  min:6 , max:20
if(!$val->checkInput($password))
{$errors [] = "Password is required";
}elseif ($val->CheckLength($password , 6,20)){
    $errors [] = "Password must be between 6 and 20 chars";
}


if(!$val->checkInput($confirm_password))
{$errors [] = "Confirm password is required";
}elseif (! $val->confirmVal($password , $confirm_password)){
    $errors [] = "Confirm password must be identical to password";
}




if (empty($errors)){
    $store =[];
    foreach($_POST as $key =>$value){
        if($key == "password"||$key == "confirm_password"){
            $store[$key]= sha1($value);
            $hashed= sha1($value);
        }else {
            $store[$key]= $value;
            
        }
    }

//    $conn = mysqli_connect($db= "localhost",$user ="root",$password="", $dbn="shop");
//    if(empty($conn)){
//        echo mysqli_connect_error($conn);
//    }
////    $sql="INSERT INTO `users`(`name`,`email`,`password` ) values('$store[name]','$store[email]','$store[password]')";
//    $result = mysqli_query($conn , $sql);
//    $query = "SELECT * FROM `users` where `email` ='$store[email]'";
//    $result = mysqli_query($conn, $query);
//    $row = mysqli_fetch_array($result);


     $DB->insertData("users",["name"=>"$store[name]","email"=>"$store[email]","password"=>"$store[password]"]);
    $row = $DB->viewData("*","users","`email`= '$store[email]' ");
        $id = $row['id'];
        $status = $row['priv_id'];
   $_SESSION['success'] = "data has been successfully added";
   $_SESSION['auth']= [$id ,$name , $email , $status];
   redirect("../index.php");
   die;
}else{
    $_SESSION['errors']= $errors ;
    redirect('../register.php');
    die;
}

}
?>