<?php

//Assignment class
class Assignment extends Model {
    protected $table="assignment";
    public $errors=[];
    protected $primaryKey='assignmentID';

    //fields that can be updated
    protected $allowedColumns=[
        'assignmentID',
        'status',
        'taskID',
        'proposalID',
        'replyDate',
        'createdAt',	
    ];

     
}