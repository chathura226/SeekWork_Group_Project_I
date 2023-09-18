<?php

//user class
class User extends Model {
    protected $table="user";
    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'email', 
        'password', 
        'contactNo',
        'role',
    ];

     
    //if all goes well, return true, else false
    public function validate($data){
        $this->errors=[];

        //check email
        $query="select * from user where email=:email limit 1";
        
        if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email']="The email is not valid!";
        }else if($this->where(['email'=>$data['email']])){
            $this->errors['email']="Email already exists!";

        }

        if(empty($data['contactNo'])){
            $this->errors['contactNo']="A mobile number is required!";
        }
        if(empty($data['password'])){
            $this->errors['password']="A password is required!";
        }
        if($data['password'] !== $data['rePassword']){
            $this->errors['rePassword']="Passwords do not match!";
        }
        

        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }

    
    
}