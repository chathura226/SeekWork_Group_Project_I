<?php $this->view('company/company-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>

<div class="pagetitle column-12">
    <h1>Profile</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Profile</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="card c-s-1 row-4">
    <div class="card__img"><img src="<?= ROOT ?>/assets/images/logo.png" alt="Profile Picture"></div>
    <div class="card__avatar"><img
                src="<?= ROOT ?><?= (!empty(Auth::getprofilePic())) ? "/" . Auth::getprofilePic() : "/assets/images/noImage.png" ?>"
                alt="Profile Picture"></div>
    <div class="card__title"><?= ucfirst(Auth::getfirstName()) ?> <?= ucfirst(Auth::getlastName()) ?> </div>
    <div class="card__subtitle"><?= ucfirst(Auth::getrole()) ?> </div>
    <div class="card__wrapper">
        <a href="<?= ROOT ?>/company/changepassword">
            <button class="card__btn">Change Password</button>
        </a>
        <a href="<?= ROOT ?>/company/updateprofile">
            <button class="card__btn card__btn-solid">Update Profile</button>
        </a>


    </div>
</div>

<div class="profile-details c-s-2 c-e-13 row-6">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2>Profile Details</h2>
    </div>
    User ID :
    <hr>
    <div><?= ucfirst(Auth::getuserID()) ?></div>
    <?= ucfirst(Auth::getrole()) ?> ID :
    <hr>
    <div><?php $funcName = 'get' . Auth::getrole() . 'ID';
        echo Auth::$funcName() ?></div>
    Company Name:
    <hr>
    <div><?= ucfirst(Auth::getcompanyName()) ?></div>
    <?php if (!empty(Auth::getwebsite())): ?>
        Website:<hr>
        <div><?= Auth::getwebsite() ?></div><?php endif; ?>
    Email Address:<hr>
    <div><?= Auth::getemail() ?></div>
    Status:<hr>
    <div><?= ucfirst(Auth::getstatus()) ?></div>
    First Name of the Contact Person :<hr>
    <div><?= ucfirst(Auth::getfirstName()) ?></div>
    Last Name of the Contact Person :<hr>
    <div><?= ucfirst(Auth::getlastName()) ?></div>
    Contact Number of the Contact Person :<hr>
    <div><?= ucfirst(Auth::getcontactNo()) ?></div>
    Company location :<hr>
    <div><?= ucfirst(Auth::getaddress()) ?></div>
    BRN :<hr>
    <div><?= Auth::getbrn() ?></div>
    Company Description :<hr>
    <div><?= Auth::getdescription() ?></div>
    Joined Date :<hr>
    <div><?= ucfirst(Auth::getcreatedAt()) ?></div>

</div>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/floating-button.styles.css"/>
<a href="<?= ROOT ?>/<?= Auth::getrole() ?>/deleteAccount">
    <div class="floating-button">
        <button type="button" class="buttonadd" style="background-color: red;">
            <span class="button__text">Delete Account</span>
            <span class="button__icon" style="background-color: red;"><svg xmlns="http://www.w3.org/2000/svg"
                                                                           height="32" width="36" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path
                            d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></span>
        </button>
    </div>
</a>

<?php $this->view('company/company-footer', $data) ?>
