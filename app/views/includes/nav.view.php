<!-- checkbox is to to show grid lines -->
<input type="checkbox" id="gridlines"/>

<div id="main-wrapper">

<!-- main-wrapper gridlines -->
<div id="grid">
    <p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
</div>


<header >
<nav class="wrapper">
    <div class="column-3">
        <a href="<?=ROOT?>">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="SekkWork">
        </a>
    </div>
    <div class="navbar c-s-8 c-e-13">
    <div class="dropdown"><a href="<?=ROOT?>/home"><button class="dropdown dropbtn">Home</button></a></div>
        <div class="dropdown">
        <button class="dropbtn">Categories</button>
            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
        </div>
        </div>
        <div class="dropdown"><a href="<?=ROOT?>/about"><button class="dropdown dropbtn">About Us</button></a></div>
        

        <div class="profile-name">Hi, <?=Auth::getfirstName()?></div>

        <?php if(!Auth::logged_in()):?>
            <div class="dropdown"><a href="<?=ROOT?>/signup"><button class="dropdown dropbtn">Signup</button></a></div>
            <div class="dropdown"><a href="<?=ROOT?>/login"><button class="radiantButton">Login</button></a></div>
        <?php else:?>
            <div class="dropdown"><a href="<?=ROOT?>/logout"><button class="dropdown dropbtn">Logout</button></a></div>
        <?php endif;?>
    </div>

    
    
</nav>
</header>
    
