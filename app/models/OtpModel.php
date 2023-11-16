<?php

//Otp class
class OtpModel extends Model {
    protected $table="otp";
    protected $primaryKey='otpID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'otpID',
        'otpCode',
        'userID',
        'createdAt',
        'updatedAt',
        'expireAt',
    ];



}