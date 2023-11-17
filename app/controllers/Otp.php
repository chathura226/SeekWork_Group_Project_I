<?php

//otp class 
class Otp extends Controller
{

    public function index(){
        if(!Auth::logged_in()){//if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }

        //if OTP is verified redirect to their dashboard
        if (Auth::is_otp_verified()) { ///if not a student, redirect to home
            message('You are already verified your email!');
            redirect(Auth::getrole());
        }

        //post method-> submitting verification code
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $otpInst=new OtpModel();
            $row=$otpInst->first(['userID'=>Auth::getuserID(),'otpCode'=>$_POST['otpCode']]);

            if(!empty($row)){//there is a match
                $currentTime=time();
                $expireTime=strtotime($row->expireAt);//converting to unix timestamp to compare
                
                if($expireTime>=$currentTime){//code is valid
                    $userInst=new User();
                    $userInst->update(['isOTPVerified'=>1],Auth::getuserID());
                    Auth::updateSession();//to update that the user is verified
                    message('Email Verified Successfully!');
                    redirect(Auth::getrole());
                }else{//code is expired
                    message('OTP is expired !');
                    redirect('otp');
                }
            }else{
                message('Invalid OTP !');
                redirect('otp');
            }
        }

        $length=10;//length of OTP
        $string = uniqid(rand());//generate uniqid
        $randomString = substr($string, 0, $length);//10 characters from the random string

        $var['otpCode']=$randomString;
        $var['userID']=Auth::getuserID();

        $timeStamp=time();
        $var['updatedAt']=date('Y-m-d H:i:s',$timeStamp);;
        $var['expireAt']=date('Y-m-d H:i:s',$timeStamp+(10*60));//add 10 min to the current time

        $otpInst=new OtpModel();
        $otpInst->insert($var);

        $fullName=Auth::getfirstName().' '.Auth::getlastName();
        $content="OTP code for your email verification is ".$var['otpCode'];

        if(!MailService::sendMail(Auth::getemail(),$fullName,'OTP for Email Verification',$content)){//if unsuccessful
            message('Sending OTP via Email Failed! Try again later');
            redirect('home');
        }

        $data['title']="OTP Verify";
        $this->view("otpVerify",$data);
    }
}