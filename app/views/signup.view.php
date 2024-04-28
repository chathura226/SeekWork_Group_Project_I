<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/alerts.styles.css">
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/assets/css/custom-fonts.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/newHome.styles.css">
    <link href="<?= ROOT ?>/assets/css/passwordStrengthforsignup.styles.css" rel="stylesheet">

    <title><?= $title ?> | <?= APP_NAME ?></title>

    <!-- Favicons -->
    <link href="<?= ROOT ?>/assets/images/favicon.ico" rel="icon">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<style>
    .flex {
        display: flex;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: url("<?=ROOT?>/assets/images/signup-background.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
        background-attachment: fixed;
        display: flex;
        justify-content: right;
        margin-right: 75px;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        height: 830px;
        width: 755px;
        border: 2px;
        border-color: rgb(5, 5, 5);
        border-radius: 10px;
        background: rgba(133, 86, 86, 0.063);
        backdrop-filter: blur(4px);
        box-shadow: 0 0 5px rgba(0, 0, 0, .2),
        0 0 15px rgba(0, 0, 0, .2),
        0 0 30px rgba(0, 0, 0, .2);
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
    }

    .form-box {
        display: flex;
    }

    .form-box .studentSignup {
        position: absolute;
        transform: translateX(0px);
        transition: .5s ease;
        transition-delay: .4s;
    }

    .form-box .studentSignup.active {
        transform: translateX(-900px);
        transition-delay: .2s;

    }

    .form-box .companySignup {
        transform: translateX(900px);
        transition: .5s ease;
        transition-delay: .2s;

    }

    .form-box .companySignup.active {
        transform: translateX(0px);
        transition-delay: .4s;

    }

    .container h2 {
        text-align: center;
        letter-spacing: 1px;
        font-size: 30px;
        /*margin-top: 20px;*/
        margin-bottom: 40px;

    }

    .studentSignup h2 {
        /*margin-top: 40px;*/
    }

    .container .input-box {
        margin: 25px 0;
        width: 350px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.4);
        position: relative;
        margin-bottom: 0;
    }


    .container .input-box input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        height: 30px;
        padding: 0 35px 0 5px;
        font-size: 1em;

    }

    .container .input-box label {
        font-weight: 500;
        letter-spacing: 1px;
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        transition: .5s ease;
    }

    .container .input-box input:focus ~ label,
    .container .input-box input:valid ~ label {
        top: -5px;
    }

    .personal-details1 {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .personal-details2 {
        display: flex;
        justify-content: space-between;
        gap: 12px;

    }

    .personal-details3 {
        display: flex;
        justify-content: space-between;
                gap: 12px;

    }

    .company-details1 {
        display: flex;
        justify-content: space-between;
                gap: 12px;

    }

    .company-details2 {
        display: flex;
        justify-content: space-between;
                gap: 12px;

    }

    .company-details3 {
        display: flex;
        justify-content: space-between;
                gap: 12px;

    }

    .company-details4 {
        display: flex;
        justify-content: space-between;
                gap: 12px;

    }

    .password {
        display: flex;
        justify-content: space-between;
        gap: 12px;

    }

    .gender {
        /*margin: 10px 0;*/
        /*padding: 10px;*/
        /*transform: scale(1);*/
        padding-left: 5px;
    }

    .gender select {
        background-color: rgba(133, 86, 86, 0.063);
    }

    .gender label {
        font-weight: 500;
        letter-spacing: 1px;
    }

    .input-box i {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .terms {
        margin: 20px;
    }

    .terms span a {
        text-decoration: none;
    }

    .terms span a:hover {
        text-decoration: underline;
    }

    .btn {
        height: 45px;
        width: 100%;
        border-radius: 50px;
        color: black;
        background: rgba(133, 86, 86, 0.063);
        border: 2px solid 435760;
        box-shadow: none;
        outline: none;
        font-size: 16px;
        cursor: pointer;
        letter-spacing: 1px;

    }

    .account-signin-and-change-signup-type {
        margin: 20px;
        display: flex;
        justify-content: space-between;
    }


    .account-signin-and-change-signup-type span a {
        text-decoration: none;

    }

    .account-signin-and-change-signup-type a:hover {
        text-decoration: underline;
    }

    .text-center {
        text-align: center !important;
    }

    .text-error {
        color: crimson !important;
        max-width: 350px;

    }

    .error-border {
        border-color: crimson !important;

    }

    .alert {
        padding: 20px;
        border: 1px solid #d4edda;
        border-radius: 10px;
        font-size: 18px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        position: fixed;
        top:150px
    }

    /*.alert-danger {*/
    /*    background-color: #dc3545;*/
    /*    color: #fff;*/
    /*    border: 1px solid #dc3545;*/
    /*    border-radius: 5px;*/
    /*    padding: 15px;*/
    /*    font-size: 16px;*/
    /*    margin-bottom: 10px;*/
    /*    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);*/
    /*}*/


    /*.alert-success {*/
    /*    background-color: #198754;*/
    /*    color: #fff;*/
    /*    border: 1px solid #198754;*/
    /*    border-radius: 5px;*/
    /*    padding: 15px;*/
    /*    font-size: 16px;*/
    /*    margin-bottom: 10px;*/
    /*    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);*/
    /*}*/
</style>
<body>
<?php if (message()) : ?>
    <div class=" alert <?= (message()[1] == 'success') ? 'alert-success' : 'alert-danger'; ?> " id="alert">
        <h3><?= message([], true)[0] ?></h3>
    </div>
<?php endif; ?>
<header style="z-index: 9999;background-color: #1c452d">
    <nav class="navbar">
        <a href="<?= ROOT ?>" class="logo">
            <img style="height: 40px;" src="<?= ROOT ?>/assets/images/newLogo/white text.svg" alt="SeekWork Logo">
        </a>
        <ul class="menu-links">
            <span id="close-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></span>
            <li><a href="<?= ROOT ?>">Home</a></li>
            <li><a href="<?= ROOT ?>/tasks"">Explore</a></li>
            <li><a href="<?= ROOT ?>/support"">Help & Support</a></li>
            <?php if (!Auth::logged_in()) : ?>
                <li><a href="<?= ROOT ?>/signup">Signup as a Company</a></li>
                <li><a href="<?= ROOT ?>/login">Login</a></li>
                <li><a href="<?= ROOT ?>/signup">Sign up</a></li>
            <?php else : ?>
                <li><a href="<?= ROOT ?>/<?= Auth::getrole() ?>">Dashboard</a></li>
                <li><a href="<?= ROOT ?>/logout">Logout</a></li>
            <?php endif; ?>

        </ul>

        <span id="hamburger-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
    </nav>
</header>
<div class="msg" style="position: fixed;margin: auto; top: 160px">


    <?php if (!empty($errors['email'])): ?>
        <div class="alert alert-danger text-center" id="alert"><?= $errors['email'] ?></div>
    <?php endif; ?>
</div>
<div class="container">
    <div class="form-box">
        <form method="post">
            <div class="studentSignup <? if (!empty($errors['form_id'])) {
                if ($errors['form_id'] === 'company') {
                    echo 'active';
                } else echo '';
            } else echo ''; ?>">
                <!-- to recognize the correct form we use hidden input -->
                <input type="hidden" name="form_id" value="student">
                <h2>Signup (Student)</h2>
                <div class="signup-form">
                    <div class="personal-details1">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['firstName']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('firstName') ?>"
                                       type="text"
                                       name="firstName" id="firstName" placeholder="Enter your first name">
                                <label>First Name</label>
                                <i class='bx bx-user'></i>
                            </div>
                            <?php if (!empty($errors['firstName'])) : ?>
                                <div class="text-error"><small><?= $errors['firstName'] ?></small></div>
                            <?php endif; ?>
                        </div>


                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['lastName']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('lastName') ?>"
                                       type="text"
                                       name="lastName" id="lastName" placeholder="Enter your last name">
                                <label>Last Name</label>
                                <i class='bx bx-user'></i>
                            </div>
                            <?php if (!empty($errors['lastName'])) : ?>
                                <div class="text-error"><small><?= $errors['lastName'] ?></small></div>
                            <?php endif; ?>
                        </div>

                    </div>


                    <div class="personal-details2">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['address']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('address') ?>"
                                       type="text"
                                       name="address" id="address" placeholder="Enter your address">
                                <label>Address</label>
                                <i class='bx bx-location-plus'></i>
                            </div>
                            <?php if (!empty($errors['address'])) : ?>
                                <div class="text-error"><small><?= $errors['address'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['NIC']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('NIC') ?>"
                                       type="text" name="NIC"
                                       id="NIC" placeholder="Enter your NIC number">
                                <label>NIC Number</label>
                                <i class='bx bx-id-card'></i>
                            </div>
                            <?php if (!empty($errors['NIC'])) : ?>
                                <div class="text-error"><small><?= $errors['NIC'] ?></small></div>
                            <?php endif; ?>
                        </div>

                    </div>


                    <div class="personal-details3">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['email']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('email') ?>"
                                       type="text"
                                       name="email" id="email"
                                       placeholder="Enter your university student email address">
                                <label>Uni. Student Email (with .stu domain)</label>
                                <i class='bx bx-envelope'></i>
                            </div>
                            <?php if (!empty($errors['email'])) : ?>
                                <div class="text-error"><small><?= $errors['email'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['contactNo']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('contactNo') ?>"
                                       type="tel"
                                       pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="contactNo" id="contactNo"
                                       placeholder="Enter your contact number 012-345-6789">
                                <label>Contact Number</label>
                                <i class='bx bx-mobile-alt'></i>
                            </div>
                            <?php if (!empty($errors['contactNo'])) : ?>
                                <div class="text-error"><small><?= $errors['contactNo'] ?></small></div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div style="margin-bottom: 12px">
                        <div class="gender">
                            <label>Gender</label>
                            <div class="flex">
                                <div class="flex"
                                     style="gap: 20px; margin: 10px;justify-items: center;align-items:baseline;">
                                    <input id="male" type="radio" name="gender"
                                           value="male" <?= (set_value('gender') == 'male') ? 'checked' : '' ?>>
                                    <label for="male">Male</label>
                                </div>
                                <div class="flex"
                                     style="gap: 20px;margin: 10px; justify-items: center;align-items:baseline;">
                                    <input id="female" type="radio" name="gender"
                                           value="female" <?= (set_value('gender') == 'female') ? 'checked' : '' ?>>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($errors['gender'])) : ?>
                            <div class="text-error"><small><?= $errors['gender'] ?></small></div>
                        <?php endif; ?>
                    </div>

                    <div class="password">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['password']) ? 'error-border' : '' ?>">
                                <div class="strength-pass">
                                    <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                                    <input value="<?= set_value('password') ?>"
                                           type="password"
                                           name="password" id="password" placeholder="Enter a password">


                                    <label>Password</label>
                                    <div class="pw-display-toggle-button">
                                        <svg class="showEye" xmlns="http://www.w3.org/2000/svg" height="1em"
                                             viewBox="0 0 576 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                        </svg>
                                        <svg class="hideEye" xmlns="http://www.w3.org/2000/svg" height="1em"
                                             viewBox="0 0 640 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                            <div class="pw-strength">
                                <span></span>
                                <span></span>
                            </div>

                            <?php if (!empty($errors['password'])) : ?>
                                <div class="text-error"><small><?= $errors['password'] ?></small></div>
                            <?php endif; ?>
                        </div>


                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['rePassword']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('rePassword') ?>"
                                       type="password"
                                       name="rePassword" id="rePassword" placeholder="Re-enter the password">
                                <label>Confirm Password</label>
                                <i class='bx bx-lock-alt'></i>
                            </div>
                            <?php if (!empty($errors['rePassword'])) : ?>
                                <div class="text-error"><small><?= $errors['rePassword'] ?></small></div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="terms">
                        <span>By clicking sign-up you are agreeing to the <a href="#">terms</a> of use and acknowledging the privacy policies.</span>
                    </div>
                    <button class="btn">Sign Up</button>

                    <div class="account-signin-and-change-signup-type">
                        <span>Already have an account?  <a href="<?= ROOT ?>/login">Login</a></span><br>
                        <span><a href="#" class="companySignupLink">Signup as a Company!</a></span>
                    </div>

                </div>
            </div>
        </form>


        <form method="post">
            <div class="companySignup <? if (!empty($errors['form_id'])) {
                if ($errors['form_id'] === 'company') {
                    echo 'active';
                } else echo '';
            } else echo ''; ?>">
                <!-- to recognize the correct form we use hidden input -->
                <input type="hidden" name="form_id" value="company">

                <h2>Signup (Company)</h2>
                <div class="signup-form">
                    <div class="company-details1">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['companyName']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('companyName') ?>"
                                       class="" type="text"
                                       name="companyName" id="companyName" placeholder="Enter the name of the company">

                                <label>Company Name</label>
                                <i class='bx bx-buildings'></i></div>
                            <?php if (!empty($errors['companyName'])) : ?>
                                <div class="text-error"><small><?= $errors['companyName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['address']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('address') ?>"
                                       class="" type="text"
                                       name="address" id="address" placeholder="Enter address of the company">

                                <label>Address</label>
                                <i class='bx bx-location-plus'></i>
                            </div>
                            <?php if (!empty($errors['address'])) : ?>
                                <div class="text-error"><small><?= $errors['address'] ?></small></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="company-details2">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['website']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('website') ?>"
                                       class="" type="text"
                                       name="website" id="website"
                                       placeholder="Enter company website URL if available">

                                <label>Website URL (If Available)</label>
                                <i class='bx bx-search'></i>
                            </div>
                            <?php if (!empty($errors['website'])) : ?>
                                <div class="text-error"><small><?= $errors['website'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['brn']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('brn') ?>"
                                       class="" type="text" name="brn"
                                       id="brn" placeholder="Enter company BRN number">

                                <label>BRN Number</label>
                                <i class='bx bxs-business'></i>
                            </div>
                            <?php if (!empty($errors['brn'])) : ?>
                                <div class="text-error"><small><?= $errors['brn'] ?></small></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="company-details3">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['contactNo']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('contactNo') ?>"
                                       class="" type="tel"
                                       pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="contactNo" id="contactNo"
                                       placeholder="Enter your contact number 012-345-6789">

                                <label>Contact Number</label>
                                <i class='bx bx-mobile-alt'></i>
                            </div>
                            <?php if (!empty($errors['contactNo'])) : ?>
                                <div class="text-error"><small><?= $errors['contactNo'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['email']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('email') ?>"
                                       class="" type="text"
                                       name="email" id="email" placeholder="Enter company email address">

                                <label>Company Email</label>
                                <i class='bx bx-envelope'></i>
                            </div>
                            <?php if (!empty($errors['email'])) : ?>
                                <div class="text-error"><small><?= $errors['email'] ?></small></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="company-details4">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['firstName']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('firstName') ?>"
                                       class="" type="text"
                                       name="firstName" id="firstName"
                                       placeholder="Enter first name of contact person">

                                <label>First Name of contact person</label>
                                <i class='bx bx-user'></i>
                            </div>
                            <?php if (!empty($errors['firstName'])) : ?>
                                <div class="text-error"><small><?= $errors['firstName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['lastName']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('lastName') ?>"
                                       class="" type="text"
                                       name="lastName" id="lastName"
                                       placeholder="Enter last name of contact person">

                                <label>Last Name of contact person</label>
                                <i class='bx bx-user'></i>
                            </div>
                            <?php if (!empty($errors['lastName'])) : ?>
                                <div class="text-error"><small><?= $errors['lastName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gender">
                        <label>Gender of the Contact Person</label>
                        <div class="flex">
                            <div class="flex"
                                 style="gap: 20px; margin: 10px;justify-items: center;align-items:baseline;">
                                <input id="male" type="radio" name="gender"
                                       value="male" <?= (set_value('gender') == 'male') ? 'checked' : '' ?>>
                                <label for="male">Male</label>
                            </div>
                            <div class="flex"
                                 style="gap: 20px;margin: 10px; justify-items: center;align-items:baseline;">
                                <input id="female" type="radio" name="gender"
                                       value="female" <?= (set_value('gender') == 'female') ? 'checked' : '' ?>>
                                <label for="female">Female</label>
                            </div>
                        </div>

                        <?php if (!empty($errors['gender'])) : ?>
                            <div class="text-error"><small><?= $errors['gender'] ?></small></div>
                        <?php endif; ?>
                    </div>
                    <div class="password">
                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['password']) ? 'error-border' : '' ?>">
                                <div class="strength-pass">
                                    <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                                    <input value="<?= set_value('password') ?>"
                                           type="password"
                                           name="password" id="password" placeholder="Enter a password">


                                    <label>Password</label>
                                    <div class="pw-display-toggle-button">
                                        <svg class="showEye" xmlns="http://www.w3.org/2000/svg" height="1em"
                                             viewBox="0 0 576 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                        </svg>
                                        <svg class="hideEye" xmlns="http://www.w3.org/2000/svg" height="1em"
                                             viewBox="0 0 640 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                            <div class="pw-strength">
                                <span></span>
                                <span></span>
                            </div>

                            <?php if (!empty($errors['password'])) : ?>
                                <div class="text-error"><small><?= $errors['password'] ?></small></div>
                            <?php endif; ?>
                        </div>


                        <div style="margin-bottom: 12px">
                            <div class="input-box <?= !empty($errors['rePassword']) ? 'error-border' : '' ?>">
                                <input value="<?= set_value('rePassword') ?>"
                                       type="password"
                                       name="rePassword" id="rePassword" placeholder="Re-enter the password">
                                <label>Confirm Password</label>
                                <i class='bx bx-lock-alt'></i>
                            </div>
                            <?php if (!empty($errors['rePassword'])) : ?>
                                <div class="text-error"><small><?= $errors['rePassword'] ?></small></div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="terms">
                        <span>By clicking sign-up you are agreeing to the <a href="#">terms</a> of use and acknowledging the privacy policies.</span>
                    </div>
                    <button class="btn">Sign Up</button>

                    <div class="account-signin-and-change-signup-type">
                        <span>Already have an account?  <a href="<?= ROOT ?>/login">Login</a></span><br>
                        <span><a href="#" class="studentSignupLink">Signup as a Seeker!</a></span>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

</body>
<script type="text/javascript">

    const studentSignup = document.querySelector('.studentSignup');
    const companySignup = document.querySelector('.companySignup');
    const companySignupLink = document.querySelector('.companySignupLink');
    const studentSignupLink = document.querySelector('.studentSignupLink');
    companySignupLink.onclick = () => {
        companySignup.classList.add('active');
        studentSignup.classList.add('active');
    }
    studentSignupLink.onclick = () => {
        companySignup.classList.remove('active');
        studentSignup.classList.remove('active');
    }

</script>

<script type="text/javascript" src="<?= ROOT ?>/assets/js/passwordStrengthForSignup.js"></script>

</html>
