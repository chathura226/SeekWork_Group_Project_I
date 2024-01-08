<!DOCTYPE html>
<html>
<head>
	<title>My Chat</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

	<div id="wrapper">
		
		<div id="left_pannel">

			<div id="user_info" style="padding: 10px;">
				<img id="profile_image" src="ui/images/user_male.jpg" style="height: 100px;width: 100px;">
				<br>
				<span id="username">Username</span>
				<br>
				<span id="email" style="font-size: 12px;opacity: 0.5;">email@gmail.com</span>
				
				<br>
				<br>
				<br>
				<div>
					<label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png"></label>
					<label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png"></label>
					<label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png"></label>
					<label id="logout" for="radio_logout">Logout <img src="ui/icons/logout.png"></label>
				</div>

			</div>

		</div>
		<div id="right_pannel">
			<div id="header">
				<div id="loader_holder" class="loader_on"><img style="width:70px;" src="ui/icons/giphy.gif"></div>

				<div id="image_viewer" class="image_off" onclick="close_image(event)"></div>
				My Chat
			</div>
			
			<div id="container" style="display: flex;">
 				
				<div id="inner_left_pannel">
			 
				</div>

				<input type="radio" id="radio_chat" name="myradio" style="display: none;">
				<input type="radio" id="radio_contacts" name="myradio" style="display: none;">
				<input type="radio" id="radio_settings" name="myradio" style="display: none;">
				
				<div id="inner_right_pannel">
					
				</div>

			</div>
		</div>

	</div>
</body>
</html>

<script type="text/javascript">
	
	var sent_audio = new Audio("message_sent.mp3");
	var received_audio = new Audio("message_received.mp3");

	var CURRENT_CHAT_USER = "";
	var SEEN_STATUS = false;

	function _(element){

		return document.getElementById(element);
	}

	var label_contacts = _("label_contacts");
	label_contacts.addEventListener("click",get_contacts);
	
	var label_chat = _("label_chat");
	label_chat.addEventListener("click",get_chats);
	
	var label_settings = _("label_settings");
	label_settings.addEventListener("click",get_settings);
	

	var logout = _("logout");
	logout.addEventListener("click",logout_user);

	function get_data(find,type){

		var xml = new XMLHttpRequest();
		var loader_holder = _("loader_holder");
		loader_holder.className = "loader_on";

		xml.onload = function (){

			if(xml.readyState == 4 || xml.status == 200){

				loader_holder.className = "loader_off";
				handle_result(xml.responseText,type);
			}

		}

		var data = {};
		data.find = find;
		data.data_type = type;
		data = JSON.stringify(data);

		xml.open("POST","api.php",true);
		xml.send(data);
	}

	function handle_result(result,type){

		if(result.trim() != ""){
			console.log(result)
			var inner_right_pannel = _("inner_right_pannel");
			inner_right_pannel.style.overflow = "visible";

			var obj = JSON.parse(result);
			if(typeof(obj.logged_in) != "undefined" && !obj.logged_in){

				window.location = "login.php";
			}else{

				switch(obj.data_type){

					case "user_info":
						var username = _("username");
						var email = _("email");
						var profile_image = _("profile_image");

						username.innerHTML =  obj.username;
						email.innerHTML =  obj.email;
						profile_image.src =  obj.image;
						break;

					case "contacts":
						
						var inner_left_pannel = _("inner_left_pannel");
 
						inner_right_pannel.style.overflow = "hidden";
						inner_left_pannel.innerHTML =  obj.message;
						break;

					case "chats_refresh":
						SEEN_STATUS = false;
						var messages_holder = _("messages_holder");
						messages_holder.innerHTML =  obj.messages;
						if(typeof obj.new_message != 'undefined'){
							if(obj.new_message){
								received_audio.play();

								setTimeout(function(){
									messages_holder.scrollTo(0,messages_holder.scrollHeight);
									var message_text = _("message_text");
									message_text.focus();
								},100);

							}
						}

						
						break;

					case "send_message":
						sent_audio.play();
					case "chats":
						SEEN_STATUS = false;
						var inner_left_pannel = _("inner_left_pannel");
 
						inner_left_pannel.innerHTML =  obj.user;
						inner_right_pannel.innerHTML =  obj.messages;

						var messages_holder = _("messages_holder");
						
						setTimeout(function(){
							messages_holder.scrollTo(0,messages_holder.scrollHeight);
							var message_text = _("message_text");
							message_text.focus();
						},100);
						
						if(typeof obj.new_message != 'undefined'){
							if(obj.new_message){
								received_audio.play();
							}
						}

						break;

					 
					case "settings":
						var inner_left_pannel = _("inner_left_pannel");
 
						inner_left_pannel.innerHTML =  obj.message;
						break;
					
					case "send_image":
						alert(obj.message);
						break;
					case "save_settings":
  
						alert(obj.message);
						get_data({},"user_info");
						get_settings(true);
						break;
					
  

				}
			}
		}
	}

	function logout_user()
	{
		var answer = confirm("Are you sure you want to log out??");
		if(answer){
			get_data({},"logout");
		}
	}

	get_data({},"user_info");
	get_data({},"contacts");
	
	var radio_contacts = _("radio_contacts");
	radio_contacts.checked = true;

	function get_contacts(e)
	{

		get_data({},"contacts");
	}

	function get_chats(e)
	{

		get_data({},"chats");
	}

	function get_settings(e)
	{

		get_data({},"settings");
	}
	
	function send_message(e)
	{

		var message_text = _("message_text");
		if(message_text.value.trim() == ""){
			
			alert("please type something to send");
			return;
		}

 		get_data({

			message:message_text.value.trim(),
			userid :CURRENT_CHAT_USER

		},"send_message");

	}

	function enter_pressed(e)
	{
		if(e.keyCode == 13)
		{
			send_message(e);
		}

		SEEN_STATUS = true;
	}

	setInterval(function(){

		var radio_chat = _("radio_chat");
		var radio_contacts = _("radio_contacts");

		if(CURRENT_CHAT_USER != "" && radio_chat.checked)
		{
			
    			get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
		}

		
		if(radio_contacts.checked)
		{
			
    		get_data({},"contacts");
		}
 
  
	},5000);

	function set_seen(e){

		SEEN_STATUS = true;
	}

	function delete_message(e)
	{

		if(confirm("Are you sure you want to delete this message??")){

			var msgid = e.target.getAttribute("msgid");
			get_data({
    				rowid:msgid
    			},"delete_message");

			get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
		}
	}

	function delete_thread(e)
	{

		if(confirm("Are you sure you want to delete this whole thread??")){

 			get_data({
    				userid:CURRENT_CHAT_USER
    			},"delete_thread");

			get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
		}
	}


