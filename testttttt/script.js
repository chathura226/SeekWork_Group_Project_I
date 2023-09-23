document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editProfileForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const fullName = document.getElementById('fullName').value;
        const email = document.getElementById('email').value;
        const profilePicture = document.getElementById('profilePicture').files[0];

        // You can handle the form data here, such as sending it to a server.

        // For demonstration purposes, we'll log the data to the console.
        console.log('Full Name:', fullName);
        console.log('Email:', email);
        console.log('Profile Picture:', profilePicture);
    });
});
