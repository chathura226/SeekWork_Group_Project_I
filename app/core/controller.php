<?php

//main controller class., controllers in 
//controllers folder will be childrens of this

class Controller{

    public function view($view,$data=[]){

        extract($data); //goes through array and make every value variables in coresponding names

        $filename = "../app/views/".$view.".view.php";
        if(file_exists($filename)){
            require $filename;
        }else{
            echo "Couldn't find the view file ".$filename;
        }
    }

}