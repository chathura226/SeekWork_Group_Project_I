document.addEventListener('DOMContentLoaded', function() {
    const alertOverlay = document.getElementById('alertOverlay');
    const alertMessage = document.getElementById('alertMessage');
    const showAlertButton = document.getElementById('showAlert');

    showAlertButton.addEventListener('click', function() {
        // Show the overlay and alert message
        alertOverlay.style.display = 'flex';
        
        // Set a timer to hide the alert after 3 seconds (adjust as needed)
        setTimeout(function() {
            alertOverlay.style.display = 'none';
        }, 3000); // 3000 milliseconds (3 seconds)
    });
});
