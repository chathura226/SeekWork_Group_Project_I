<?php

session_start();

$info = (object)[];

require_once("../chat/classes/initialize.php");

$DB = new Database();

//retrieving data
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);//make object form stringified data

//to store whether the req is to refresh chat part
$refresh = false;
$seen = false;
if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "chats_refresh") {
    $refresh = true;
    if ($DATA_OBJ->find->seen == "1") {
        $seen = true;
    }
}

//check if logged in
if (!isset($_SESSION['USER_DATA'])) {
    if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType != "login" && $DATA_OBJ->dataType != "signup") {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

$error = "";

//processing data
if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "signup") {

    //signup
    include("../chat/includes/signup.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "login") {
    //login
    include("../chat/includes/login.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "logout") {
    //logout
    include("../chat/includes/logout.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "user_info") {
    //userInfo
    include("../chat/includes/userInfo.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "contacts") {
    //contacts
    include("../chat/includes/contacts.php");
} else if (isset($DATA_OBJ->dataType) && ($DATA_OBJ->dataType == "chats" || $DATA_OBJ->dataType == "chats_refresh")) {
    //chats
    include("../chat/includes/chats.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "settings") {
    //settings
    include("../chat/includes/settings.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "save_settings") {
    //save_settings
    include("../chat/includes/save_settings.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "send_message") {
    //send_message
    include("../chat/includes/send_message.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "delete_message") {
    //delete_message
    include("../chat/includes/delete_message.php");
} else if (isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType == "delete_thread") {
    //delete_thread
    include("../chat/includes/delete_thread.php");
}


//part for messages in left side
function message_left($data, $user)
{
    $result = '    <div class="newMessage-left">
        <img class="profilePic" src="'.ROOT."/" . $user->image . '">
        <div style="display: flex;flex-direction: column;">
            <span style="align-self: flex-start">' . ucfirst($user->userName) . '</span>
            <div class="eachMsg">' . $data->message;

    if (!empty($data->files) && file_exists($data->files)) {
        $file_extension = pathinfo($data->files, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        if ($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png') {
            $result .= '<img src="'.ROOT."/" . $data->files . '" style="max-width: 250px; cursor: pointer;" onclick="image_show(event);"> <br><br>';
        } else {
            $result .= '<a href="' . $data->files . '" >Download the file from here <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></a>';
        }

    }

    $result .= '</div>
            <span style="align-self:flex-start;font-size: 11px;color: grey;">' . date("jS M Y H:i:s a", strtotime($data->date)) . ' <span style="cursor: pointer;" id="trash" onclick="deleteMessage(event,' . $data->id . ');"><svg width="10px" height="10px" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></span></span>
        </div>
    </div>';

    return $result;
}

//part for messages in right side
function message_right($data, $user)
{
    $seenStatusSVG = '<svg fill="grey" xmlns="http://www.w3.org/2000/svg" height="10" width="8" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>';
    if (!empty($data->seen)) {
        $seenStatusSVG = '<svg fill="blue" xmlns="http://www.w3.org/2000/svg" height="10" width="8" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/></svg>';
    } else if (!empty($data->received)) {
        $seenStatusSVG = '<svg fill="grey" xmlns="http://www.w3.org/2000/svg" height="10" width="8" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/></svg>';
    }

    $result = '    <div class="newMessage-right">
        <div style="display: flex;flex-direction: column;">
            <span style="align-self:flex-end;">' . ucfirst($user->userName) . '</span>
            <div style="align-self:flex-end;background-color: #615EF0;color: white;" class="eachMsg">' . $data->message;

    if (!empty($data->files) && file_exists($data->files)) {
        $file_extension = pathinfo($data->files, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        if ($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png') {
            $result .= '<img src="'.ROOT."/" . $data->files . '" style="max-width: 250px; cursor: pointer;" onclick="image_show(event);"> <br><br>';
        } else {
            $result .= '<a href="' . $data->files . '" >Download the file from here <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></a>';
        }

    }

    $result .= '</div>

            <span style="align-self:flex-end;font-size: 11px;color: grey;"><span style="cursor: pointer;" id="trash" onclick="deleteMessage(event,' . $data->id . ');"><svg width="10px" height="10px" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></span> ' . date("jS M Y H:i:s a", strtotime($data->date)) . ' <small>'.$seenStatusSVG.'</small> </span>
        </div>
        <img class="profilePic" src="'.ROOT."/" . $user->image . '">
        
    </div>';

    return $result;
}

function messageControls()
{
    return '
    </div>
    
    <div style="display: flex; height: 50px;">
    <label for="message_file"><img src="'.ROOT.'/ui/icons/clip.png" style="opacity: 0.;width: 30px;margin: 5px;cursor: pointer;"></label>
    <input name="message_file" onchange="sendImages(this.files)" id="message_file" type="file" style="display: none;"/>
    <input id="message_text" style="flex:6;border: solid thin #ccc; border-bottom: none;" type="text" value=""  placeholder="Type your message"  onkeyup="pressedEnter(event);"/>
    <input style="flex:1;cursor: pointer;" type="button" value="Send" onclick="send_message(event);" />
    </div>
</div>
';
}

//update Session when something change to change user data in session
function updateSession()
{

    $query = "SELECT * FROM user WHERE userID=:userID limit 1 ";
    $result = $DB->read($query, ['userID' => $_SESSION['USER_DATA']]);
    if (is_array($result)) {
        $result = $result[0];
        //decision abt the image
        $image = "";
        if (!empty($result->image) && file_exists($result->image)) {//when image is set and exists
            $image = $result->image;
        } else {//when image is not set
            if ($result->gender == 'male') {//for male users with no image
                $image = "ui/images/male.jpg";
            } else {//for female users with no image
                $image = "ui/images/female.png";
            }
        }
        $result->image = $image;

        $user_data['image'] = $result->image;
        $user_data['userID'] = $result->userID;
        $user_data['gender'] = $result->gender;
        $user_data['email'] = $result->email;
        $user_data['userName'] = $result->userName;
        $_SESSION['user'] = (object)$user_data;//saving user data as an obj in session
    }
}


//decision abt the image: should provide an object having image and gender
function decision_about_image($user)
{
    $image = "";
    if (!empty($user->image) && file_exists($user->image)) {//when image is set and exists
        $image = $user->image;
    } else {//when image is not set
        if ($user->gender == 'male') {//for male users with no image
            $image = "ui/images/male.jpg";
        } else {//for female users with no image
            $image = "ui/images/female.png";
        }
    }
    return $image;
}