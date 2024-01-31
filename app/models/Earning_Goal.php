<?php

//Earning goal class
class Earning_Goal extends Model {
    protected $table="earning_goal";
    public $errors=[];
    protected $primaryKey='earningGoalID';

    //fields that can be updated
    protected $allowedColumns=[
        'earningGoalID',
        'goal',
        'studentID',
    ];
     
}

