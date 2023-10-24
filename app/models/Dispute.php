<?php

//Dispute class
class Dispute extends Model {
    protected $table="dispute";
    public $errors=[];
    protected $primaryKey='disputeID';

    //fields that can be updated
    protected $allowedColumns=[
        'disputeID',
        'description',
        'status',
        'type',
        'initiatedParty',
        'taskID',
        'moderatorID',
        'moderatorComment',
    ];
     
}

