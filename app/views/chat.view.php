<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Chat</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="<?=ROOT?>/assets/css/main.styles.css" rel="stylesheet">


</head>

<body>
<div class=" alert-success" id="success_alert">
    <h3></h3>
</div>
<div class=" alert alert-danger" id="error_alert">
    <h3></h3>
</div>
<div id="wrapper">
    <div id="left_panel">
        <div id="user_info" style="padding: 10px;">
            <img id="profileImg" src="<?=ROOT?>/" alt="User Image" style="width: 80px; height: 80px;">
            <br>
            <span id="username">Username </span>
            <br>
            <span id="useremail" style="font-size: 12px;opacity: 0.5;">Email</span>
            <br>
            <br>
            <br>
            <div>
                <label id="label_chat" for="radio_chat">Chat <img src="<?=ROOT?>/ui/icons/chat.png" alt="Chat"></label>
                <label id="label_contacts" for="radio_contacts">All Chat Users <img src="<?=ROOT?>/ui/icons/contacts.png"
                                                                              alt="Contacts"></label>


            </div>
        </div>

    </div>
    <div id="right_panel">

        <!--loader-->
        <div id="loader-con" class="loader-off"><img src="<?=ROOT?>/ui/icons/giphy.gif" alt="loader"></div>
        <div id="imageViewer" class="imageViewer_off" onclick="closeImage(event);"></div>

        <div id="container" style="display: flex;">


            <div id="inner_left_panel">

                <!-- to add contact info that get by ajax-->
            </div>

            <input type="radio" id="radio_chat" name="radios_for_panels" style="display: none;">
            <input type="radio" id="radio_contacts" name="radios_for_panels" style="display: none;" checked>
            <input type="radio" id="radio_settings" name="radios_for_panels" style="display: none;">

            <div id="inner_right_panel"></div>
        </div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">

    var sentAudio = new Audio("<?=ROOT?>/assets/audio/message_sent.mp3");
    var receivedAudio = new Audio("<?=ROOT?>/assets/audio/message_received.mp3");

    //global variables
    var CURRENT_CHAT_USER = "";
    var SEEN_STATUS = "0";

    //fuction to return element when pass the ID. for make it easy. function name is underscore
    function _(element) {
        return document.getElementById(element);
    }

    function capitalizeFirstLetter(str) {
        return `${str.charAt(0).toUpperCase()}${str.slice(1)}`;
    }

    //loader
    let loaderContainer = _("loader-con");




    //get user data on loading the page
    get_data({}, "user_info");
    get_data({}, 'contacts');

    //find - object describing data that we want to find
    //type - type of data
    function get_data(find, type) {
        loaderContainer.className = "loader-on";
        let xml = new XMLHttpRequest();

        xml.onload = function () {
            if (xml.readyState == 4 || xml.status == 200) {
                loaderContainer.className = "loader-off";
                handleResult(xml.responseText, type);
            }
        }

        let data = {};
        data.find = find;
        data.dataType = type;
        data = JSON.stringify(data)
        xml.open("POST", "<?=ROOT?>/api.php", true);
        xml.send(data);
    }

    function handleResult(result, type) {
        console.log(result);
        if (result.trim() != "") {
            let obj = JSON.parse(result);

            if (typeof (obj.logged_in) != "undefined" && !obj.logged_in) {
                // alert(result);
                window.location = "login.php";
            } else {
                var inner_left_panel = _("inner_left_panel");
                var inner_right_panel = _("inner_right_panel");
                switch (obj.dataType) {
                    case "userInfo":
                        SEEN_STATUS = "0";
                        let username = _("username");
                        let email = _("useremail");
                        let profileImage = _("profileImg");
                        profileImage.src = "<?=ROOT?>/"+obj.image;
                        username.innerHTML = capitalizeFirstLetter(obj.userName);
                        email.innerHTML = obj.email;
                        break;
                    case "contacts":
                        SEEN_STATUS = "0";
                        inner_right_panel.innerHTML = '';
                        inner_left_panel.innerHTML = obj.message;
                        break;
                    case "send_message":
                        sentAudio.play();
                    case "chats"://after sending messages, result also will come here
                        SEEN_STATUS = "0"; //for reaffirm seen status for new messgaes
                        inner_left_panel.innerHTML = obj.user;
                        inner_right_panel.innerHTML = obj.messages;

                        //scrolling down
                        var messages_container = _("messages_container");
                        var message_text = _("message_text");
                        //to start typing immedeiatel again and for scrolling down
                        setTimeout(function (){
                            messages_container.scrollTo(0, messages_container.scrollHeight);
                            message_text.focus();
                        },0);
                        break;
                    case "settings":
                        SEEN_STATUS = "0";
                        inner_right_panel.innerHTML = '';
                        inner_left_panel.innerHTML = obj.message;
                        break;
                    case "save_settings":// sucessful saving of settings
                        get_data({}, "user_info");
                        get_data({}, 'settings');
                        break;
                    case "chats_refresh":
                        SEEN_STATUS = "0";
                        var messages_container = _("messages_container");
                        // console.log(obj.newMessage)
                        if(typeof obj.newMessage != 'undefined'){
                            if(obj.newMessage) {
                                // console.log(obj.newMessage)
                                messages_container.innerHTML = obj.messages;
                                receivedAudio.play();
                                //scrolling down
                                // var messages_container = _("messages_container");
                                // var message_text = _("message_text");
                                //to start typing immedeiatel again and for scrolling down
                                // setTimeout(function (){
                                //     messages_container.scrollTo(0, messages_container.scrollHeight);
                                //     message_text.focus();
                                // },0);
                            }
                        }
                        if(messages_container.innerHTML != obj.messages){
                            messages_container.innerHTML = obj.messages;

                        }
                        break;
                    case "error":
                        let error = _("error");
                        error.innerHTML = obj.message;
                        error.style.display = "block";
                        break;
                    case "alert":
                        let error_alert = _("error_alert");
                        error_alert.querySelector('h3').innerHTML = obj.message;
                        error_alert.style.display = "inline-flex";
                        setTimeout(function() {
                            error_alert.style.display = "none";
                        }, 5000); // 5000 milliseconds = 5 seconds
                        break;
                    case "send_image":
                    case "success":
                        let success_alert = _("success_alert");
                        success_alert.querySelector('h3').innerHTML = obj.message;
                        success_alert.style.display = "inline-flex";
                        setTimeout(function() {
                            success_alert.style.display = "none";
                        }, 5000); // 5000 milliseconds = 5 seconds
                        break;

                }
            }
        }
    }


    //get chat
    let chatsLabel = _("label_chat");
    chatsLabel.addEventListener("click", (e) => {
        CURRENT_CHAT_USER="";//to stop setInterval function that req new messages every 5 sec
        get_data({}, 'chats');
    })



    //to get contact data
    let contactLabel = _("label_contacts");
    contactLabel.addEventListener("click", (e) => {
        CURRENT_CHAT_USER="";//to stop setInterval function that req new messages every 5 sec
        get_data({}, 'contacts');
    })


    //send message
    function send_message(e) {
        var message_text = _("message_text");
        if (message_text.value.trim() == "") {
            alert("Please enter the message that you need to send!")
            return;
        }
        // alert(message_text.value);
        get_data({
            message: message_text.value.trim(),
            userID: CURRENT_CHAT_USER//send curent chatting user as userID ( who we are sending it to)
        }, "send_message");
    }




    //when press enter to send message
    function pressedEnter(e) {
        setSeen(e);
        if (e.keyCode == 13) {//when its Enter key
            send_message(e);
        }
    }

    //run this function everytime the user click on text box , so we know user has read the message
    function setSeen(e){
        SEEN_STATUS="1";
    }
