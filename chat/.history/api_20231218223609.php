<?php


require_once("classes/init.php");

$DB = new Database();


$DATA_RAW = file_get_contents("php://input");
 
$DATA_OBJ = json_decode($data);

/*

php ---------> Javascript

json_decode(json) = JSON.parse()
json_encode(value) = JSON.strinfigy()

*/

if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="signup")
{
    //signup

    $data = false;

    $data['userid'] = $DB->generate_id();

    $quary = "insert into users (userid,username,email,password,data) values (:userid,:username,:email,:password,:data)";
    $DB->write($query);
}

