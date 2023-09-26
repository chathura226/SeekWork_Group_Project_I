<?php $this->view('moderator/moderator-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/otherusers.styles.css"/>

<div class="pagetitle column-12">
      <h1>Other Users</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Other Users</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->
<div class="user-wrapper column-12">
  <?php foreach($users as $user):?>

    <div class="card ">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($user->firstName)?> <?=ucfirst($user->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> </div>
      <div class="card__wrapper">
 
          <a href="<?=ROOT?>/<?=Auth::getrole()?>/profile/<?=$user->userID?>"> <button class="card__btn">Details</button></a>
          <button class="card__btn card__btn-solid">Disable</button>
      </div>
    </div>

    <?php endforeach;?>

    </div>
    

<?php $this->view('moderator/moderator-footer',$data) ?>
