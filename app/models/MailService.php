<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../app/thirdParty/PHPMailer-master/src/Exception.php';
require '../app/thirdParty/PHPMailer-master/src/PHPMailer.php';
require '../app/thirdParty/PHPMailer-master/src/SMTP.php';

class MailService
{
    public static function sendMail($recipient_mail, $recipient_name, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP(); //send using smtp

            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->Host = MAILER_HOST;
            $mail->Username = MAILER_EMAIL;
            $mail->Password = MAILER_PASS;

            $mail->isHTML();
            $mail->addAddress($recipient_mail, $recipient_name);
            $mail->setFrom(MAILER_EMAIL, "SeekWork");
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;

        }catch (Exception $e) { //unsuccessful
            echo $e;
            die;
            return false;
        }
    }

    public static function prepareOTPEmail($fullName,$otp) {
        $email='<!DOCTYPE html>
        <html>
        
        <head>
            <meta charset="utf-8">
            <title>Email Template</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    font-family: Arial, sans-serif;
                }
        .header {
                    background: black;
                    color: white;
                   
                    padding: 40px 60px;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 0;
                    background: black;
                    color: white;
                }
        
                .content {
                    padding: 100px;
                    font-family: Inter, sans-serif;
                }
        
                
                .otp-section {
                    padding: 20px 60px;
        
                    
                }
        
                .otp-code {
                    background-color: #141414;
                    color: #fac337;
                    font-size: 20px;
                    font-weight: 600;
                    border-radius: 24px;
                    padding: 15px 20px;
                    margin: 20px 0;
                    text-align:center;
                }
        
                .info {
                    
                    padding: 20px 60px;
                    color: #757575;
                }
        
                .footer {
                    padding: 60px;
                    color: #757575;
                }
        
                .footer hr {
                    border: 1px solid #333333;
                    margin: 0;
                }
            </style>
        </head>
        
        <body>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="container">
                            <tr>
                               <td class="header">
                                    <img src="https://bit.ly/46vTlCU" alt="Logo">
                                    <div style="font-size: 50px; font-weight: 600; margin-top: 20px;">Your OTP for Email
                                        Verification</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="otp-section">
                                    Hi '.$fullName.',<br><br>
                                    <div style="font-size: 14px; font-weight: 500; margin-bottom: 20px;">Please copy and paste
                                        the OTP below to confirm your account.</div>
                                    <div class="otp-code">'.$otp.'</div>
                                    <div style="font-size: 14px; font-weight: 500;">Please note: The code will be only valid
                                        for the next 10 minutes.</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="info">
                                    <div style="font-size: 14px; font-weight: 500; margin-bottom: 10px;">You can also use the
                                        below button to navigate to OTP validation page.</div>
                                        <br>
                                    <div style="background: white; border-radius: 32px; padding: 10px 20px; display: inline-block;">
                                        <a href='.'"'.ROOT.'/otp"'.' style="text-decoration: none; color: black; font-weight: 600;">Validate
                                            using OTP</a>
                                    </div>
                                    <div style="font-size: 14px; font-weight: 500; margin-top: 20px;">If you didn’t try to
                                        sign-in or create an account on SeekWork, you can safely ignore this email.</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="footer">
                                    <hr>
                                    <div style="font-size: 20px; font-weight: 600; margin: 20px 0;">SeekWork</div>
                                    <div>Your platform for academic and professional success!</div>
                                    <div style="margin-top: 10px;">
                                        <a href="#" style="text-decoration: none; color: white; font-weight: 500; margin-right: 20px;">Help</a>
                                        <a href="#" style="text-decoration: none; color: white; font-weight: 500;">Unsubscribe</a>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <div>SeekWork</div>
                                        <div>Sri Lanka</div>
                                        <div>©2024 All rights reserved.</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>';

        return $email;
        
    }
}
