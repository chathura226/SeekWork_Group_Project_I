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

        }

        #left_pannel{
            min-height: 400px;
            background-color: #27344b;
            flex:1;
            text-align:center;
           
            


        }

        #left_pannel img{
            width:50%;
            border:solid thin white;
            border-radius:50%;
            margin:10px;
            
           
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
                    <img src="ui/images/user3.jpg">
                    <br>
                    kelly hartmann
                    <br>
                    kellyhartmann@gmail.com
                </div>
           </div>
           <div id="right_pannel"> 
              <div id="header" >My Chat</div>
                <div id="container"  style="display: flex">
                    <div id="inner_left_pannel"></div>
                    <div id="inner_right_pannel"></div>
                </div>
           </div>



        </div>


    </body>
</html>