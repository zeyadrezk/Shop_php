<?php
$db= "localhost";
$user ="root" ;
$password = "";
$dbn = "shop";


$conn = mysqli_connect($db,$user,$password, $dbn);
if(empty($conn)){
    echo mysqli_connect_error($conn);
}






?>