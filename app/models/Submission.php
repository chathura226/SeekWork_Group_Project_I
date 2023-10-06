<?php

//Submission class
class Submission extends Model {
    protected $table="submission";
    public $errors=[];
    protected $primaryKey='submissionID';

    //fields that can be updated
    protected $allowedColumns=[
        'submissionID',
        'createdAt',
        'documents',
        'status',
        'note',
        'comments',
        'studentID',
        'taskID',	
    ];

     
}