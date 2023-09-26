document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('reviewForm');
    const successMessage = document.getElementById('successMessage');

    reviewForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // You can handle the form submission here, e.g., send data to a server using AJAX

        // For demonstration purposes, let's show a success message
        successMessage.style.display = 'block';
        reviewForm.reset();

        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 3000);
    });
});
