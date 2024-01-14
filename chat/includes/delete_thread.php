<?php

$arr['userID'] = "null";
if (isset($DATA_OBJ->find->userID)) {
    //id of the msg to be deleted
    $arr['userID'] = $DATA_OBJ->find->userID;
}

//setting userID of logged user
$arr['myUserID'] = $_SESSION['userID'];

$query = "UPDATE messages
SET 
    deleted_sender = CASE 
                        WHEN receiver = :userID AND sender = :myUserID THEN 1 
                        ELSE deleted_sender 
                    END,
    deleted_receiver = CASE 
                          WHEN sender = :userID AND receiver = :myUserID THEN 1 
                          ELSE deleted_receiver 
                      END
WHERE 
    (receiver = :userID AND sender = :myUserID)
    OR
    (sender = :userID AND receiver = :myUserID);
";

$result = $DB->write($query, $arr);

if($result>0){
    $info->message = "Thread Deleted Successfully!";
    $info->dataType = "success";
    echo json_encode($info);
}else{
    $info->message = "Error occurred while deleting!";
    $info->dataType = "alert";
    echo json_encode($info);
}


