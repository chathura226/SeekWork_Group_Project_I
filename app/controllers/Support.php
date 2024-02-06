<?php

//Terms class
class Support extends Controller{

    public function index(){
        
        $data['title'] = "Help and Support";
        
        $this->view('support',$data);
    }
    public function help(){

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $supportInstance=new SupportModel();
            $supportInstance->insert($_POST);
            message("Support request sent successfully!");
            redirect('support');
        }
        $data['title'] = "Contact Us";

        $this->view('contactus',$data);
    }
    
}