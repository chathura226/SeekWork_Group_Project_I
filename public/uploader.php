<?php

session_start();

$info=(object)[];

//retrieving data
$DATA_RAW=file_get_contents("php://input");
$DATA_OBJ=json_decode($DATA_RAW);//make object form stringified data


//check if logged in
if(!isset($_SESSION['userID'])){
    if(isset($DATA_OBJ->dataType) && $DATA_OBJ->dataType!="login" && $DATA_OBJ->dataType!="signup") {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

$dataType="";
if(isset($_POST['dataType'])){
    $dataType=$_POST['dataType'];
}

require_once("./classes/initialize.php");

$DB=new Database();

//upload file anyway aand then check whether to put into db
$destination="";
if(isset($_FILES['file']) && $_FILES['file']['name']!="" ){

    if($_FILES['file']['error']==0){
        //uploading the file
        $fileName=$_FILES['file']['tmp_name'];
        $folder="uploads/";
        if(!file_exists($folder)){
            mkdir($folder,077,true);
        }
        $destination=$folder.time()."_".$_FILES['file']['name'];
        move_uploaded_file($fileName,$destination);
        $info->message="File Uploaded Successfully!";
        $info->dataType=$dataType;
        echo json_encode($info);
    }
}



if($dataType=="change_profile_image"){
    if($destination!=""){//save to db
        $updateData['image']=$destination;
        $updateData['userID']=$_SESSION['userID'];
        $query="UPDATE user SET image= :image WHERE userID= :userID LIMIT 1";
        $DB->write($query,$updateData);
    }
}else if($dataType=="send_image"){

    //arr array to store data for prepared statement
    $arr['message']="";
    $arr['date']=date("Y-m-d H:i:s");
    $arr['sender']=$_SESSION['userID'];
    $arr['receiver']=$_POST['userID'];
    $arr['msgID']=getRandomStringMax(60);
    $arr['file']=$destination;

    //if msgID exist, get that as the msgID (unique for a chat between a sender and reciever)
    $query = "SELECT * FROM messages WHERE (sender= :sender && receiver=:receiver) || (sender= :receiver && receiver=:sender) limit 1";
    $resultNew = $DB->read($query,['sender'=>$arr['sender'],'receiver'=>$arr['receiver']]);
    if(is_array($resultNew)){
        $arr['msgID']=$resultNew[0]->msgID;
    }

    $query="INSERT INTO messages (sender,receiver,message,date,msgID,files) values (:sender,:receiver,:message,:date,:msgID,:file)";
    $DB->write($query, $arr);

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
