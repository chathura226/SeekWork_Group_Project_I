<?php $this->view('admin/admin-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>

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

    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title">Pasindu Ekanayake</div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title">Lasith Chandupa </div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title">Ravindu Didulantha</div>
      <div class="card__subtitle">Moderator</div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title">Nimal Kamal</div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle">Student</div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle">Company</div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>
    <div class="card column-3">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst(Auth::getfirstName())?> <?=ucfirst(Auth::getlastName())?> </div>
      <div class="card__subtitle"><?=ucfirst(Auth::getrole())?> </div>
      <div class="card__wrapper">
          <button class="card__btn">Button</button>
          <button class="card__btn card__btn-solid">Button</button>
      </div>
    </div>

    
    

<?php $this->view('admin/admin-footer',$data) ?>
