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

//to replace special characters for security reasons
function esc($str){
    return nl2br(htmlspecialchars($str)); //nl2br replace new lines by brake tags
}


//for sorting array of objects by a given property
function sortArrayOfObjects($array,$property,$isAscending =1) {
    // Custom comparison function
    $compare = function($a, $b) use ($property, $isAscending) {
        if ($a->{$property} == $b->{$property}) {
            return 0;
        }
        return ($isAscending ? ($a->{$property} < $b->{$property}) : ($a->{$property} > $b->{$property})) ? -1 : 1;
    };

    // Use usort to sort the array
    usort($array, $compare);

    return $array;
}