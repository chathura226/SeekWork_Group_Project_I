<?php $this->view('admin/admin-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/otherusers.styles.css"/>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">
      <h1>Manage Moderators</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Manage Moderators</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->



<div class="user-wrapper column-12">
  <?php foreach($moderators as $moderator):?>

    <div class="card ">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($moderator->firstName)?> <?=ucfirst($moderator->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($moderator->role)?> </div>
      <div class="card__wrapper">
          <a href="<?=ROOT?>/<?=Auth::getrole()?>/profile/<?=$moderator->userID?>"> <button class="card__btn">Details</button></a>
          <button class="card__btn card__btn-solid">Disable</button>
      </div>
    </div>

    <?php endforeach;?>

    </div>
    

    



<a href="<?=ROOT?>/admin/managemoderators/post">
    <div class="floating-button">
        <button type="button" class="buttonadd">
        <span class="button__text">Add New Moderator</span>
        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
        </button>
    </div>
</a>



<?php $this->view('admin/admin-footer',$data) ?>
