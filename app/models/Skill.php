<?php

//Category class
class Skill extends Model {
    protected $table="skill";
    public $errors=[];
    protected $primaryKey='skillID';

    //fields that can be updated
    protected $allowedColumns=[
        'skillID',
        'skill',
        'skillLevel',
    ];


}