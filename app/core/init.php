<?php
//spl_autoload_register will run when a the 
// file not found, (when we try to use something 
// that not included) and it will try to load it
//if i ask for user class when it was not included, 
// this will get 'User' as the parameter and the function 
// will be triggered
spl_autoload_register(function($name){
    require "../app/models/".$name.".php";
});


require "config.php"; 
require "functions.php"; 
require "database.php"; 
require "model.php";
require "controller.php"; 
require "app.php"; 