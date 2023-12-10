<?php

class Database
{
     
    private  $con;
    
    function __construct()
    {

        $this->con = $this->connect();

       

    }

    private function connect()
    {

        $string = "mysql:host=localhost;mychat_db";

        try
        {

            $connection = new PDO($string,DBUSER,DBPASS);
            return $connection;

        }catch(PDOException $e){

            echo $e->getMessage();
            die;

        }

        return false;

        
    }

}


$myclass = new Database();