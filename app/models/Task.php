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
        'companyID',
        'assignedStudentID',
        'categoryID',
        'finishedDate',     
    ];


}