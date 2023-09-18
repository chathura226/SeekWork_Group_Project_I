<?php

//home class
class Home extends Controller{

    public function index(){
        
        $data['title'] = "Home";
        
        $this->view('home',$data);
    }
    
    public function edit(){
        echo "Home page editing";
    }

    public function delete(){
        echo "Home page deleting";
    }
}