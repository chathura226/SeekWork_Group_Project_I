<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeekWork</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/newHome.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loader.styles.css">

    <title><?= $title ?> | <?= APP_NAME ?></title>
    <!-- fonts -->
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/assets/css/custom-fonts.css">
    <!-- Favicons -->
    <link href="<?= ROOT ?>/assets/images/favicon.ico" rel="icon">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/alerts.styles.css">
</head>

<!--styles for alert-->
<style>
    .error-border{
        border-color: crimson !important;

    }

    .alert{
        background-color: #f8d7da;
        color: #721c24;
        padding: 20px;
        border: 1px solid #d4edda;
        border-radius: 10px;
        font-size: 18px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>
<!--styles for search-->
<style>

    .centerbox-cont {
        max-width: 620px;
    }

    /*.centerbox {*/
    /*    position: relative;*/
    /*    top: 50%;*/
    /*    left: 50%;*/
    /*    transform: translate(-50%, -50%);*/
    /*    !*width: 676px;*!*/
    /*    min-height: 52px;*/
    /*    !*z-index: 2*!*/
    /*}*/
    /**/
    .centerbox h1 {
        margin-bottom: 25px;
        font-size: 36px;
        font-weight: normal;
        text-align: center;
    }

    .centerbox p.description {
        margin-bottom: 40px;
        text-align: center;
    }

    .description a {
        text-decoration: none;
    }

    .main-input {
        background: #fff;
        height: 50px;
        width: 327px;
        /*color: #a7b1ab;*/
        border: 1px solid #cccccc;
        margin-bottom: 0px;
        border-radius: 4px 0px 0px 4px;
        display: inline-block;
        text-align: left;
        font-size: 16px;
        font-weight: 500;
        padding: 0px 0px 0px 57px;
        font-size: 16px;
        border-right: 0px;
        background: #ffffff url("<?=ROOT?>/assets/images/search.png") 18px 15px no-repeat;
        background-size: 18px 18px;
        float: left;
    }

    .main-location {
        display: none;
    }

    #main-submit {
        background: #3cb13c;
        color: #fff;
        display: inline-block;
        font-size: 19px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        margin-bottom: 0px;
        border-radius: 0px 4px 4px 0px;
        width: 141px;
        height: 50px;
        border: 0px;
        padding-top: 0px;
        float: left;
    }

    #main-submit:hover {
        background: #00a221;
        color: #fff !important;
    }

    #main-submit-mobile {
        display: none;
    }


    .main-btn {
        display: inline-block;
        width: 150px;
        height: 50px;
        border: 1px solid #cccccc;
        padding: 0px;
        /*position: relative;*/
        float: left;
        border-right: 0px;
        background: #ffffff url("<?=ROOT?>/assets/images/main-bullet.png") 122px 23px no-repeat;
        background-size: 6px 6px;
        cursor: pointer;
    }

    .search-small {
        font-size: 12px;
        margin: 0px;
        color: #9B9B9B;
        /*position: relative;*/
        top: 6px;
        left: 16px;
        display: inline-block;
        width: 105px;
        /*height: 20px;*/
        text-align: left;
    }

    .search-large {
        font-size: 16px;
        margin: 0px;
        color: #4A4A4A;
        /*position: relative;*/
        top: 19px;
        left: 16px;
        display: inline-block;
        width: 105px;
        /*height: 20px;*/
        font-weight: 900;
        text-align: left;
    }

    .main-form-container {
        height: 50px;
        /*position: relative;*/
    }

    ul.search-description {
        width: 150px;
        position: relative;
        background: #fff;
        right: -327px;
        top: 49px;
        border-radius: 2px;
        padding: 14px 0px;
        border: 1px solid #E5E5E5;
        display: none;
        -webkit-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
    }

    .search-description li {
        font-size: 16px;
        color: #4A4A4A;
        font-weight: 900;
        padding: 6px 0px;
        display: block;
        padding-left: 16px;
        cursor: pointer;
    }

    .search-description li:hover {
        background: #f8f8f8;
    }

    .category_tabs {
        display: flex;
        background-color: white;
        justify-content: center;
        align-items: center;
        height: auto;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        border-bottom: solid thick transparent;

    }

    .category_tabs:hover {
        border-bottom: solid thick var(--primary-color-dark);
        cursor: pointer;
    }


    @media screen and (max-width: 900px) {

        .centerbox-cont {
            margin: auto;
            max-width: 477px;
        }

        #main-submit {
            width: 477px;
        }


    }


    .banner-n-container {
        width: 100%;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .banner-n {
        padding: 10px;
        width: 100%;
        max-width: 1400px;
        display: flex;
        flex-direction: column;
        row-gap: 20px;
        background-color: #550323FF;
        border-radius: 20px;
        height: 280px;
        align-items: center;
        justify-content: center;

    }

    .join-btn-new {
        font-size: 1rem;
        align-items: center;
        height: 45px;
        width: 130px;
        border-radius: 0.4rem;
        font-weight: 600;
        padding: 0 1.2rem;
        color: #ddd;
        border: none;
        cursor: pointer;
        box-shadow: 0 0.5rem 1rem rgba(143, 142, 142, 0.15) !important;
        background: #000000;
    }


    /*slider*/
    body-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #EFEFEF;
    }

    .slide-content {
        margin: 0 40px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .card {
        margin: 10px;
        width: 320px;
        min-width: 320px;
        border-radius: 25px;
        background-color: #fff;

    }

    .image-content,
    .card-content {
        padding: 15px 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card-content {
        height: 150px;
    }

    .image-content {
        position: relative;
        row-gap: 5px;
        padding: 25px 0;
    }

    .name {
        font-size: 18px;
        font-weight: 500;
        color: #333;
    }

    .description {
        font-size: 14px;
        color: #707070;
        text-align: center;
    }

    .button {
        border: none;
        color: #fff;
        font-size: 16px;
        padding: 8px 16px;
        background-color: #4070F4;
        border-radius: 6px;
        margin: 14px;
        cursor: pointer;
        transition: all 0.3s ease;

    }

    .button:hover {
        background: #265DF2;
    }

    .card-image {
        position: relative;
        height: 150px;
        width: 150px;
        border-radius: 50%;
        background: #FFF;
        padding: 3px;
    }

    .card-image .card-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #4070F4;
    }

    .overlay {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: #4070F4;
        border-radius: 25px 25px 0 25px;
    }

    .overlay::before,
    .overlay::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: -40px;
        height: 40px;
        width: 40px;
        background-color: #4070F4;
    }

    .overlay::after {
        border-radius: 0 25px 0 0;
        background-color: #fff;
    }

    .slide-container {
        /*max-width: 1120px;*/
        width: 100%;
        /*background-color: grey;*/
        padding: 40px 0;

    }

    .card-wrapper {
        display: flex;
        /*gap: 20px;*/
        overflow-x: hidden;
        width: 100%;
        /*flex-wr0ap: wrap;*/
    }

    .button-left {
        display: block;
        position: relative;
        width: 56px;
        height: 56px;
        margin: 0;
        overflow: hidden;
        outline: none;
        background-color: transparent;
        cursor: pointer;
        border: 0;
    }

    .button-left:before,
    .button-left:after {
        content: "";
        position: absolute;
        border-radius: 50%;
        inset: 7px;
    }

    .button-left:before {
        border: 4px solid #96daf0;
        transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
        transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
    }

    .button-left:after {
        border: 4px solid #19fc01;
        transform: scale(1.3);
        transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
        transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        opacity: 0;
    }

    .button-left:hover:before,
    .button-left:focus:before {
        opacity: 0;
        transform: scale(0.7);
        transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
        transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .button-left:hover:after,
    .button-left:focus:after {
        opacity: 1;
        transform: scale(1);
        transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
        transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
    }

    .button-box {
        display: flex;
        position: absolute;
        top: 0;
        left: 0;
    }

    .button-box-2 {
        display: flex;
        position: absolute;
        top: 0;
        right: 0;
    }

    .button-elem {
        display: block;
        width: 20px;
        height: 20px;
        margin: 17px 18px 0 18px;
        transform: rotate(180deg);
        fill: #09a44b !important;
    }

    .button-left:hover .button-box,
    .button-left:focus .button-box {
        transition: 0.4s;
        transform: translateX(-56px);
    }

    .button-left:hover .button-box-2,
    .button-left:focus .button-box-2 {
        transition: 0.4s;
        transform: translateX(56px);
    }

    /*for best part para*/
    .best-part{
        width: 100%;
    }
</style>
<body>
<div class="msg" style="position: fixed;margin: auto; top: 60px">


    <?php if (!empty($errors['email'])): ?>
        <div class="alert alert-danger text-center" id="alert"><?= $errors['email'] ?></div>
    <?php endif; ?>
</div>
<div class="loader-container">
    <img src="<?= ROOT ?>/assets/images/logo.png" alt="">
    <div class="loader">
        <div class="circle">
            <div class="dot"></div>
            <div class="outline"></div>
        </div>
        <div class="circle">
            <div class="dot"></div>
            <div class="outline"></div>
        </div>
        <div class="circle">
            <div class="dot"></div>
            <div class="outline"></div>
        </div>
        <div class="circle">
            <div class="dot"></div>
            <div class="outline"></div>
        </div>
    </div>
</div>
<header style="position: relative;background-color: #1c452d">
    <nav class="navbar">
        <a href="<?= ROOT ?>" class="logo">
            <img style="height: 40px;" src="<?= ROOT ?>/assets/images/newLogo/white text.svg" alt="SeekWork Logo">
        </a>
        <ul class="menu-links">
            <span id="close-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></span>
            <li><a href="<?= ROOT ?>">Home</a></li>
            <li><a href="<?= ROOT ?>/tasks"">Explore</a></li>
            <li><a href="<?= ROOT ?>/about"">About us</a></li>
            <li><a href="<?= ROOT ?>/support"">Help & Support</a></li>
            <?php if (!Auth::logged_in()) : ?>
                <li><a href="<?= ROOT ?>/signup">Signup as a Company</a></li>
                <li><a href="<?= ROOT ?>/login">Login</a></li>
                <li><a href="<?= ROOT ?>/signup">Sign up</a></li>
            <?php else : ?>
                <li><a href="<?= ROOT ?>/<?=Auth::getrole()?>">Dashboard</a></li>
                <li><a href="<?= ROOT ?>/logout">Logout</a></li>
            <?php endif; ?>

        </ul>

        <span id="hamburger-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
    </nav>
</header>

<div style="background-size: cover;height: 100vh;width: 100%;background-image: url('<?=ROOT?>/assets/images/about1.jpg');object-fit: cover;width: 100%">
    <div style="position: relative;right: 0">
        <h1>Who Are We?</h1>
    </div>
</div>
<footer style=" background-color: #0a2c40">


    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Graphics & Design</a></li>
                    <li><a href="#">Writing & Translation</a></li>
                    <li><a href="#">Video & Animation</a></li>
                    <li><a href="#">Logo Design</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Support</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help & Safety</a></li>
                    <li><a href="#">Guides</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Learn</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Community</h4>
                <ul>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Affiliates</a></li>
                    <li><a href="#">Success Stories</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>About Us</h4>
                <div class="social-links">

                    <!-- facebook -->
                    <a href="#">
                        <svg height="1.1em" viewBox="0 0 512 512" class="svg-social">
                            <style>a svg {
                                    fill: #ffffff
                                }</style>
                            <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                        </svg>
                    </a>

                    <!-- twitter x -->
                    <a href="#">
                        <svg height="1.1em" viewBox="0 0 512 512" class="svg-social">
                            <style>a svg {
                                    fill: #ffffff
                                }</style>
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                    </a>

                    <!-- insta -->
                    <a href="#">
                        <svg height="1.1em" viewBox="0 0 448 512" class="svg-social">
                            <style>a svg {
                                    fill: #ffffff !important;
                                }</style>
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                        </svg>
                    </a>

                    <!-- tiktok -->
                    <a href="#">
                        <svg height="1.1em" viewBox="0 0 448 512" class="svg-social">
                            <style>a svg {
                                    fill: #ffffff
                                }</style>
                            <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </div>
</footer>

</body>

<!--search field-->

<script>
    searchType = 'title';
    document.getElementById('searchType').value = searchType;

    function toggleDrop() {
        doropM = document.querySelector('.search-description');
        doropM.style.display === 'none' ? doropM.style.display = 'block' : doropM.style.display = 'none';
    }

    function byValue(str) {
        toggleDrop();
        document.querySelector('.search-large').textContent = str.charAt(0).toUpperCase() + str.slice(1);
        searchType = str;
        document.getElementById('searchType').value = str;
    }

    function categorySearch(id) {
        window.location.href = "<?=ROOT?>/tasks/category/" + id;

    }
</script>

<!--showing menu in mobile mode-->
<script>
    const header = document.querySelector("header");
    const hamburgerBtn = document.querySelector("#hamburger-btn");
    const closeBtn = document.querySelector("#close-btn");

    // show/hide menu
    hamburgerBtn.addEventListener("click", () => {
        header.classList.toggle("show-mobile-menu");
    });

    //close menu
    closeBtn.addEventListener("click", () => {
        hamburgerBtn.click();
    })
</script>



<script src="<?= ROOT ?>/assets/js/alert.js"></script>

<script src="<?= ROOT ?>/assets/js/loader.js"></script>

<script>
    // for slider
    function slideRight() {
        var wrapper = document.querySelector('.card-wrapper');
        var scrollAmount = wrapper.clientWidth / 3;
        wrapper.scrollLeft += scrollAmount;
        wrapper.style.transition = 'scroll-left 0.5s ease';
    }

    function slideLeft() {
        var wrapper = document.querySelector('.card-wrapper');
        var scrollAmount = wrapper.clientWidth / 3;
        wrapper.scrollLeft -= scrollAmount;
        wrapper.style.transition = 'scroll-right 0.5s ease';
    }
</script>
</html>
