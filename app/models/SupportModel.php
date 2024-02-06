<?php

//Assignment class
class SupportModel extends Model {
    protected $table="support";
    public $errors=[];
    protected $primaryKey='supportID';

    //fields that can be updated
    protected $allowedColumns=[
        'supportID',
        'name',
        'email',
        'comment',
        'status',
        'createdAt',
        'subject',
    ];

     
}