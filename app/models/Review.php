<?php

//Review class
class Review extends Model {
    protected $table="review";
    public $errors=[];
    protected $primaryKey='reviewID';

    //fields that can be updated
    protected $allowedColumns=[
        'reviewID',
        'reviewTitle',
        'reviewType',
        'studentID',
        'companyID',
        'taskID',
        'nStars',
        'reviewDescription',
    ];
     
}