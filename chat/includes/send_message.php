<?php
$myID = $_SESSION['USER_DATA']->userID;

//getting the current chatting user ( who we chat with)
if(isset($DATA_OBJ->find->userID)){
    $ChatUserID = $DATA_OBJ->find->userID;
}else{
    //user not found
    $info->user = "Contact was not found!";
    $info->dataType = "chats";
    echo json_encode($info);
    die;
}

$query = "CALL getCombinedUserDetailsForChatPerGivenUserName(".$ChatUserID.")";
$result = $DB->read($query, []);

if (is_array($result)) {

    //arr array to store data for prepared statement
    $arr['message']=$DATA_OBJ->find->message;
    $arr['date']=date("Y-m-d H:i:s");
    $arr['sender']=$_SESSION['USER_DATA']->userID;
    $arr['receiver']=$DATA_OBJ->find->userID;
    $arr['msgID']=getRandomStringMax(60);

    //if msgID exist, get that as the msgID (unique for a chat between a sender and reciever)
    $query = "SELECT * FROM messages WHERE (sender= :sender && receiver=:receiver) || (sender= :receiver && receiver=:sender) limit 1";
    $resultNew = $DB->read($query,['sender'=>$arr['sender'],'receiver'=>$arr['receiver']]);
    if(is_array($resultNew)){
        $arr['msgID']=$resultNew[0]->msgID;
    }

    $query="INSERT INTO messages (sender,receiver,message,date,msgID) values (:sender,:receiver,:message,:date,:msgID)";
    $DB->write($query, $arr);

    //user found
    $user = $result[0];
    $user->image=$user->profilePic;
    $user->userName=$user->firstName." ".$user->lastName;


    //decision abt the image
    $image = "";
    if (!empty($user->image) && file_exists($user->image)) {//when image is set and exists
        $image = $user->image;
    }else{//when image is not set
        if($user->gender=='male'){//for male users with no image
            $image="ui/images/male.jpg";
        }else{//for female users with no image
            $image="ui/images/female.png";
        }
    }
    $user->image=$image;


    $mydata = '<div id="chat_header">
<span style="font-size: 16px"><svg style="fill: #615EF0;" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>  <b>Chats</b></span>
</div>Now chatting with:<br>   <div id="active_contact"  userID="' . $user->userID . '" >
            <img src="'.ROOT."/" . $user->image . '">
            ' . ucfirst($user->userName) . '</div>';

    //get other prev chats
    $query = "SELECT messages.receiver as userID
                FROM messages
                WHERE messages.sender = :userID AND messages.deleted_sender=0
                GROUP BY  messages.receiver
                
                UNION
                
                SELECT messages.sender as userID
                FROM messages
                WHERE messages.receiver = :userID AND messages.deleted_receiver=0
                GROUP BY  messages.sender
                ";
    $people = $DB->read($query, ['userID' => $myID]);
    if (!empty($people)) {
        for ($i=0;$i<sizeof($people);$i++) {

            $query = "CALL getCombinedUserDetailsForChatPerGivenUserName(".$people[$i]->userID.")";
            $row = $DB->read($query, []);

            // Combining the two objects into a new stdClass object
            $combinedObject = new stdClass();

            // Copying properties from the first object
            foreach ($row[0] as $key => $value) {
                $combinedObject->$key = $value;
            }

            // Copying properties from the second object
            foreach ($people[$i] as $key => $value) {
                $combinedObject->$key = $value;
            }

            $people[$i]=$combinedObject;
        }
    }


    $msgFromDB = $people;
    if (is_array($msgFromDB)) {
        foreach ($msgFromDB as $data) {
            $data->image=$data->profilePic;
            $data->userName=$data->firstName." ".$data->lastName;

            $data->image = decision_about_image($data);
            if($data->userID!=$ChatUserID){
                $mydata .= '<div id="notActive_contact"  userID="' . $data->userID . '" onclick="startChat(event)" >';
                $mydata .='<img src="'.ROOT."/" . $data->image . '">
                        ' . ucfirst($data->userName) . '</div>';
            }

        }
    }

    $messages="";
    $messages .= '
<div id="messages_container_wrapper" onclick="setSeen(event);" >
<div id="chat_header">
<img class="profilePic" src="'.ROOT."/" . $user->image . '">
<span><b>'.ucfirst($user->userName).'</b></span>
<span class="delete_thread" style="cursor: pointer;" onclick="deleteThread(event);"><small style="color: grey;">Delete this thread</small>  <svg style="fill: #615EF0;" xmlns="http://www.w3.org/2000/svg" height="20" width="18" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM305 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47z"/></svg></span>
</div>
    <div id="messages_container" >
        ';
    //left and right chats

    //reading from db
    $msgID=$arr['msgID'];
    $query = "SELECT * FROM messages WHERE (msgID=:msgID && receiver=:userID && deleted_receiver=0) || (msgID=:msgID && sender=:userID && deleted_sender=0) ORDER BY id ASC";
    $msgFromDB = $DB->read($query,['msgID'=>$msgID,'userID'=>$_SESSION['USER_DATA']->userID]);
    if(is_array($msgFromDB)){
        foreach ($msgFromDB as $data){
            if($data->sender==$_SESSION['USER_DATA']->userID){//when the msg was sent by the logged user
                $userN=$_SESSION['USER_DATA'];
                $userN->image=$userN->profilePic;
                $userN->userName=$userN->firstName." ".$userN->lastName;
                $messages.=message_right($data,$userN);//using user obj in session for user data of logged user
            }else{//when msg is sent by the chatting user
                $messages.=message_left($data,$user);
            }
        }
    }


    //controllers for message (send button input fields etc.)
    $messages.=messageControls();


    $info->user = $mydata;
    $info->messages = $messages;
    $info->dataType = "send_message";
    echo json_encode($info);

} else {
    //user not found
    $info->user = "Contact was not found!";
    $info->dataType = "chats";
    echo json_encode($info);
}


//to generate random character string
function getRandomStringMax($length)
{
    $array=array(0,1,2,3,4,5,6,7,8,9,'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $text="";
    $length=rand(4,$length);

    for($i=0;$i<$length;$i++){
        $random=rand(0,61);
        $text.=$array[$random];
    }

    return $text;
}
?>


