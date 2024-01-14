<?php

//Chat_connections.php class
class Chat_connections extends Model {
    protected $table="chat_connections";
    public $errors=[];
    protected $primaryKey='person1 & person2';//multiple primary keys

    //fields that can be updated
    protected $allowedColumns=[
        'person1',
        'person2',
        'person1_role',
        'person2_role',
    ];


}