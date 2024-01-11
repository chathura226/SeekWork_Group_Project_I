<?php

//404 class page not found

class Payment extends Controller
{

    public function index(){

        //if a post request , verify the payment status and update the database
        // this will be the notify url for payhere
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $merchant_id         = $_POST['merchant_id'];
            $order_id            = $_POST['order_id'];
            $payhere_amount      = $_POST['payhere_amount'];
            $payhere_currency    = $_POST['payhere_currency'];
            $status_code         = $_POST['status_code'];
            $md5sig              = $_POST['md5sig'];

            $merchant_secret = MERCHANT_SECRET; // Replace with your Merchant Secret

            $local_md5sig = strtoupper(
                md5(
                    $merchant_id .
                    $order_id .
                    $payhere_amount .
                    $payhere_currency .
                    $status_code .
                    strtoupper(md5($merchant_secret))
                )
            );

            if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
                //TODO: Update your database as payment success
                Log::info("Payment Successful!",[]);

            }
            die;
        }



        $data['title']="404";
        $this->view("404",$data);
    }
}


