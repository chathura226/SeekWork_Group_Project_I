<?php

//Notification class
class Notification extends Model {
    protected $table="notification";
    public $errors=[];
    protected $primaryKey='notificationID';

    //fields that can be updated
    protected $allowedColumns=[
        'notificationID',
        'msg',
        'url',
        'userID',//receving useriD
        'seen',
    ];

    //to add new notification
    public static function newNotification($msg,$url,$userID){
        $newObj=new self();
        $newObj->insert(['msg'=>$msg,'url'=>$url,'userID'=>$userID,'seen'=>0]);
    }

}