<link href="<?= ROOT ?>/assets/css/nav.styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/newHome.styles.css">

<style>




    .text-center {
        text-align: center !important;
    }

    .text-error {
        color: crimson !important;
        max-width: 350px;

    }

    .error-border {
        border-color: crimson !important;

    }

    .alert {
        padding: 20px;
        border: 1px solid #d4edda;
        border-radius: 10px;
        font-size: 18px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        position: fixed;
        top:150px
    }

    /*.alert-danger {*/
    /*    background-color: #dc3545;*/
    /*    color: #fff;*/
    /*    border: 1px solid #dc3545;*/
    /*    border-radius: 5px;*/
    /*    padding: 15px;*/
    /*    font-size: 16px;*/
    /*    margin-bottom: 10px;*/
    /*    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);*/
    /*}*/


    /*.alert-success {*/
    /*    background-color: #198754;*/
    /*    color: #fff;*/
    /*    border: 1px solid #198754;*/
    /*    border-radius: 5px;*/
    /*    padding: 15px;*/
    /*    font-size: 16px;*/
    /*    margin-bottom: 10px;*/
    /*    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);*/
    /*}*/
</style>
<body>
<?php if (message()) : ?>
    <div class=" alert <?= (message()[1] == 'success') ? 'alert-success' : 'alert-danger'; ?> " id="alert">
        <h3><?= message([], true)[0] ?></h3>
    </div>
<?php endif; ?>
<header style="position: static;z-index: 9999;background-color: #1c452d">
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
                <li><a href="<?= ROOT ?>/<?= Auth::getrole() ?>">Dashboard</a></li>
                <li><a href="<?= ROOT ?>/logout">Logout</a></li>
            <?php endif; ?>

        </ul>

        <span id="hamburger-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
    </nav>
</header>

<!-- checkbox is to to show grid lines -->
<!-- <input type="checkbox" id="gridlines"/> -->

<div id="main-wrapper">

    <!-- main-wrapper gridlines -->
    <!-- <div id="grid">
    <p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
</div> -->

    <!-- //if msg type is success add css class alert-sucess else add alert-danger -->
    <?php if (message()) : ?>
        <div class=" alert <?= (message()[1] == 'success') ? 'alert-success' : 'alert-danger'; ?> " id="alert">
            <h3><?= message([], true)[0] ?></h3>
        </div>
    <?php endif; ?>



     <!-- importing js -->
  <script type="text/javascript" src="<?= ROOT ?>/assets/js/search.js"></script>