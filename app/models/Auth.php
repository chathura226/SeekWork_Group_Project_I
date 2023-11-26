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

    //check if the user is email verified
    public static function is_otp_verified(){
        
        if(!empty($_SESSION['USER_DATA'])){
            //if otp is not verified return false
            if(!$_SESSION['USER_DATA']->isOTPVerified){
                return false;
            }else return true;
            
        }
        return false;
    }


    public static function is_admin(){
        if(!empty($_SESSION['USER_DATA'])){
            
//            //creating an model instance to use database
//            $modelInstance=new Model();
//            //getting from databse admin which match with the userID in session and ordrr
//            //the data by adminID and select one from that (check getFirstCustom)
//            $row = $modelInstance->getFirstCustom('admin',['userID'=>$_SESSION['USER_DATA']->userID],'adminID');
//
//
//            //if not found, $row will be false

            $row=$_SESSION['USER_DATA']->role==='admin';
            if($row){
               return true;
            }else return false;
            
        }
        return false;
    }

    public static function is_moderator(){
        if(!empty($_SESSION['USER_DATA'])){
            
//            //creating an model instance to use database
//            $modelInstance=new Model();
//            //getting from databse admin which match with the userID in session and ordrr
//            //the data by adminID and select one from that (check getFirstCustom)
//            $row = $modelInstance->getFirstCustom('moderator',['userID'=>$_SESSION['USER_DATA']->userID],'moderatorID');
//
//
//            //if not found, $row will be false
            $row=$_SESSION['USER_DATA']->role==='moderator';

            if($row){
               return true;
            }else return false;
            
        }
        return false;
    }

    public static function is_student(){
        if(!empty($_SESSION['USER_DATA'])){
            
            //creating an model instance to use database
//            $modelInstance=new Model();
//            //getting from databse admin which match with the userID in session and ordrr
//            //the data by adminID and select one from that (check getFirstCustom)
//            $row = $modelInstance->getFirstCustom('student',['userID'=>$_SESSION['USER_DATA']->userID],'studentID');
//
//            //if not found, $row will be false
            $row=$_SESSION['USER_DATA']->role==='student';

            if($row){
               return true;
            }else return false;
            
        }
        return false;
    }

    public static function is_company(){
        if(!empty($_SESSION['USER_DATA'])){
            
//            //creating an model instance to use database
//            $modelInstance=new Model();
//            //getting from databse admin which match with the userID in session and ordrr
//            //the data by adminID and select one from that (check getFirstCustom)
//            $row = $modelInstance->getFirstCustom('company',['userID'=>$_SESSION['USER_DATA']->userID],'companyID');
//

            //if not found, $row will be false
            $row=$_SESSION['USER_DATA']->role==='company';

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


    //to update session after updating user data
    public static function updateSession(){
        if(!empty($_SESSION['USER_DATA'])){
            $user=new User();
            // $row=$user->first(['userID'=>Auth::getuserID()]);
            // $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");

            // //if user is a student put university details too
            // if($row->role==='student'){
            //     $universityDetails=$user->getFirstCustom('university',['universityID'=>$userDetails->universityID],"universityID");
            //     $combinedObject1= (object)array_merge((array)$userDetails, (array)$universityDetails);
            //     $combinedObject = (object)array_merge((array)$row, (array)$combinedObject1);
            // }else $combinedObject = (object)array_merge((array)$row, (array)$userDetails);

            $joiningTables=[Auth::getrole()];
            $joinConditions=["user.userID=".Auth::getrole()."."."userID"];
            //if user is a student put university details too
            if(Auth::getrole()==='student'){
                $joiningTables[]="university";
                $joinConditions[]="student.universityID=university.universityID";
            }
            //use innerjoin and take first element
            $combinedObject = $user->innerJoin($joiningTables,$joinConditions,['user.userID'=>Auth::getuserID()])[0];

            Auth::authenticate($combinedObject);
        }
    }
}


                    // $userDetails=$user->getFirstCustom($row->role,['userID'=>$row->userID],$row->role."ID");

                    // //if user is a student put university details too
                    // if($row->role==='student'){
                    //     $universityDetails=$user->getFirstCustom('university',['universityID'=>$userDetails->universityID],"universityID");
                    //     $combinedObject1= (object)array_merge((array)$userDetails, (array)$universityDetails);
                    //     $combinedObject = (object)array_merge((array)$row, (array)$combinedObject1);
                    // }else $combinedObject = (object)array_merge((array)$row, (array)$userDetails);


 