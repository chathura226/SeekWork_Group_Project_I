
<?php
$amount=3000;
$merchant_id="1224435";
$order_id=uniqid();
$merchant_secret="MzY1NTkxMzIwMTQ4NDU3NzM5MTQwNTU0MjI0MTIxODQ2NjQ0NTU1";
$currency="LKR";
$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array=[];
$array["amount"]=$amount;
$array["merchant_id"]=$merchant_id;
$array["order_id"]=$order_id;
$array["currency"]=$currency;
$array["hash"]=$hash;

$jsonObj=json_encode($array);
echo $jsonObj;
?>

<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<button type="submit" id="payhere-payment" >PayHere Pay</button>
<script>
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "<?=$merchant_id?>",    // Replace your Merchant ID
        "return_url": "<?=ROOT?>/assets/js/payhere.js",     // Important
        "cancel_url": undefined,     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": "<?=$order_id?>",
        "items": "Door bell wireles",
        "amount": "<?=$amount?>",
        "currency": "<?=$currency?>",
        "hash": "<?=$hash?>", // *Replace with generated hash retrieved from backend
        "first_name": "Saman",
        "last_name": "Perera",
        "email": "samanp@gmail.com",
        "phone": "0771234567",
        "address": "No.1, Galle Road",
        "city": "Colombo",
        "country": "Sri Lanka",
        "delivery_address": "No. 46, Galle road, Kalutara South",
        "delivery_city": "Kalutara",
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
    };
</script>

