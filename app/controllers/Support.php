<?php

//Terms class
class Support extends Controller{

    public function index(){
        
        $data['title'] = "Help and Support";
        
        $this->view('support',$data);
    }
    
}