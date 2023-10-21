<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<link href="<?=ROOT?>/assets/css/home.styles.css" rel="stylesheet">


<section class="home-content">
        <div class="image-container">
            <img src="<?=ROOT?>/assets/images/home1.jpg" alt="Home">
        </div>
        <p>Some content here</p>
    </section>


    <script>
        window.addEventListener('scroll', function() {
    const imageContainer = document.querySelector('.image-container');
    const imagePosition = imageContainer.getBoundingClientRect().top;

    if (imagePosition < window.innerHeight / 2) {
        imageContainer.classList.add('scrolled');
    } else {
        imageContainer.classList.remove('scrolled');
    }
});
    </script>

<?php $this->view("includes/footer",$data);

