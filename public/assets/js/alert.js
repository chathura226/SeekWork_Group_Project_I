document.addEventListener('DOMContentLoaded', function() {
    const alertOverlay = document.getElementById('alert');

    alertOverlay.style.display = 'flex';
    setTimeout(function() {
        alertOverlay.style.display = 'none';
    }, 5000); // 5000 milliseconds (5 seconds)
});