<?php

//Terms class
class Support extends Controller{

    public function index(){
        
        $data['title'] = "Help and Support";
        
        $this->view('support',$data);
    }
    public function help(){

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            show($_POST);die;
        }
        $data['title'] = "Contact Us";

        $this->view('contactus',$data);
    }
    
}