<?php

$info = (object)[];


//getting userID from session
$data['userID'] = $_SESSION['USER_DATA']->userID;


if ($error == "") {

// Create a new stdClass object
    $result = new stdClass();
    $result->id = $_SESSION['USER_DATA']->userID;
    $result->userID = $_SESSION['USER_DATA']->userID;
    $result->userID = $_SESSION['USER_DATA']->userID;
    $result->userName = $_SESSION['USER_DATA']->firstName . " " . $_SESSION['USER_DATA']->lastName;
    $result->email = $_SESSION['USER_DATA']->email;
    $result->image = $_SESSION['USER_DATA']->profilePic;
    $result->gender = $_SESSION['USER_DATA']->gender;

    //check if image exist
    $image = "";
    if (empty($result->image) || !file_exists($result->image)) {//when image is set and exists
        if ($result->gender == 'male') {//for male users with no image
            $image = "ui/images/male.jpg";
        } else {//for female users with no image
            $image = "ui/images/female.png";
        }
        $result->image = $image;
    }


    $result->dataType = "userInfo";
    echo json_encode($result);

} else {
    $info->message = $error;
    $info->dataType = "error";
    echo json_encode($info);
}