</script>

<script type="text/javascript">

  
   	function collect_data(){

   		var save_settings_button = _("save_settings_button");
   		save_settings_button.disabled = true;
   		save_settings_button.value = "Loading...Please wait..";

   		var myform = _("myform");
   		var inputs = myform.getElementsByTagName("INPUT");

   		var data = {};
   		for (var i = inputs.length - 1; i >= 0; i--) {

   			var key = inputs[i].name;

   			switch(key){

   				case "username":
   					data.username = inputs[i].value;
   					break;

   				case "email":
   					data.email = inputs[i].value;
   					break;

   				case "gender":
    				if(inputs[i].checked){
   						data.gender = inputs[i].value;
   					}
   					break;

   				case "password":
   					data.password = inputs[i].value;
   					break;

   				case "password2":
   					data.password2 = inputs[i].value;
   					break;

   			}
   		}

   		send_data(data,"save_settings");

   	}

   	function send_data(data,type){

   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

   				handle_result(xml.responseText);
   				var save_settings_button = _("save_settings_button");
   				save_settings_button.disabled = false;
   				save_settings_button.value = "Signup";
   			}
   		}

		data.data_type = type;
		var data_string = JSON.stringify(data);

		xml.open("POST","api.php",true);
		xml.send(data_string);
   	}

   
   	function upload_profile_image(files){

   		var filename = files[0].name;
   		var ext_start = filename.lastIndexOf(".");
   		var ext = filename.substr(ext_start + 1,3);
   		if(!(ext == "jpg" || ext == "JPG")){

   			alert("This file type is not allowed");
   			return;
   		}

    	var change_image_button = _("change_image_button");
   		change_image_button.disabled = true;
   		change_image_button.innerHTML = "Uploading Image...";

   		var myform = new FormData();

   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

   				//alert(xml.responseText);
   				get_data({},"user_info");
				get_settings(true);
   				change_image_button.disabled = false;
   				change_image_button.innerHTML = "Change Image";
   			}
   		}

		myform.append('file',files[0]);
		myform.append('data_type',"change_profile_image");
 
		xml.open("POST","uploader.php",true);
		xml.send(myform);
   	}


   	function handle_drag_and_drop(e){

   		if(e.type == "dragover"){

   			e.preventDefault();
   			e.target.className = "dragging";

   		}else if(e.type == "dragleave"){

   			e.target.className = "";

   		}else if(e.type == "drop"){

   			e.preventDefault();
   			e.target.className = "";

    		upload_profile_image(e.dataTransfer.files);
   		}else{

   			e.target.className = "";
   		}
   	}


   	function start_chat(e){

   		var userid = e.target.getAttribute("userid");
   		if(e.target.id == ""){
   			userid = e.target.parentNode.getAttribute("userid");
   		}
   		
   		CURRENT_CHAT_USER = userid;

   		var radio_chat = _("radio_chat");
   		radio_chat.checked = true;
   		get_data({userid:CURRENT_CHAT_USER},"chats");

   	}

   	function send_image(files){

   		var filename = files[0].name;
   		var ext_start = filename.lastIndexOf(".");
   		var ext = filename.substr(ext_start + 1,3);
   		if(!(ext == "jpg" || ext == "JPG")){

   			alert("This file type is not allowed");
   			return;
   		}

     	var myform = new FormData();
   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

   				handle_result(xml.responseText,"send_image");
   		 		get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
   			}
   		}

		myform.append('file',files[0]);
		myform.append('data_type',"send_image");
		myform.append('userid',CURRENT_CHAT_USER);
 
		xml.open("POST","uploader.php",true);
		xml.send(myform);
   	}

   	function close_image(e){

   		e.target.className = "image_off";
   	}

   	function image_show(e){

   		var image = e.target.src;
   		var image_viewer = _("image_viewer");

   		image_viewer.innerHTML = "<img src='"+image+"' style='width:100%' />";
   		image_viewer.className = "image_on";
   	}



</script>
