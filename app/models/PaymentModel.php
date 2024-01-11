<?php

//payment model class
class PaymentModel extends Model {
    protected $table="payment";
    protected $primaryKey='paymentID';

    public $errors=[];

    //fields that can be updated
    protected $allowedColumns=[
        'paymentID',//should be unique string
        'paymentDescription',
        'paymentStatus',
        'taskID',
        'amount',
        'createdAt',
        'paidDate',
    ];

}