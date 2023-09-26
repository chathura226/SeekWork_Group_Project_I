<?php

//Category class
class Category extends Model {
    protected $table="category";
    public $errors=[];
    protected $primaryKey='categoryID';

    //fields that can be updated
    protected $allowedColumns=[
        'categoryID', 
        'title', 
        'description', 
        'tags',	
    ];

     
}