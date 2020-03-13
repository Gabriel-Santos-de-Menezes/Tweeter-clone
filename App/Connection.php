<?php

namespace App;

class Connection{

    public static function getDb(){
        try{
            $conn = new \PDO(//usar a barra para indicar que é a raiz do php
                "mysql:host=localhost;dbname=twitter_clone;charset=utf8",
                "root",
                ""  
            );
            return $conn;
        }catch(\PDOException $e ){
            //..Tratar de alguma forma
        }
    }
}

?>