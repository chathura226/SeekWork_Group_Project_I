<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- main stylesheet -->
  <link href="<?=ROOT?>/assets/css/styles.css" rel="stylesheet">

  <!-- fonts -->
  <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/custom-fonts.css">

  <!-- com ponents -->
  <link href="<?=ROOT?>/assets/css/radiantButton.styles.css" rel="stylesheet">

  <title><?=App::$pageName?> - <?=APP_NAME?></title>

  <!-- Favicons -->
  <link href="<?=ROOT?>/assets/images/favicon.png" rel="icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin-header.styles.css"/>
    <!-- <link href="<?=ROOT?>/assets/css/nav.styles.css" rel="stylesheet"> this is included in the admin-header style.css file with modifications -->
</head>

<body>


<!-- ------navbar-------- -->
<header class="" >

<nav class="myNav">
        

        <div class="right-menu">
            <svg height="1em" viewBox="0 0 512 512">
                <style>svg{fill:#ffffff; padding-right: 10px;}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
            </svg>
            <div class="search">
                <input type="text" name="text" placeholder="Search" class="search-input">
            </div>
            <p>&nbsp;&nbsp;</p>
            <p>&nbsp;&nbsp;</p>
           
            <?php if(!Auth::logged_in()):?>
                <a href="<?=ROOT?>/signup"><div class="my-button"><button class="button">Sign up</button></div></a>
                <a href="<?=ROOT?>/login"><button class="login-button"><span>Login</span></button></a>
            <?php else:?>
                <div class="profile-name">Hi, <?=ucfirst(Auth::getfirstName())?></div>
                <div class="profile-pic">
                    <img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture">
                </div>
                <a href="<?=ROOT?>/logout"><button class="login-button"><span>Logout</span></button></a>
            <?php endif;?>
        </div>
    </nav>
</header>
    

<!-- -------sidebar------- -->
    <div class="sidebar">
        <div class="logo"></div>
            <ul class="menu">
                <li class="active">
                    <a href="#" >
                        <svg height="1em" viewBox="0 0 512 512" class="svg-icons">
                            <path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM288 96a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM256 416c35.3 0 64-28.7 64-64c0-17.4-6.9-33.1-18.1-44.6L366 161.7c5.3-12.1-.2-26.3-12.3-31.6s-26.3 .2-31.6 12.3L257.9 288c-.6 0-1.3 0-1.9 0c-35.3 0-64 28.7-64 64s28.7 64 64 64zM176 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM96 288a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm352-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
                        </svg>
                        <span>Dashboard</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg height="1em" viewBox="0 0 448 512" class="svg-icons">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                        </svg>
                        <span>Profile</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Statistics</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Careers</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>FAQ</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Testimonials</span>  
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg height="1em" viewBox="0 0 512 512" class="svg-icons">
                            <path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                        </svg>
                        <span>Settings</span>  
                    </a>
                </li>
                <li class="logout">
                    <a href="#">
                        <svg height="1em" viewBox="0 0 512 512" class="svg-icons">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                        </svg>
                        <span>Logout</span>  
                    </a>
                </li>
            </ul>
        
    </div>

    <!-- ------------------scripts---------------- -->
    <script src="<?=ROOT?>/assets/js/admin-header.js"></script>
    <main>


