<?php

//database class

class Database{

    private function connect(){
        try{
            $con = new PDO(DBDRIVER.":host=".SERVERNAME.";port=".PORT.";dbname=".DBNAME,DBUSER,DBPASS);
            return $con;
        } catch(PDOException $e){
            echo "Connection failed: " . $e -> getMessage();
        }

    } 

    //for example query will look like 'select * from users where email = ? and pass= ?'
    //or  'select * from users where email = :email and pass= :password'
    //this will be passed with an array of data corresponding to the places with '?'
    // ':email' this will substitue valuw iwith the key as 'email'
    //data can be empty too eg: select * from users
    //type is how the result from query should be given
    public function query($query,$data=[],$type='object'){

        $con=$this->connect();

        $stm=$con->prepare($query);
        //if db couldnt prepare statemtn, it wil return false
        //if it prepared statement successfully, it will return PDOstatement object
        if($stm){
            //check whether it executed correctly using $check
            $check = $stm->execute($data);
            if($check){
                if($type!='object'){
                    $type= PDO::FETCH_ASSOC;
                }else{
                    $type= PDO::FETCH_OBJ;
                }
                $result = $stm->fetchAll($type);

                // if there is no result it will result false or an empty array of obj or array of arrays               
                if(is_array($result) && count($result)>0){
                    return $result;
                }
            }
        }
        
        return false;// this will run when stm is false
    }

    public function create_tables(){
        $query="CREATE TABLE IF NOT EXISTS `users` (
            `userID` int NOT NULL AUTO_INCREMENT,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            PRIMARY KEY (`userID`),
            KEY `email` (`email`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
           
           ";
        $this->query($query);
    }
}