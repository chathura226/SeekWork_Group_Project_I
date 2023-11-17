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
            // echo $e;
            // die;
            return false;
        }
    }
}