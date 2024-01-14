<?php

class Database
{
    private $con;


    public function __construct()
    {
        $this->con=$this->connect();
    }

    private function connect()
    {
        $string=DBDRIVER.":host=".SERVERNAME.";port=".PORT.";dbname=".DBNAME;
        try {
            $connection = new PDO($string,DBUSER,DBPASS);
            return $connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }

    }

    //write to db
    public function write($query,$data_array=[])
    {

        $statement=$this->con->prepare($query);

        $check=$statement->execute($data_array);

        if($check){
            return true;
        }else{
            return false;
        }
    }

    //read from databse
    public function read($query,$data_array=[])
    {

        $statement=$this->con->prepare($query);

        $check=$statement->execute($data_array);

        if($check){
            $result=$statement->fetchAll(PDO::FETCH_OBJ);//fetching as an object
            if(is_array($result) && count($result)>0){
                return $result;
            }
            return false;
        }else{
            return false;
        }
    }


    //get user info
    public function get_user($userID)
    {
        $query="SELECT * FROM user WHERE userID=:userID limit 1";
        $data_array['userID']=$userID;
        $statement=$this->con->prepare($query);

        $check=$statement->execute($data_array);

        if($check){
            $result=$statement->fetchAll(PDO::FETCH_OBJ);//fetching as an object
            if(is_array($result) && count($result)>0){
                return $result[0];//return the first index
            }
            return false;
        }else{
            return false;
        }
    }

    public function generateID()
    {
        $uniqueId = uniqid();
        $numericId = hexdec(str_replace(".", "", $uniqueId));

//        $rand="";
//        $rand_count=rand(4,$max);
//        for($i=0;$i<$rand_count;$i++){
//            $r=rand(0,9);
//            $rand.=$r;
//        }
        return $numericId;
    }
}