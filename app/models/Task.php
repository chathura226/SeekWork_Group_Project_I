<?php

//Task class
class Task extends Model {
    protected $table="task";
    protected $primaryKey='taskID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[

        'taskID',
        'title',
        'taskType',
        'description',
        'deadline',
        'value',
        'status',
        'documents',
        'companyID',
        'assignedStudentID',
        'assignmentID',
        'categoryID',
        'finishedDate',
        'createdAt',
        'isDeleted'
    ];


    public function validate($data){
        $this->errors=[];




        if(empty($data['title'])){
            $this->errors['title']="Title is required!";
        }else if(!preg_match("/^[a-zA-Z\s]+$/",trim($data['title']))){//checking for numbers
            $this->errors['title']="Title can only contain letters and spaces!";
        }

        if(empty($data['taskType'])){
            $this->errors['taskType']="Task Type is required!";
        }
        if(empty($data['categoryID'])){
            $this->errors['categoryID']="Category is required!";
        }
        if(empty($data['description'])){
            $this->errors['description']="Description is required!";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

}