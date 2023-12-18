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

        try
        {
            $con = $this->connect();

            $statement = $con ->prepare($query);



            foreach($data_array as $key => $value )
            {
                $statement->bindparam(':'.$key,$value); 
            }

        
            $check = $statement->execute();

        }catch(PDOException $e){

            echo $e->getMessage();

        }
    

        if($check)
        {
            return true;
        }

        return false;


    }

    public function generate_id($max)
    {

        $rand = "";
        $rand_count = rand(4,$max);

        for ($i=0;$i<$rand_count;$i++){

            $r = rand(0,9);

            $rand .= $r;

        }

        return $rand;
    }


}





