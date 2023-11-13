<?php $this->view('admin/admin-header',$data) ?>
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
      <h1>Profile of <?=ucfirst($user->firstName)." ".ucfirst($user->lastName)?></h1>
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
      <div class="card__avatar"><img src="<?=ROOT?><?=(!empty(Auth::getprofilePic()))?"/".Auth::getprofilePic():"/assets/images/noImage.png"?>" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($user->firstName)?> <?=ucfirst($user->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> </div>
      <div class="card__wrapper">
        <?php if(Auth::getuserID()===$user->userID):?><a href="<?=ROOT?>/admin/changepassword"><button class="card__btn">Change Password</button></a><?php endif;?>
          <?php if(Auth::getuserID()===$user->userID):?><a href="<?=ROOT?>/admin/updateprofile"><button class="card__btn card__btn-solid">Update Profile</button></a><?php endif;?>
          
          
      </div>
    </div>

    <div class="profile-details c-s-2 c-e-13 row-4">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
          <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
      </div>
      <div>User ID : <?=ucfirst($user->userID)?></div>
      <div><?=ucfirst($user->role)?> ID : <?php $attr=$user->role.'ID'; echo $user->$attr;?></div>
      <div>Email Address: <?=$user->email?></div>
      <div>First Name : <?=ucfirst($user->firstName)?></div>
      <div>Last Name : <?=ucfirst($user->lastName)?></div>
      <div>Contact Number : <?=$user->contactNo?></div>
      <div>Address : <?=ucfirst($user->address)?></div>
      <div>Joined Date : <?=$user->createdAt?></div>

    </div>

<?php $this->view('admin/admin-footer',$data) ?>
