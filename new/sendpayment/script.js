document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('paymentForm');
    const messageDiv = document.getElementById('message');

    paymentForm.addEventListener('submit', function(event) {
        event.preventDefault();
        

        messageDiv.innerHTML = 'Payment submitted successfully!';
    });
});
