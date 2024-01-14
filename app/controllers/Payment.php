<?php

//for payment notify by payhere
class Payment extends Controller
{

    public function index()
    {

        //if a post request , verify the payment status and update the database
        // this will be the notify url for payhere
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $merchant_id = $_POST['merchant_id'];
            $order_id = $_POST['order_id'];
            $payhere_amount = $_POST['payhere_amount'];
            $payhere_currency = $_POST['payhere_currency'];
            $status_code = $_POST['status_code'];
            $md5sig = $_POST['md5sig'];

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

            if (($local_md5sig === $md5sig) and ($status_code == 2)) {

                Log::info("Payment notify",['post' => json_encode($_POST)]);

                try {
                    $pamentInst = new PaymentModel();
                    $pamentInst->query("update payment set paymentStatus='completed',paidDate='".date('Y-m-d H:i:s')."' WHERE paymentID='".$order_id."'",[]);//orderID is paymentID in my database

                } catch (Exception $e) {
                    // Code to handle other types of exceptions (if needed)
                    Log::info("Payment Error", ['post' => json_encode($e->getMessage())]);
                }
            }
            die;
        }


        $data['title'] = "404";
        $this->view("404", $data);
    }
}


