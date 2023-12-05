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
            color:grey;
            font-family:myfont;
            font-size:13px;

        }

        form{
            margin:auto;
            padding:10px;
            background-color:black;
            width:100%;
            max-width: 40px;
        }


    </style>
    <body>
        <div id="wrapper">

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