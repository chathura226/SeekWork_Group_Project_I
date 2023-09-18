<?php

//Terms class
class Terms extends Controller{

    public function index(){
        
        $data['title'] = "Terms";
        
        $this->view('terms',$data);
    }
    
}