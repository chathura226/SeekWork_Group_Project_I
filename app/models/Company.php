<?php

//Company class
class Company extends Model {
    protected $table="company";
    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'companyName',	
        'firstName',	
        'lastName',	
        'address',	
        'website',	
        'brn',	
        'userID',	
    ];

     
    //company validate function is in user model.....................
}