<?php

//logout class
class Logout extends Controller{

    public function index(){
       Auth::logout();
       redirect('home');
    }
    
    
}