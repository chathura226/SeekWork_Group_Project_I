<?php

//Admin class
class AdminModel extends Model {
    protected $table="admin";
    protected $primaryKey='adminID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'adminID',
        'firstName',
        'lastName',
        'address',
        'profilePic',
        'userID',
    ];


}