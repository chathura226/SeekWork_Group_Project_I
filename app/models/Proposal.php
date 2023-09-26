<?php

//Proposal class
class Proposal extends Model {
    protected $table="proposal";
    public $errors=[];
    protected $primaryKey='proposalID';

    //fields that can be updated
    protected $allowedColumns=[
        'porposalID',
        'description',
        'documents',
        'proposeAmount',
        'submissionDate',
        'taskID',
        'studentID',

    ];

     
}