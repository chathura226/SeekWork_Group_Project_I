const profileImage = document.getElementById('profile-img');
const imageUpload = document.getElementById('image-upload');
const uploadBtn = document.getElementById('upload-btn');
const deleteBtn = document.getElementById('delete-btn');
const saveBtn = document.getElementById('save-btn');

uploadBtn.addEventListener('click', () => {
    imageUpload.click();
});

imageUpload.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

deleteBtn.addEventListener('click', () => {
    profileImage.src = 'default-profile-image.png';
    imageUpload.value = '';
});

saveBtn.addEventListener('click', () => {
    // Retrieve user input and save to a server/database
    const fullName = document.getElementById('full-name').value;
    const about = document.getElementById('about').value;
    const address = document.getElementById('address').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const socialMedia = document.getElementById('social-media').value;
    const linkedin = document.getElementById('linkedin').value;
    const bankAccount = document.getElementById('bank-account').value;

    
});
