document.addEventListener('DOMContentLoaded', function() {
    const confirmationForm = document.getElementById('confirmationForm');
    const messageDiv = document.getElementById('message');

    confirmationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Get values from the form
        const paymentReceived = document.getElementById('paymentReceived').value;
        const receivedDate = document.getElementById('receivedDate').value;
        const additionalInfo = document.getElementById('additionalInfo').value;

        // Perform validation if needed
        if (!paymentReceived || !receivedDate) {
            messageDiv.innerHTML = 'Please fill in all required fields.';
            return;
        }

        // Process the form data (you can send it to a server or handle it as needed)
        // For this example, display a success message
        messageDiv.innerHTML = 'Payment confirmation received!';

        // Reset the form fields
        confirmationForm.reset();
    });
});
