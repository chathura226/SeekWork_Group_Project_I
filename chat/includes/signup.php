<?php

$info=(object)[];

$data['userID']=$DB->generateID();
$data['createdAt']=date("Y-m-d H:i:s");

//validating userName
$data['userName']=$DATA_OBJ->username;
if(empty($DATA_OBJ->username)){
    $error .= "Please enter a valid username! <br>";
}else{
    if(strlen($DATA_OBJ->username)<3){
        $error .= "Username must be at least 3 characters long! <br>";
    }
    if(!preg_match("/^[a-zA-Z0-9]*$/",$DATA_OBJ->username)){//only alphanumeric characters
        $error .= "Please enter a valid username! <br>";
    }
}

//validating email
$data['email']=$DATA_OBJ->email;
if(empty($DATA_OBJ->email)){
    $error .= "Please enter a valid email! <br>";
}else{
    if(!filter_var($DATA_OBJ->email,FILTER_VALIDATE_EMAIL)){
        $error .= "Please enter a valid email! <br>";
    }
}

//validating password
$data['password']=$DATA_OBJ->password;
$rePassword=$DATA_OBJ->confirmPassword;
if(empty($DATA_OBJ->password)){
    $error .= "Please enter a valid password! <br>";
}else{
    if ($DATA_OBJ->password != $rePassword){
        $error .= "Passwords do not match! <br>";
    }

    if (strlen($DATA_OBJ->password)<8){
        $error .= "Password must be at least 8 characters long! <br>";
    }
}

if(empty($DATA_OBJ->gender)){
    $error .= "Please select a gender <br>";
}else{
    $data['gender']=$DATA_OBJ->gender;
}


if($error=="") {
    //hashing
    $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO user (userID,userName,email,password,createdAt,gender) values (:userID,:userName,:email,:password,:createdAt,:gender) ";
    $result = $DB->write($query, $data);

    if ($result) {
//        echo "Your profile was created successfully!";
        $info->message="Your profile was created successfully!";
        $info->dataType="info";
        echo json_encode($info);
    } else {
//        echo "Error occurred while creating your account!";
        $info->message="Error occurred while creating your account!";
        $info->dataType="error";
        echo json_encode($info);
    }
}else{
//    echo $error;
    $info->message=$error;
    $info->dataType="error";
    echo json_encode($info);
}