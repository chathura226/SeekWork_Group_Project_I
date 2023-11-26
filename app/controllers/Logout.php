<?php

//logout class
class Logout extends Controller{

    public function index(){
       Auth::logout();
       message(['Logged Out Successfully!','success']);
       redirect('home');
    }
    
    
}