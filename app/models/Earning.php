<?php

//earning model class
class Earning extends Model {
    protected $table="earnings";
    protected $primaryKey='transactionID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'transactionID',//should be unique string
        'earningDescription',
        'earningStatus',
        'transactionDate',
        'taskID',
        'amount',
        'createdAt',
    ];

}