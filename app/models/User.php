<?php

//user class
class User extends Model {
    protected $table="user";
    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'userID',
        'email', 
        'password', 
        'contactNo',
        'role',
        'status',
    ];
    protected $primaryKey='userID';
     
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


    
    //if all goes well, return true, else false
    public function validateStudent($data){
        $this->errors=[];

        //check email
        $query="select * from user where email=:email limit 1";
        
        if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email']="The email is not valid!";
        }else if($this->where(['email'=>$data['email']])){
            $this->errors['email']="Email already exists!";

        }
        if(empty($data['firstName'])){
            $this->errors['firstName']="First Name is required!";
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
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
        
        $nic = $data['NIC'];

        // Check if it's either 12 digits or 9 digits followed by 'v'
        if (!preg_match('/^\d{9}v$|^\d{12}$/', $nic)) {
            $this->errors['NIC']="NIC is invalid!";
        } else if($this->customWhere('student',['NIC'=>$nic])){//checking whether nic already exists
            $this->errors['NIC']="NIC already exist!";
        }
        

        // print_r($this->errors);
        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }

    //if all goes well, return true, else false
    public function validateCompany($data){
        $this->errors=[];

        //check email
        $query="select * from user where email=:email limit 1";
        
        if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email']="The email is not valid!";
        }else if($this->where(['email'=>$data['email']])){
            $this->errors['email']="Email already exists!";

        }


        if(empty($data['brn'])){
            $this->errors['brn']="BRN is required!";
        }
        if(empty($data['companyName'])){
            $this->errors['companyName']="Company Name is required!";
        }
        if(empty($data['firstName'])){
            $this->errors['firstName']="First Name is required!";
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
        }
        if(empty($data['contactNo'])){
            $this->errors['contactNo']="Contact Number is required!";
        }
        if(empty($data['password'])){
            $this->errors['password']="A password is required!";
        }
        if($data['password'] !== $data['rePassword']){
            $this->errors['rePassword']="Passwords do not match!";
        }
        

        $brn = $data['brn'];
        
        if($this->customWhere('company',['brn'=>$brn])){//checking whether brn already exists
            $this->errors['brn']="BRN already exist!";
        }
        

        if (!empty($data['website'])) {
            $website = $data['website'];
        
            // Remove leading and trailing spaces from the input
            $website = trim($website);
        
            // Check if it's a valid URL
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                $this->errors['website']="Invalid website URL!";
            }
        }


        // print_r($this->errors);
        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }
    
    public function validateModerator($data){
        $this->errors=[];
        //check email
        $query="select * from user where email=:email limit 1";
        
        if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email']="The email is not valid!";
        }else if($this->where(['email'=>$data['email']])){
            $this->errors['email']="Email already exists!";

        }
        if(empty($data['firstName'])){
            $this->errors['firstName']="First Name is required!";
        }
        if(empty($data['lastName'])){
            $this->errors['lastName']="Last Name is required!";
        }
        if(empty($data['address'])){
            $this->errors['address']="Address is required!";
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
        

        // print_r($this->errors);
        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }
}