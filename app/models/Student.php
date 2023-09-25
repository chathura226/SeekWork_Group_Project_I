<?php

//Student class
class Student extends Model {
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
        'userID',
        'universityID',
    ];

     
    //student validate function is in user model.....................
}