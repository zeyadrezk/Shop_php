<?php

namespace   core;

class Validations
{
    public function santzieInput($input){
        return trim(htmlentities(htmlspecialchars(stripslashes($input))));
    }

    public function checkInput($input){
        if(!empty($input)) {
            return true;}
        else { return false ;}
    }


    public function CheckLength($input , $minChars,$maxChars)
    {
        if(  $minChars <= strlen($input)  || strlen($input) <= $maxChars){
          return false ;
        }
        else  return true ;
    }


    public function EmailValidate($email){
        if(filter_var($email , FILTER_VALIDATE_EMAIL)) {
            return false ;
        }   else return true;
    }



    public function confirmVal($val1 , $val2){
        if ($val1 === $val2){
            return true;
        } return false ;
    }


}