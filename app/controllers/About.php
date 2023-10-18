<?php

//about us class 
class About extends Controller
{

    public function index(){
        $data['title']="About us";
        $this->view("aboutus",$data);
    }
}