<?php

//otp class 
class Otp extends Controller
{

    public function index($action = null)
    {
        if (!Auth::logged_in()) { //if not logged in redirect to login page
            message('Please login to view the student section!');
            redirect('login');
        }

        //if OTP is verified redirect to their dashboard
        if (Auth::is_otp_verified()) { ///if not a student, redirect to home
            message('You are already verified your email!');
            redirect(Auth::getrole());
        }

        $minWaitTime=120;//min wait before req another


        //post method-> submitting verification code
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $otpInst = new OtpModel();
            $row = $otpInst->first(['userID' => Auth::getuserID(), 'otpCode' => $_POST['otpCode']]);

            if (!empty($row)) { //there is a match
                $currentTime = time();
                $expireTime = strtotime($row->expireAt); //converting to unix timestamp to compare

                if ($expireTime >= $currentTime) { //code is valid
                    $userInst = new User();
                    $userInst->update(['isOTPVerified' => 1], Auth::getuserID());
                    Auth::updateSession(); //to update that the user is verified
                    message('Email Verified Successfully!');
                    redirect(Auth::getrole());
                } else { //code is expired
                    message('OTP is expired !');
                    redirect('otp');
                }
            } else {
                message('Invalid OTP !');
                redirect('otp');
            }
        }

        if (!empty($action) && $action == 'get') { //if the user requesting an OTP
            $otpInst = new OtpModel();
            $row = $otpInst->first(['userID' => Auth::getuserID()]);
            if (!empty($row)) {
                $lastUpdatedTIme = strtotime($row->updatedAt);
                $currentTime = time();
                if (($lastUpdatedTIme+$minWaitTime) >= $currentTime) { //code is valid
                    message('You should wait for 2 minutes before retrying!');
                    redirect('otp');
                }
            }

            $length = 10; //length of OTP
            $string = uniqid(rand()); //generate uniqid
            $randomString = substr($string, 0, $length); //10 characters from the random string

            $var['otpCode'] = $randomString;

            $timeStamp = time();
            $var['updatedAt'] = date('Y-m-d H:i:s', $timeStamp);;
            $var['expireAt'] = date('Y-m-d H:i:s', $timeStamp + (10 * 60)); //add 10 min to the current time



            if (!empty($row)) { //theres a record in the otp table
                //updating exisiting record
                $otpInst->update($var,$row->otpID);
            } else { //theres no record -> new otp
                $var['userID'] = Auth::getuserID();
                $otpInst->insert($var);
            }

            $fullName = Auth::getfirstName() . ' ' . Auth::getlastName();
            $content = "Hello " . ucfirst(Auth::getfirstName()) . ",<br><br>Your OTP for email verification is: <strong>" . $var['otpCode'] . "</strong>.<br><br>Please use this OTP to complete your verification.<br>This is only valid for 10 minutes.<br><br>Regards,<br>SeekWork Team";

            if (!MailService::sendMail(Auth::getemail(), $fullName, 'OTP for Email Verification', $content)) { //if unsuccessful
                message('Sending OTP via Email Failed! Try again later');
                redirect('home');
            }
            message('OTP sent to your email address successfully!');
        
        }

        //if an otp has been sent already, send the last updated time as an data attribute
        $otpInst = new OtpModel();
        $row = $otpInst->first(['userID' => Auth::getuserID()]);
        if(!empty($row)){//theres an otp record
            $data['updatedAt']=strtotime($row->updatedAt);
        }


        $data['title'] = "OTP Verify";
        $this->view("otpVerify", $data);
    }
}
