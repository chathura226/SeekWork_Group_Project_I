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
        'address',	
        'website',	
        'brn',	
        'userID',	
    ];

     
    //company validate function is in user model.....................
}