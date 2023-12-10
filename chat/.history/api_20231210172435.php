<?php

$data = file_get_contents("php://input");
 
$data = json_decode($data);

require_once("init.php");

/*

php ---------> Javascript

json_decode(json) = JSON.parse()
json_encode(value) = JSON.strinfigy()

*/




