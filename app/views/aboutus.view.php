<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Directpay|OneTimePayment</title>
</head>
<div id="card_container"></div>
<body>
<script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>

<script>
    DirectPayCardPayment.init({
        container: 'card_container', //<div id="card_container"></div>
        merchantId: 'ES15612', //your merchant_id
        amount: "1000.00",
        refCode: "hvy6ng6", //unique referance code form merchant
        currency: 'LKR',
        type: 'ONE_TIME_PAYMENT',
        customerEmail: 'abc@mail.com',
        customerMobile: '+94712345674',
        description: '154 products',  //product or service description
        debug: true,
        responseCallback: responseCallback,
        errorCallback: errorCallback,
        logo: 'https://test.com/directpay_logo.png',
        apiKey: '013b6dc745f667a0b91aeada206eccf87e0449fb92dada480e79f7045bf40101'
    });

    //response callback.
    function responseCallback(result) {
        console.log("successCallback-Client", result);
        alert(JSON.stringify(result));
    }

    //error callback
    function errorCallback(result) {
        console.log("successCallback-Client", result);
        alert(JSON.stringify(result));
    }
</script>
</body>
</html>