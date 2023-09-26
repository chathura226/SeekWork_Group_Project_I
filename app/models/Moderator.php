<?php

//Moderator class
class Moderator extends Model {
    protected $table="moderator";
    protected $primaryKey='moderatorID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'moderatorID',
        'firstName',
        'lastName',
        'address',
        'userID',
    ];

     
}