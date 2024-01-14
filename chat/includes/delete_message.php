<?php

$arr['messageID'] = "null";
if (isset($DATA_OBJ->find->rowID)) {
    //id of the msg to be deleted
    $arr['messageID'] = $DATA_OBJ->find->rowID;
}

//setting userID
$arr['userID'] = $_SESSION['userID'];

$query = "UPDATE messages
SET 
    deleted_sender = CASE 
                        WHEN id = :messageID AND sender = :userID THEN 1 
                        ELSE deleted_sender 
                    END,
    deleted_receiver = CASE 
                          WHEN id = :messageID AND receiver = :userID THEN 1 
                          ELSE deleted_receiver 
                      END
WHERE 
    (id = :messageID AND sender = :userID)
    OR
    (id = :messageID AND receiver = :userID);
";

$result = $DB->write($query, $arr);

if($result>0){
    $info->message = "Message Deleted Successfully!";
    $info->dataType = "success";
    echo json_encode($info);
}else{
    $info->message = "Error occurred while deleting!";
    $info->dataType = "alert";
    echo json_encode($info);
}


