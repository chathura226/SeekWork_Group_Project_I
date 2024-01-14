<?php

$info=(object)[];


//getting userID from session
$data['userID']=$_SESSION['userID'];


if($error=="") {
    $query = "SELECT id,userID,userName,email,image,online,gender FROM user WHERE userID=:userID limit 1 ";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result=$result[0];//since results will be an array of data

        //check if image exist
        $image = "";
        if (empty($result->image) || !file_exists($result->image)) {//when image is set and exists
            if($result->gender=='male'){//for male users with no image
                $image="ui/images/male.jpg";
            }else{//for female users with no image
                $image="ui/images/female.png";
            }
            $result->image=$image;
        }




        $result->dataType="userInfo";
        echo json_encode($result);
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

