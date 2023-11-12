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
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
        }
        

        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }
}