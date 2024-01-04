<?php

//Student_Skill class
class Student_Skill extends Model {
    protected $table="student_skill";
    public $errors=[];
    protected $primaryKey='studentSkillID';

    //fields that can be updated
    protected $allowedColumns=[
        'studentSkillID',
        'skillID',
        'studentID',
    ];


}