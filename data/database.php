<?php
namespace data\database;

class DB{
       public $con;
    public function __construct($dbn='shop',$db='localhost',$user='root',$password='')
    {
        $this->con = mysqli_connect($db,$user,$password, $dbn);
        if(empty($this->con)){
            echo mysqli_connect_error($this->con);
        }
    }

    public function  viewData($col="*",$table , $filter="true"){
        $query = "SELECT $col FROM `$table` WHERE $filter";
        $result = mysqli_query($this->con,$query);
        return mysqli_fetch_assoc($result);
    }
    public function  viewAllData($col="*",$table , $filter="true"){
        $query = "SELECT $col FROM `$table` WHERE $filter";
        $result = mysqli_query($this->con,$query);
        return mysqli_fetch_all($result , MYSQLI_ASSOC);
    }
    public function  insertData($table , array $values ){
        $pattern = '/([^,]+)/';
        $replace_cols = '`$1`';
        $replace_vals = "'$1'";
        $cols=preg_replace($pattern , $replace_cols,implode(",",array_keys($values)));
        $vals=preg_replace($pattern , $replace_vals,implode(",",array_values($values)));
        $query = "INSERT INTO `$table`($cols)VALUES($vals)  ";
        $result = mysqli_query($this->con,$query);
        if($result){
            return true ;
        }
        return false ;
    }

    public function updateData($tabel ,array $data , $filter=true ){

        foreach ($data as $key => $val){
            $x[] = "`$key`= '$val'";
        }
            $vals = implode(" , " , $x);
        $query= "UPDATE `$tabel` SET $vals WHERE $filter";
         mysqli_query($this->con,$query);
    }

    public function deleteData($table , $filter ){
        $query = "DELETE  FROM `$table` WHERE  $filter";
                     mysqli_query($this->con,$query);

    }



    public  function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysqli_close($this->con);
    }


}