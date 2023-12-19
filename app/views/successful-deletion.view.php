<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
    <link href="<?=ROOT?>/assets/css/login.styles.css" rel="stylesheet">

    <div class="msg c-s-6 c-e-8">


        <?php if(!empty($errors['email'])):?>
            <div class="alert alert-danger text-center" id="alert"><?=$errors['email']?></div>
        <?php endif;?>
    </div>

<div class=" r-s-1 c-s-5 c-e-9" style="margin: auto;display: flex;flex-direction: column;align-items: center">

    <svg style="fill: green;" xmlns="http://www.w3.org/2000/svg" height="200" width="200" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
    </svg>

    <h2>Account Deleted Successfully!</h2>
    <h4>Contact administrator for further concerns!</h4>
</div>
<?php $this->view("includes/footer",$data);
