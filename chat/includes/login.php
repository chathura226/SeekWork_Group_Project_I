<?php

$info=(object)[];


//validating info
$data['email']=$DATA_OBJ->email;
if(empty($DATA_OBJ->email)){
    $error .= "Please enter a valid email! <br>";
}
if(empty($DATA_OBJ->password)){
    $error .= "Please enter a valid password! <br>";
}
if($error=="") {
    $query = "SELECT * FROM user WHERE email=:email limit 1 ";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result=$result[0];//since results will be an array of data
        if(password_verify($DATA_OBJ->password,$result->password)){
            //saving essential user Info
            $_SESSION['userID']=$result->userID;



            //decision abt the image
            $image = "";
            if (!empty($result->image) && file_exists($result->image)) {//when image is set and exists
                $image = $result->image;
            }else{//when image is not set
                if($result->gender=='male'){//for male users with no image
                    $image="ui/images/male.jpg";
                }else{//for female users with no image
                    $image="ui/images/female.png";
                }
            }
            $result->image=$image;

            $user_data['image']=$result->image;
            $user_data['userID']=$result->userID;
            $user_data['gender']=$result->gender;
            $user_data['email']=$result->email;
            $user_data['userName']=$result->userName;
            $_SESSION['user']=(object)$user_data;//saving user data as an obj in session

            $info->message="You are successfully logged in!";
            $info->dataType="info";
            echo json_encode($info);
        }else{
            $info->message="Incorrect Credentials!";
            $info->dataType="error";
            echo json_encode($info);
        }

    } else {
        $info->message="Incorrect Credentials!";
        $info->dataType="error";
        echo json_encode($info);
    }
}else{
    $info->message=$error;
    $info->dataType="error";
    echo json_encode($info);
}

