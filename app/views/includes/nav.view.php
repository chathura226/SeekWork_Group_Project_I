<link href="<?=ROOT?>/assets/css/nav.styles.css" rel="stylesheet">

<header class="" >

<nav class="myNav">
        <!-- <a href="<?=ROOT?>">
            <img src="../public/assets/images/logo.png" alt="SekkWork">
        </a> -->
        <div class="left-menu">
            <a href="<?=ROOT?>/home">
                <div class="my-button">
                    <button class="button">Home</button>
                </div>
            </a>
            <a href="<?=ROOT?>/about">
                <div class="my-button">
                    <button class="button">About Us</button>
                </div>
            </a>
            <div class="my-drop-button">
                <button class="drop-button">Categories &nbsp; ▼</button>
                <div class="dropdown-content">
                <a id="top" href="#">Designing</a>
                <a id="middle" href="#">Web Development</a>
                <a id="bottom" href="#">Programming</a>
                </div>
            </div>
        </div>

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
                <a href="<?=ROOT?>/logout"><button class="login-button"><span>Logout</span></button></a>
            <?php endif;?>
        </div>
    </nav>
</header>
    
<!-- checkbox is to to show grid lines -->
<input type="checkbox" id="gridlines"/>

<div id="main-wrapper">

<!-- main-wrapper gridlines -->
<div id="grid">
    <p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
</div>

<?php if(message()):?>
    <div class=" alert alert-success " id="alert">
        <h3><?=message('',true)?></h3>
    </div>
<?php endif;?>