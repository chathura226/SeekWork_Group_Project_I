var modal = document.getElementById('popup1');

var link = document.getElementById('popupLink');

var closeBtn = document.getElementsByClassName('close')[0];

link.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default action of the link
    modal.style.display = 'block';
});

closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});