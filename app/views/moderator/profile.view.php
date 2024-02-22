<?php $this->view('moderator/moderator-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>

<?php if(Auth::getuserID()===$user->userID):?>
<div class="pagetitle column-12">
      <h1>Profile</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Profile</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->
<?php else:?>
  <div class="pagetitle column-12">
      <h1>Profile</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/otherusers" class="breadcrumbs__link">Other Users</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active"><?=ucfirst($user->firstName)." ".ucfirst($user->lastName)?></a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<?php endif;?>


    <div class="card c-s-1 row-4">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?= ROOT ?><?= (!empty($user->profilePic)) ? "/" . $user->profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($user->firstName)?> <?=ucfirst($user->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> </div>
      <div class="card__wrapper">
        <?php if(Auth::getuserID()===$user->userID):?><a href="<?=ROOT?>/moderator/changepassword"><button class="card__btn">Change Password</button></a><?php endif;?>
          <?php if(Auth::getuserID()===$user->userID):?><a href="<?=ROOT?>/moderator/updateprofile"><button class="card__btn card__btn-solid">Update Profile</button></a><?php endif;?>
          
          
      </div>
    </div>

    <div class="profile-details c-s-2 c-e-13 row-4">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
          <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
      </div>
        User ID :<hr>
        <div><?=ucfirst($user->userID)?></div>
        <?=ucfirst($user->role)?> ID :<hr>
        <div><?php $attr=$user->role.'ID'; echo $user->$attr;?></div>
        Email Address:<hr>
        <div><?=$user->email?></div>
        First Name :<hr>
        <div><?=ucfirst($user->firstName)?></div>
        Last Name :<hr>
        <div><?=ucfirst($user->lastName)?></div>
        Contact Number :<hr>
        <div><?=$user->contactNo?></div>
        Address :<hr>
        <div><?=ucfirst($user->address)?></div>
        Joined Date :<hr>
        <div><?=$user->createdAt?></div>
        <?php if(Auth::getuserID()!=$user->userID):?>
        <div class="btn-container" style="margin: 0;padding: 0;">
            <div class="btn-effect" style="margin: 0;padding: 0;">
                <a style="font-size:15px;background-color:black;padding: 5px 0px;width:155px" class="effect" href="<?=ROOT?>/<?=Auth::getrole()?>/chats/<?=$user->userID?>" title="Contact"><svg xmlns="http://www.w3.org/2000/svg" style="fill: white !important;" fill="white" height="1em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>
                    Chat Now </a>
            </div>

        </div>
        <?php endif;?>

    </div>

<?php if($user->userID==Auth::getuserID()):?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>
    <a href="<?=ROOT?>/<?=Auth::getrole()?>/deleteAccount">
        <div class="floating-button">
            <button type="button" class="buttonadd" style="background-color: red;">
                <span class="button__text">Delete Account</span>
                <span class="button__icon" style="background-color: red;"><svg xmlns="http://www.w3.org/2000/svg" height="32" width="36" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></span>
            </button>
        </div>
    </a>
<?php endif;?>

<?php $this->view('moderator/moderator-footer',$data) ?>
