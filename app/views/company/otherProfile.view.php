<?php $this->view('company/company-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>

<div class="pagetitle column-12">
      <h1>View - Student</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link">View - Student </a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active"><?=ucfirst($user->firstName)." ".ucfirst($user->lastName)?></a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


    <div class="card c-s-1 row-4">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($user->firstName)?> <?=ucfirst($user->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> </div>

    </div>

    <div class="profile-details c-s-2 c-e-13 row-6">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
          <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
      </div>
      <div><?=ucfirst($user->role)?> ID : <?=$user->studentID?></div>
      <div>First Name: <?=ucfirst($user->firstName)?></div>
      <div>Last Name: <?=ucfirst($user->lastName)?></div>
      <div>University: <?=ucfirst($user->universityName)?></div>
      <!-- <div>Email Address: <?=$user->email?></div> -->
      <div>Status: <?=ucfirst($user->status)?></div>
      <div>Student Description : <?=$user->description?></div>
      <div>Joined Date : <?=ucfirst($user->createdAt)?></div>

    </div>

<?php $this->view('company/company-footer',$data) ?>
