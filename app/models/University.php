<?php

//University class
class University extends Model {
    protected $table="university";
    public $errors=[];
    protected $primaryKey='universityID';

    //fields that can be updated
    protected $allowedColumns=[
        'universityID', 
        'universityName', 
        'domain', 
    ];

     
}