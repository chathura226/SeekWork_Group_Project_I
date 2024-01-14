<?php
$id = $_SESSION['userID'];
$sql="SELECT * FROM user WHERE userID=:userID limit 1";
$data = $DB->read($sql, ['userID' => $id]);

$mydata = "";
if (is_array($data)) {
    $data = $data[0];
    $image = "";
    if (!empty($data->image) && file_exists($data->image)) {//when image is set and exists
        $image = $data->image;
    }else{//when image is not set
        if($data->gender=='male'){//for male users with no image
            $image="ui/images/male.jpg";
        }else{//for female users with no image
            $image="ui/images/female.png";
        }
    }

    $mydata = '<style>
        form {
            text-align: left;
            margin: auto;
            padding: 10px;
            width: 100%;
            max-width: 400px;
            /*background-color: #383e48;*/
        }
    
        input[type=radio] {
            padding: 10px;
            margin: 10px;
            border: solid thin grey;
            transform: scale(1.1);
        }
    
        input[type=text], input[type=password], input[type=submit] {
            padding: 10px;
            margin: 10px;
            width: 100%;
            border-radius: 5px;
            border: solid thin grey;
        }
    
        input[type=submit] {
            width: 105%;
            cursor: pointer;
            background-color: #2b5488;
            color: white;
        }
    
        .saveImage {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: solid thin grey;
            width: 70%;
            cursor: pointer;
            background-color: #9b9a80;
            color: white;
        }
    
        .alert {
            display: none;
            /*position: fixed;*/
            padding: 20px !important;
            margin: auto;
            width: fit-content;
            height: fit-content;
            min-width: 400px;
            background-color: transparent;
            /*left: 50vw;*/
            /*transform: translate(-50%, -50%);*/
            /*z-index: 999 ;*/
        }
    
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
    @keyframes appear {
        0%{
            opacity: 0;
            transform: translateX(-100px);
        }
        
        100%{
            opacity: 1;
            transform: translateX(0px);
        }
    }
    
    .dragging{
        border: dashed 2px #aaa;
    }
    </style>
    
    <div style="text-align: center;"><div id="chat_header">
<span style="font-size: 16px"><svg style="fill:#615EF0;" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>  <b>Settings</b></span>
</div>
    <div id="error" class="alert alert-danger"></div>
    <div style="display: grid;
      grid-template-columns: 1fr 3fr; /* Two columns with equal width */
      grid-gap: 10px;
      animation: appear 0.9s ease;">
        <div>
            Drag & Drop an image to change the profile picture<br>
            <img ondragover="handleDragAndDrop(event)" ondragleave="handleDragAndDrop(event)" ondrop="handleDragAndDrop(event)" src="'.$image.'" style="width: 150px; height: 150px; margin:10px; "/>
            <label for="changeImageBtn" class="saveImage" id="changeImageLbl">
            Change Image
            </label>
            <input onchange="upload_profile_image(this.files)" class="saveImage" type="file" value="Change Image" id="changeImageBtn" hidden><br>
        </div>
        <form id="signupForm">
            <label for="username">Username: </label>
            <input type="text" name="username" placeholder="Enter your username" value="'.$data->userName.'"><br>
            <label for="email">Email: </label>
            <input type="text" name="email" placeholder="Enter your email address" value="'.$data->email.'"><br>
            <label for="gender">Gender: </label>
            <input type="radio" name="gender" value="male"'.(($data->gender=='male')?'checked':'').'>Male
            <input type="radio" name="gender" value="female"'.(($data->gender=='female')?'checked':'').'>Female<br>
            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Enter your password"><br>
            <label for="confirmPassword">New Password: </label>
            <input type="password" name="newPassword" placeholder="Enter your new password (leave empty if not changing)"><br>
            <input type="submit" value="Save Settings" id="save-settings-button" onclick="collectData(event)"><br>
    
            <br>
    
    
        </form>
    </div>';


$info->message = $mydata;
$info->dataType = "settings";
echo json_encode($info);

}else {

    $info->message = "Error occured while fetching!";
    $info->dataType = "error";
    echo json_encode($info);
}

?>