</script>

<!--for settings-->
<script type="text/javascript">


    function collectData(event) {

        //disabling button
        let save_setting_button = _("save-settings-button");
        save_setting_button.disabled = true;
        save_setting_button.value = "Loading....";

        event.preventDefault();
        let signupForm = _("signupForm");
        let inputs = signupForm.getElementsByTagName("INPUT");

        let data = {};
        for (let i = inputs.length - 1; i >= 0; i--) {
            let key = inputs[i].name;

            switch (key) {
                case "username":
                    data.username = inputs[i].value;
                    break;
                case "email":
                    data.email = inputs[i].value;
                    break;
                case "password":
                    data.password = inputs[i].value;
                    break;
                case "newPassword":
                    data.newPassword = inputs[i].value;
                    break;
                case "gender":
                    if (inputs[i].checked) data.gender = inputs[i].value;
                    break;
            }
        }
        sendData(data, "save_settings");


    }

    //type - type of data. what to do with them eg: signup, login etc...
    function sendData(data, type) {
        let xml = new XMLHttpRequest();

        //listening
        xml.onload = function () {
            //readyState 4 means data got as a response successfully
            //200 means everything is good
            if (xml.readyState === 4 || xml.status === 200) {
                handleResult(xml.responseText);

                //re enabling button
                let save_setting_button = _("save-settings-button");
                save_setting_button.disabled = false;
                save_setting_button.value = "Save Settings";
            }
        }

        data.dataType = type;
        let data_string = JSON.stringify(data);//converting to string
        //sending
        //true for asynchronous
        xml.open("POST", "<?=ROOT?>/api.php", true);
        xml.send(data_string);

    }

