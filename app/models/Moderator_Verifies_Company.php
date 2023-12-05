<?php

//Moderator_Verifies_Company class
class Moderator_Verifies_Company extends Model {
    protected $table="Moderator_Verifies_Company";
    public $errors=[];
    protected $primaryKey='verificationID';

    //fields that can be updated
    protected $allowedColumns=[
        'verificationID',
        'comments',
        'moderatorID',
        'companyID',
        'documents',
    ];


}