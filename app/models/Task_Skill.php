<?php

//task_skill class
class Task_Skill extends Model {
    protected $table="task_skill";
    public $errors=[];
    protected $primaryKey='taskSkillID';

    //fields that can be updated
    protected $allowedColumns=[
        'taskSkillID',
        'skillID',
        'studentID',
    ];


}