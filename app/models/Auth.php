<?php 

//Authentication class (static)

class Auth{

    public static function authenticate($row){
        
        if(is_object($row)) $_SESSION['USER_DATA']=$row;
    }

    public static function logout(){
        
        if(!empty($_SESSION['USER_DATA'])){

            unset($_SESSION['USER_DATA']);

            // session_unset();
            // session_regenerate_id();
        }
    }


    //function to check whether user is logged in
    public static function logged_in(){

        //checking whether the session user data is set
        if(!empty($_SESSION['USER_DATA'])){
            return true;
        }
        return false;
    }

    //not sure abt this.. makingan instance of
    public static function is_admin(){
        if(!empty($_SESSION['USER_DATA'])){
            
            //creating an model instance to use database
            $modelInstance=new Model();
            //getting from databse admin which match with the userID in session and ordrr 
            //the data by adminID and select one from that (check getFirstCustom)
            $row = $modelInstance->getFirstCustom('admin',['userID'=>$_SESSION['USER_DATA']->userID],'adminID');
            

            //if not found, $row will be false
            if($row){
               return true;
            }else return false;
            
        }
        return false;
    }

    //if we call a function that doesnt exisit in this class, __call with catch that 
    // 1st parameter will be functon name and 2nd argument will be array of values that passed in that function
    public static function __callStatic($funcName,$values){
        
        // we weill usually pass a function start with 'get' (ex: getName). so we remove get and take the 
        // rest which is the thing w want to return
        // $key=str_replace("get","",strtolower($funcName));
        $key=str_replace("get","",$funcName);//removed lower casing , since my column names are mixed case

        if(!empty($_SESSION['USER_DATA']->$key)){
            return $_SESSION['USER_DATA']->$key;
        }

        return '';
    }

}