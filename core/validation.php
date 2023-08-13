<?php
function requireVal($input){
    
    if(empty($input)) {
        return false;}
        return true ;
}
function minVal($input,$length){
    
    if(strlen($input)< $length) {return true ;
    } return false ;
}

function maxVal($input,$length){
    
    if(strlen($input)> $length) {return true ;
    } return false ; 
}

function emailVal($email){
    
    if(filter_var($email , FILTER_VALIDATE_EMAIL)) {return true ;
    } return false ; 
}


function confirmVal($password , $confirm_password){
    if ($password === $confirm_password){
        return true;
    }return false ;
}