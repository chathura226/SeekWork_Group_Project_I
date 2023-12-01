<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>

    </head>
    <style type="text/css">

        #wrapper{

            max-width: 900px;
            min-height: 500px;
            display: flex;
            margin:auto;

        }

        #left_pannel{
            min-height: 400px;
            background-color: red;
            flex:1;


        }

        #right_pannel{
            min-height: 500px;
            background-color: green;
            flex:4;

        }

        #header{
            background-color: #485b6c;
            height: 70px;

        }

        #inner_left_pannel{
            background-color:purple;
            flex:1;
            min-height:430px


        }

        #inner_right_pannel{
            background-color:pink;
            flex:2;
            min-height:430px;


        }




    </style>
    <body>
        <div id="wrapper">

           <div id="left_pannel">

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