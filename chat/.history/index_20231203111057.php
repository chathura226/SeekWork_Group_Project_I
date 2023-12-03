<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>

    </head>
    <style type="text/css">

        @font-face {
            font-family: headFont;
            src: url(ui/fonts/Summer-Vibes-OTF.otf);
        }

        @font-face {
            font-family: myfont;
            src: url(ui/fonts/OpenSans-Regular.ttf);
        }
        

        #wrapper{

            max-width: 900px;
            min-height: 500px;
            display: flex;
            margin:auto;
            color:white;
            font-family:myfont;
            font-size:13px;

        }

        #left_pannel{
            min-height: 400px;
            background-color: #27344b;
            flex:1;
            text-align:center;
           
            


        }

        #profile_image{
            width:50%;
            border:solid thin white;
            border-radius:50%;
            margin:10px;
            
           
        }


        #left_pannel label{
            width:100%;
            height: 20px;
            display:block;
            background-color:#404b56;
            border-bottom:solid thin #ffffff55;
            cursor: pointer;
            padding: 5px;
            transition: all 1s ease 1s;
         
            
        }


        #left_pannel label:hover{

            background-color:#778593;

        }


        #left_pannel label img{
            float:right;
            width:25px;

            
         
            
        }

        #right_pannel{
            min-height: 500px;
            flex:4;
            text-align: center;

        }

        #header{
            background-color: #485b6c;
            height: 70px;
            font-size:40px;
            text-align:center;
            font-family:headFont;


        }

        #inner_left_pannel{
            background-color:#383e48;
            flex:1;
            min-height:430px


        }

        #inner_right_pannel{
            background-color:#f2f7f8;
            flex:2;
            min-height:430px;


        }




    </style>
    <body>
        <div id="wrapper">

           <div id="left_pannel">
                <div style="padding: 10px;">
                    <img id="profile_image" src="ui/images/user3.jpg">
                    <br>
                    kelly hartmann
                    <br>
                    <span style="font-size:12px; opacity:0.5;">kellyhartmann@gmail.com</span>
                    <br>
                    <br>
                    <br>
                    <div>
                        <label for ="box">Chat<img src="ui/icons/chat.png"></label>
                        <label>Contacts<img src="ui/icons/contacts.png"></label>
                        <label>Settings<img src="ui/icons/settings.png"></label>
                    </div>    

                </div>
           </div>
           <div id="right_pannel"> 
              <div id="header" >My Chat</div>
                <div id="container"  style="display: flex">
                    <div id="inner_left_pannel">
                        <input type="checkbox" id="box">
                    </div>
                    <div id="inner_right_pannel"></div>
                </div>
           </div>



        </div>


    </body>
</html>