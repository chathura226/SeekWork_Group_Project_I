<?php

class Database
{
     
    private  $con;
    
    function __construct()
    {

       

    }

    private function connect()
    {
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