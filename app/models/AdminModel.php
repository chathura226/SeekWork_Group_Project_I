<?php

//Admin class
class AdminModel extends Model {
    protected $table="admin";
    protected $primaryKey='adminID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'adminID',
        'firstName',
        'lastName',
        'address',
        'profilePic',
        'userID',
    ];


     //if all goes well, return true, else false
     public function validate($data){
        $this->errors=[];

         


        if(empty($data['firstName'])){
            $this->errors['firstName']="First Name is required!";
        }else if(!preg_match("/^[a-zA-Z]+$/",trim($data['firstName']))){//checking for numbers
            $this->errors['firstName']="First Name can only contain letters without spaces!";
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }else if(!preg_match("/^[a-zA-Z]+$/",trim($data['lastName']))){//checking for numbers
            $this->errors['lastName']="Last Name can only contain letters without spaces!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
        }
        

        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }

    //validation before deltions
    public function deletionValidation(){
       return true;
    }
}