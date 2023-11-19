<?php

//Student class
class StudentModel extends Model {
    protected $table="student";
    protected $primaryKey='studentID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'firstName',
        'lastName',
        'qualifications',
        'description',
        'NIC',
        'address',
        'status',
        'verificationDocuments',
        'accountNo',
        'profilePic',
        'userID',
        'universityID',
    ];

     
    //student validate function is in user model for signup.....................

    //data validation for updte profile is in here
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
}