<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


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
    "merchant_id": "121XXXX",    // Replace your Merchant ID
    "return_url": undefined,     // Important
    "cancel_url": undefined,     // Important
    "notify_url": "http://sample.com/notify",
    "order_id": "ItemNo12345",
    "items": "Door bell wireles",
    "amount": "1000.00",
    "currency": "LKR",
    "hash": "45D3CBA93E9F2189BD630ADFE19AA6DC", // *Replace with generated hash retrieved from backend
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
    console.log("dd");
    payhere.startPayment(payment);
};