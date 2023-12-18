<?php

class Database
{
     
    private  $con;
    
    function __construct()
    {

        $this->con = $this->connect();

       

    }

    //connect to db

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

    public function write($query,$data_array = [])
    {
        $con = $this->connect();

        $statement = $con ->prepare($query);



        foreach($data_array as $key => $value )
        {
            $statement->bindparam(':'.$key,$value); 
        }

        
        $check = $statement->execute();

        if($check)
        {
            return true;
        }

        return false;


    }


}


$myclass = new Database();


