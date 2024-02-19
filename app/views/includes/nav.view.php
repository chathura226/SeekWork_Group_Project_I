<link href="<?= ROOT ?>/assets/css/nav.styles.css" rel="stylesheet">

<header class="">

    <nav class="myNav">
        <!-- <a href="<?= ROOT ?>">
            <img src="../public/assets/images/logo.png" alt="SekkWork">
        </a> -->
        <div class="left-menu">
            <a href="<?= ROOT ?>/home">
                <div class="my-button">
                    <button class="button">Home</button>
                </div>
            </a>
            <a href="<?= ROOT ?>/about">
                <div class="my-button">
                    <button class="button">About Us</button>
                </div>
            </a>
            <a href="<?= ROOT ?>/support">
                <div class="my-button">
                    <button class="button">Help & Support</button>
                </div>
            </a>
            <?php if (Auth::logged_in()) : ?>
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>">
                    <div class="my-button">
                        <button class="button">Dashboard</button>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <div class="right-menu">


            <?php if (!Auth::logged_in()) : ?>
                <a href="<?= ROOT ?>/signup">
                    <div class="my-button"><button class="button">Sign up</button></div>
                </a>
                <a href="<?= ROOT ?>/login"><button class="login-button"><span>Login</span></button></a>
            <?php else : ?>
                <div class="profile-name">Hi, <?= ucfirst(Auth::getfirstName()) ?></div>
                <a href="<?= ROOT ?>/logout"><button class="login-button"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="svg-icons">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                        </svg><span>Logout</span></button></a>
            <?php endif; ?>
        </div>
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