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

            $mypdo = new PDO($string,DBUSER,DBPASS);

        }catch(PDOException $e){

        }

        
    }

}


$myclass = new Database();