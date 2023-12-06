<?php

//Company class
class CompanyModel extends Model {
    protected $table="company";
    public $errors=[];
    protected $primaryKey='companyID';

    //fields that can be updated
    protected $allowedColumns=[
        'companyName',	
        'firstName',	
        'lastName',
        'status',
        'address',	
        'website',
        'profilePic',
        'description',
        'brn',	
        'userID',
        'companyID',	
    ];

     
    //company validate function is in user model.....................


    //company validation for update profile
    //if all goes well, return true, else false
    public function validate($data){
        $this->errors=[];

        
        if(empty($data['companyName'])){
            $this->errors['companyName']="Company Name is required!";
        }
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


}