</script>

<!--for profile image upload-->
<script>
    function upload_profile_image(files) {


        // console.log(files[0].name);
        let xml = new XMLHttpRequest();
        let changeImageLbl = _("changeImageLbl");

        //disabling label
        changeImageLbl.disabled = true;
        changeImageLbl.innerHTML = "Uploading......";

        let myForm = new FormData();

        //listening
        xml.onload = function () {
            //readyState 4 means data got as a response successfully
            //200 means everything is good
            if (xml.readyState === 4 || xml.status === 200) {
                // alert(xml.responseText);
                get_data({}, "user_info");
                get_data({}, 'settings');

                //re enabling button
                changeImageLbl.disabled = false;
                changeImageLbl.innerHTML = "Change Image";
            }
        }

        myForm.append('file', files[0]);
        myForm.append('dataType', "change_profile_image");
        //sending
        //true for asynchronous
        xml.open("POST", "<?=ROOT?>/uploader.php", true);
        xml.send(myForm);
    }
</script>


<!--for drag and drop for uploading-->
<script>
    function handleDragAndDrop(e) {
        if (e.type == "dragover") {
            e.preventDefault();
            e.target.className = "dragging";
        } else if (e.type == "dragleave") {
            e.preventDefault();
            e.target.className = "";
        } else if (e.type == "drop") {
            e.preventDefault();
            e.target.className = "";

            upload_profile_image(e.dataTransfer.files);
        } else {
            // e.target.c
        }
    }
</script>


<!--chat-->
<script>
    function startChat(e) {

        let userID = e.target.getAttribute("userID");
        if (userID == null || userID == "") {
            userID = e.target.parentElement.getAttribute("userID");
            // console.log(userID)
        }

        CURRENT_CHAT_USER = userID;

        let radio_chat = _("radio_chat");
        radio_chat.checked = true;
        get_data({"userID": CURRENT_CHAT_USER}, 'chats');
    }

    //req msg every 5 sec
    setInterval(function (){

        //refresh chat
        var radio_chat=_("radio_chat");
        if(CURRENT_CHAT_USER!="" && radio_chat.checked){
            get_data({
                "userID": CURRENT_CHAT_USER,
                "seen": SEEN_STATUS
            }, 'chats_refresh');
        }

        var radio_contacts=_("radio_contacts");
        if(radio_contacts.checked){
            get_data({},"contacts");
        }
    },5000);


</script>

<!--delete message-->
<script>
    function deleteMessage(e,messageID=null){
        let ans = confirm("Are you sure you want to delete this message? Note that the message will be deleted only from your side.");
        if (ans) {

            //sending delete
            get_data({
                rowID:messageID
            },"delete_message");

            //then refresh chat
            get_data({
                "userID": CURRENT_CHAT_USER,
                "seen": SEEN_STATUS
            }, 'chats_refresh');
        }
    }

    function deleteThread(e){
        let ans = confirm("Are you sure you want to delete this thread? Note that the message will be deleted only from your side.");
        if (ans) {

            //sending delete delete_thread req
            get_data({
                userID:CURRENT_CHAT_USER
            },"delete_thread");

            //then refresh chat
            get_data({
                "userID": CURRENT_CHAT_USER,
                "seen": SEEN_STATUS
            }, 'chats_refresh');
        }
    }
</script>

<!--file upload (image upload)-->
<script>
    function sendImages(files){
        let file=files[0];
        // console.log(files[0].name);
        let xml = new XMLHttpRequest();
        let myForm = new FormData();

        //listening
        xml.onload = function () {
            //readyState 4 means data got as a response successfully
            //200 means everything is good
            if (xml.readyState === 4 || xml.status === 200) {
                // alert(xml.responseText);
                handleResult(xml.responseText);
                //then refresh chat
                get_data({
                    "userID": CURRENT_CHAT_USER,
                    "seen": SEEN_STATUS
                }, 'chats_refresh');
            }
        }

        myForm.append('file', file);
        myForm.append('userID', CURRENT_CHAT_USER);
        myForm.append('dataType', "send_image");
        //sending
        //true for asynchronous
        xml.open("POST", "<?=ROOT?>/uploader.php", true);
        xml.send(myForm);


    }
</script>

<!--imageViewer-->
<script>
    function closeImage(e){
        let imageViewer=_("imageViewer");

        imageViewer.className="imageViewer_off";
    }

    function image_show(e){
        let imageViewer=_("imageViewer");
        var image=e.target.src;
        imageViewer.innerHTML="<img src='<?=ROOT?>/"+image+"' style='width:100%' />"
        imageViewer.className="imageViewer_on";
    }
</script>