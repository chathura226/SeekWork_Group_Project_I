<?php
$myID=$_SESSION['userID'];
$query = "SELECT u.userID, u.userName, u.image, u.gender, COUNT(m.id) AS unread_count
FROM user u
LEFT JOIN (
    SELECT *
    FROM messages
    WHERE received IS NULL AND receiver=:userID
) AS m ON u.userID = m.sender
WHERE u.userID != :userID
GROUP BY u.userID, u.userName, u.image, u.gender;
";


$result = $DB->read($query, ['userID'=>$myID]);

if (is_array($result)) {
    $mydata = '
    <style>
    @keyframes appear {
        0%{
            opacity: 0;
            transform: translateX(50px);
        }
        
        100%{
            opacity: 1;
            transform: translateX(0px);
        }
    }
    
    #contact{
        cursor: pointer;
        transition: all 0.5s cubic-bezier(.78,.11,.42,.85);
    }
    
    #contact:hover{
        transform: scale(1.1);
    }
</style>
    <div style="text-align: center;"><div id="chat_header">
<span style="font-size: 16px"><svg style="fill: #615EF0;"  xmlns="http://www.w3.org/2000/svg" height="18" width="20" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>  <b>Contacts</b></span>
</div>';

    foreach ($result as $user) {
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

        $mydata .= '    <div id="contact" style="position:relative;" userID="'.$user->userID.'" onclick="startChat(event)">
        <img src="' . $image . '">
        <br>' . ucfirst($user->userName);

        if($user->unread_count>0) {
            $mydata .= '<div style="width: 20px;height: 20px;border-radius: 50%;background-color: orange;color: white;position: absolute;left: -5px;top: -5px;">'.$user->unread_count.'</div>';
        }
        $mydata.='</div>';
    }

    $mydata .= '</div>';


    $info->message = $mydata;
    $info->dataType = "contacts";
    echo json_encode($info);

} else {
    $info->message = "No contacts were found!";
    $info->dataType = "error";
    echo json_encode($info);
}
?>


