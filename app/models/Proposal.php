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

    public function validate($data)
    {
        $this->errors = [];
        if(empty($data['description'])){
            $this->errors['description']="Proposal Description is required!";
        }
        if(empty($data['value']) && empty($data['proposeAmount'])){
            $this->errors['value']="Proposing price is required!";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

     
}