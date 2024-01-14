<?php

$info=(object)[];

$data['userID']=$_SESSION['userID'];

//getting password to confirm the save settings
$query = "SELECT password FROM user WHERE userID=:userID limit 1 ";
$result = $DB->read($query, $data);


if (is_array($result)) {
    $result=$result[0];//since results will be an array of data
    if(password_verify($DATA_OBJ->password,$result->password)){
        //valid credentials.
        //checking if user trying to change password
        if(!empty($DATA_OBJ->newPassword)){ // user want to change password
            $data['password']=password_hash($DATA_OBJ->newPassword, PASSWORD_DEFAULT);
            if (strlen($DATA_OBJ->newPassword)<8){
                $error .= "Password must be at least 8 characters long! <br>";
            }
        }else{
            $data['password']=$DATA_OBJ->password;

        }
    }else{
        $error .= "Incorrect credentials! <br>";

    }

} else {
    $error .= "Error fetching data! <br>";
}


//validating username
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




//gender
if(empty($DATA_OBJ->gender)){
    $error .= "Please select a gender <br>";
}else{
    $data['gender']=$DATA_OBJ->gender;
}


if($error=="") {
    $query = "UPDATE user SET userName= :userName, email= :email, gender= :gender, password= :password WHERE userID= :userID;";
    $result = $DB->write($query, $data);

    if ($result) {
//        echo "Your profile was created successfully!";
        $info->message="Your profile was updated successfully!";
        $info->dataType="save_settings";
        echo json_encode($info);
    } else {
//        echo "Error occurred while creating your account!";
        $info->message="Error occurred while updating your account!";
        $info->dataType="error";
        echo json_encode($info);
    }
}else{
//    echo $error;
    $info->message=$error;
    $info->dataType="error";
    echo json_encode($info);
}