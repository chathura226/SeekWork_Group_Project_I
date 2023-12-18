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

    public function write($query,$data)
    {
        $con = $this->connect();

        $statement = $con ->prepare($query);

        "select * from user where id =  $id ";

        "select * from user where id =  :id && name = :name ";

        $statement->bindparam('id',$id);
        $statement->bindparam('name',$name);
        $statement->execute();


    }


}


$myclass = new Database();


