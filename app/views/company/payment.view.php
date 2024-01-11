
<html>
<body>
<form method="post" action="https://sandbox.payhere.lk/pay/checkout">
    <input type="hidden" name="merchant_id" value="<?=$merchantID?>">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="<?=ROOT?>/company/payments">
    <input type="hidden" name="cancel_url" value="<?=ROOT?>/company/payments">
    <input type="hidden" name="notify_url" value="https://17a7-212-104-237-129.ngrok-free.app/public/payment">
    </br></br>Item Details</br>
    <input type="text" name="order_id" value="<?=$order_id?>">
    <input type="text" name="items" value="<?=$items?>">
    <input type="text" name="currency" value="<?=$currency?>">
    <input type="text" name="amount" value="<?=$amount?>">
    </br></br>Customer Details</br>
    <input type="text" name="first_name" value="<?=$first_name?>">
    <input type="text" name="last_name" value="<?=$last_name?>">
    <input type="text" name="email" value="<?=$email?>">
    <input type="text" name="phone" value="<?=$phone?>">
    <input type="text" name="address" value="<?=$address?>">
    <input type="text" name="city" value="Colombo">
    <input type="hidden" name="country" value="<?=$country?>">
    <input type="hidden" name="hash" value="<?=$hash?>">    <!-- Replace with generated hash -->
    <input type="submit" value="Pay Now">
</form>
</body>
</html>