<?php

$data = file_get_contents("php://input");
 
$data = json_decode($data);

/*

php ---------> Javascript

json_decode(json) = JSON.parse()
json_encode(value) = JSON.strinfigy()

*/



echo "<pre>";
print_r($data);
echo "</pre>";


