function load_image(file){

    //linking local resource
    var myLink=window.URL.createObjectURL(file);
    document.getElementById("uploadedImage").src=myLink;
    document.getElementById("uploadedImage").style.display="block";
    
    }

    
    
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const uploadedImage = document.getElementById('uploadedImage');

    imageInput.addEventListener('change', function() {
        const file = imageInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                uploadedImage.src = e.target.result;
                uploadedImage.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            uploadedImage.src = '';
            uploadedImage.style.display = 'none';
        }
    });
});


