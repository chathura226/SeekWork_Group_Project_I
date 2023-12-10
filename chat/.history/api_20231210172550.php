<?php


require_once("init.php");

$DB = new Database();


$data = file_get_contents("php://input");
 
$data = json_decode($data);

/*

php ---------> Javascript

json_decode(json) = JSON.parse()
json_encode(value) = JSON.strinfigy()

*/




