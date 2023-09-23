<?php $this->view('company/company-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>

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

    <div class="card c-s-1 row-4">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
        <a href="<?=ROOT?>/company/changepassword"><button class="card__btn">Change Password</button></a>
        <a href="<?=ROOT?>/company/updateprofile"><button class="card__btn card__btn-solid">Update Profile</button></a>
          
          
      </div>
    </div>

    <div class="profile-details c-s-2 c-e-13 row-4">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
          <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
      </div>
      <div>User ID : <?=ucfirst(Auth::getuserID())?></div>
      <div><?=ucfirst(Auth::getrole())?> ID : <?php $funcName='get'.Auth::getrole().'ID'; echo Auth::$funcName()?></div>
      <div>Company Name: <?=ucfirst(Auth::getcompanyName())?></div>
      <?php if(!empty(Auth::getwebsite())):?><div>Website: <?=Auth::getwebsite()?></div><?php endif;?>
      <div>Email Address: <?=Auth::getemail()?></div>
      <div>Status: <?=ucfirst(Auth::getstatus())?></div>
      <div>First Name of the Contact Person : <?=ucfirst(Auth::getfirstName())?></div>
      <div>Last Name of the Contact Person : <?=ucfirst(Auth::getlastName())?></div>
      <div>Contact Number of the Contact Person : <?=ucfirst(Auth::getcontactNo())?></div>
      <div>Company location : <?=ucfirst(Auth::getaddress())?></div>
      <div>BRN : <?=Auth::getbrn()?></div>
      <div>Company Description : <?=Auth::getdescription()?></div>
      <div>Joined Date : <?=ucfirst(Auth::getcreatedAt())?></div>

    </div>

<?php $this->view('company/company-footer',$data) ?>
