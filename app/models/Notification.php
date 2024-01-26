<?php

//Notification class
class Notification extends Model {
    protected $table="notification";
    public $errors=[];
    protected $primaryKey='notificationID';

    //fields that can be updated
    protected $allowedColumns=[
        'notificationID',
        'content',//json with {msg:"",url:""}
        'userID',//receving useriD
        'seen',
    ];


}