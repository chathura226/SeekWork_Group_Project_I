<?php
//main model class

class Model extends Database{

    protected $table="";

    //to insert into databse
    public function insert($data){

        //remove unwanted fields
        if(!empty($this->allowedColumns)){

            foreach($data as $key => $value){
                if(!in_array($key,$this->allowedColumns)){
                    unset($data[$key]);
                }
            }

        }

        $keys=array_keys($data);
        
        $query="INSERT INTO ".$this->table;
        $query.="(".implode(",",$keys).") values (:".implode(",:",$keys).")";
        
        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $this->query($query,$data);
        // show($query);
        // show($data);
    }

    //to check and get from databse 'where' as arry of objects
    public function where($data){
        
        $keys=array_keys($data);

        $query="SELECT * FROM ".$this->table." WHERE ";
        
        foreach($keys as $key){
            $query.=$key."=:".$key." && ";
        }

        //remove the additional '&&' 
        $query=trim($query,"&& ");
        
        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res=$this->query($query,$data);
        // show($query);
        // show($data);

        if(is_array($res)){
            return $res;
        }else return false;

    }

    //get all rows 
    public function getAll(){
        
        $query="SELECT * FROM ".$this->table;

        $res=$this->query($query);

        if(is_array($res)){
            return $res;
        }else return false;
    }
    //to check and get first record that find from databse (returns 1 object)
    public function first($data){

        $keys=array_keys($data);

        $query="SELECT * FROM ".$this->table." WHERE ";
        
        foreach($keys as $key){
            $query.=$key."=:".$key." && ";
        }

        //remove the additional '&&' 
        $query=trim($query,"&& ");
        $query.=" ORDER BY ".$this->primaryKey." DESC LIMIT 1"; //get the first latest record from 

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res=$this->query($query,$data);
        // show($query);
        // show($data);
        

        if(is_array($res)){
            return $res[0];//returning only first element of the array (an obj)
        }else return false;

    }

    //a custom function to get first record from a table which pass as a parameter
    public function getFirstCustom($table,$data,$orderByField=''){

        $keys=array_keys($data);

        $query="SELECT * FROM ".$table." WHERE ";
        
        foreach($keys as $key){
            $query.=$key."=:".$key." && ";
        }

        //remove the additional '&&' 
        $query=trim($query,"&& ");
        if($orderByField!=='')$query.=" ORDER BY ".$orderByField." DESC LIMIT 1"; //get the first latest record from  ordered by the given field

        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res=$this->query($query,$data);
        // show($query);
        // show($data);
        

        if(is_array($res)){
            return $res[0];//returning only first element of the array (an obj)
        }else return false;

    }

    //to check and get from databse 'where' as arry of objects for a given table
    public function customWhere($table,$data){

        $keys=array_keys($data);

        $query="SELECT * FROM ".$table." WHERE ";
        
        foreach($keys as $key){
            $query.=$key."=:".$key." && ";
        }

        //remove the additional '&&' 
        $query=trim($query,"&& ");
        
        //we can call query qithout creating new database instance since we inherit 
        // this class from database class
        $res=$this->query($query,$data);
        // show($query);
        // show($data);

        if(is_array($res)){
            return $res;
        }else return false;

    }


}