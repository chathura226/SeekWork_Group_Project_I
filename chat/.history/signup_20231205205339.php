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
            margin:auto;
            color:grey;
            font-family:myfont;
            font-size:13px;

        }

        form{
            margin:auto;
            padding:10px;
            width:100%;
            max-width: 400px;
        }

        input{
            padding:10px;
            margin:10px;
            width:98%;
            border-radius:5px;
            border:solid 1px grey;
        }

        input[type=submit]{
            width:104%;
            background-color:pink;
            cursor: pointer;
        }

        #header{
            background-color: #485b6c;
            height: auto;
            font-size:40px;
            text-align:center;
            font-family:headFont;
            width:100%;
            color:white;


        }


    </style>
    <body>
        <div id="wrapper">

        <div id="header">
            My Chat

            <div>Login</div>
        
        </div>

            <form>
                <input type="text"  name="username" placeholder="Username"><br>
                <input type="password"  name="password" placeholder="Password"><br>
                <input type="password"  name="password2" placeholder="Retype Password"><br>
                <input type="submit"  value="Sign up"><br>
            </form>


        </div>
    </body>
</html>

<script type="text/javascript">

    function _(element){
        return document.getElementById(element);
    }

    
   
    var label = _("label_chat");

    label.addEventListener("click",function(){

        var inner_pannel = _("inner_left_pannel");

        var ajax = new XMLHttpRequest();

        ajax.onload = function(){

            if(ajax.status==200 || ajax.readyState==4){

                inner_pannel.innerHTML = ajax.responseText;


            }


        }

        ajax.open("POST","file.txt",true);
        ajax.send();
       

    });



</script>    