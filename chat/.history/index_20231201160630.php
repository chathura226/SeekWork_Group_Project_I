<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>

    </head>
    <style type="text/css">

        #wrapper{

            max-width: 800px;
            min-height: 500px;
            display: flex;

        }

        #left_pannel{
            min-height: 400px;
            background-color: red;
            flex:1;


        }

        #right_pannel{
            min-height: 400px;
            background-color: green;
            flex:1;

        }




    </style>
    <body>
        <div id="wrapper">

           <div id="left_pannel">

           </div>
           <div id="right_pannel">
              <div id="header" ></div>
                <div id="container" >
                    <div id="inner_left_pannel"></div>
                    <div id="inner_right_pannel"></div>
                </div>
           </div>



        </div>


    </body>
</html>