<?php $this->view('student/student-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>

<div class="pagetitle column-12">
      <h1>View - Company</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link">View - Company </a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active"><?=ucfirst($user->companyName)?></a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


    <div class="card c-s-1 row-4">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?= ROOT ?><?= (!empty($user->profilePic)) ? "/" . $user->profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture"></div>
        <div class="card__title"><?=ucfirst($user->companyName)?></div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> </div>

    </div>

    <div class="profile-details c-s-2 c-e-13 row-6" >
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
          <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
      </div>
        <?=ucfirst($user->role)?> ID :<hr>
        <div><?=$user->companyID?></div>
        Status:<hr>
        <div><?=ucfirst($user->status)?></div>
        Joined Date :<hr>
        <div><?=ucfirst($user->createdAt)?></div>
        Company Description :<hr>
        <div><?=$user->description?></div>
        Company Website :<hr>
        <div><?=(!empty($user->website))?$user->website:'N/A'?></div>
        Contact Person Details:
        <hr>
      <div>First Name: <?=ucfirst($user->firstName)?></div>
      <div>Last Name: <?=ucfirst($user->lastName)?></div>
        <div class="btn-container" style="margin: 0;padding: 0;">
            <div class="btn-effect" style="margin: 0;padding: 0;">
                <a style="font-size:15px;background-color:black;padding: 5px 0px;width:155px" class="effect" href="<?=ROOT?>/<?=Auth::getrole()?>/chats/<?=$user->userID?>" title="Contact"><svg xmlns="http://www.w3.org/2000/svg" style="fill: white !important;" fill="white" height="1em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>
                    Chat Now </a>
            </div>

        </div>
    </div>

<?php $this->view('student/student-footer',$data) ?>
