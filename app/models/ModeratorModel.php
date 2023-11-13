<?php

//Moderator class
class ModeratorModel extends Model {
    protected $table="moderator";
    protected $primaryKey='moderatorID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'moderatorID',
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