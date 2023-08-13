<?php
session_start();
require_once '../core/functions.php' ;
include '../core/validation.php';
include '../core/validations.php';
include '../data/database.php';
use data\database\DB;
use core\validations;

$DB = new DB();
$val = new Validations();
$errors =[];
$success=[] ;
if(checkRequestMethod('POST')&& $val->checkInput('email')){
    foreach($_POST as $key => $value){
        $$key = $val->santzieInput($value);
            }

    if(!$val->checkInput($email))
    {$errors [] = "Email is required";
    }elseif ($val->EmailValidate($email)){
        $errors [] = "Type a valid email " ;
    }
    if(!$val->checkInput($password))
    {$errors [] = "Password is required";}

    if(!empty($email)){
        $hashedPassword = sha1($password);
//      $sql="SELECT * FROM `users` WHERE `email` ='$email'and `password` ='$hashedPassword'";
        $DB->viewData("*","users", "`email`='$email' and `password`='$hashedPassword'");


            if(mysqli_affected_rows($DB->con)){

              $success = "Login Successfully";}else{
                $errors []= "email and password didnt match";
              }
                }
    if (!empty($errors)){
        $_SESSION['errors'] = $errors;
            redirect("../login.php");
        die ;
    }else {


       $row=$DB->viewData('*',"users","`email`='$email'");
            $id = $row['id'];
            $status = $row['priv_id'];
       $_SESSION['auth']= [$id ,$name , $email ,$status];
        $_SESSION['success'] = $success;

        redirect("../profile.php");
        die ;
    }


}
else
redirect("../login.php");