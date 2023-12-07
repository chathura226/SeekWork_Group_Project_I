<?php

$data = file_get_contents("php://input");
 
$data = json_decode($data);


echo "<pre>";
echo "</pre>";


print_r($data);

