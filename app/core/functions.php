<?php

//to show stuff (mostly for logging debug)
function show($stuff){
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

//set value when submiting login, signin 
function set_value($key){
    if(!empty($_POST[$key])){
        return $_POST[$key];
    }
    return '';
}

//redirecting
function redirect($link){
    header("Location: ". ROOT."/".$link);
    die;
}

//popup message
function message($msg='',$erase=false){
    
    if(!empty($msg)){
        $_SESSION['message']=$msg;
    }else{
        if(!empty($_SESSION['message'])){

            $msg=$_SESSION['message'];
            if($erase){ unset($_SESSION['message']);}
            return $msg;

        }
    }

    return false;
}