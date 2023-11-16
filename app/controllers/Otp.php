<?php

//otp class 
class Otp extends Controller
{

    public function index(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }

        
        $data['title']="OTP Verify";
        $this->view("otpVerify",$data);
    }
}