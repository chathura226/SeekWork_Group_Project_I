<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/alerts.styles.css">
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/assets/css/custom-fonts.css">

    <title><?= $title ?> | <?= APP_NAME ?></title>

    <!-- Favicons -->
    <link href="<?= ROOT ?>/assets/images/favicon.ico" rel="icon">


</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /*color: black;*/

    }

    body {
        background: url("<?=ROOT?>/assets/images/login-background.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: bottom;
        background-attachment: fixed;
        display: flex;
        justify-content: left;
        margin-left: 200px;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        height: 500px;
        width: 450px;
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
    }

    .container h2 {
        text-align: center;
        letter-spacing: 1px;
        font-size: 50px;
    }

    .container .input-box {
        margin: 35px 0;
        width: 330px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.4);
        position: relative;
        margin-bottom: 0;
    }

    .container .input-box input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        height: 40px;
        padding: 0 35px 0 5px;
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

    .input-box input:focus ~ label,
    .input-box input:valid ~ label {
        top: -5px;
    }

    .input-box i {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .forget-section {
        display: flex;
        justify-content: right;
        font-size: 15px;
        margin: -15px 0 15px;
        text-decoration: none;
    }

    .forget-section a {
        text-decoration: none;
    }

    .forget-section a:hover {
        text-decoration: underline;
    }


    .btn {
        height: 45px;
        width: 100%;
        border-radius: 50px;
        color: black;
        background: #BEB8B2;
        border: 2px solid 435760;
        box-shadow: none;
        outline: none;
        font-size: 16px;
        cursor: pointer;
        letter-spacing: 1px;

    }

    .account-creation {
        text-align: center;
        margin: 25px 0 10px;
        font-weight: 400;
        font-size: 16px;
    }

    .account-creation span a {
        text-decoration: none;

    }

    .account-creation a:hover {
        text-decoration: underline;
    }

    .text-center {
        text-align: center !important;
    }

    .text-error {
        color: crimson !important;

    }

    .error-border {
        border-color: crimson !important;

    }

    .alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: 20px;
        border: 1px solid #d4edda;
        border-radius: 10px;
        font-size: 18px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
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


    .alert-success {
        background-color: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 5px;
        padding: 15px;
        font-size: 16px;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>
<body>
<div class="msg" style="position: fixed;margin: auto; top: 60px">


    <?php if (!empty($errors['email'])): ?>
        <div class="alert alert-danger text-center" id="alert"><?= $errors['email'] ?></div>
    <?php endif; ?>
</div>
<div class="container">
    <form method="post">
        <h2>Login</h2>
        <div class="input-box <?= !empty($errors['email']) ? 'error-border' : '' ?>">
            <input value="<?= set_value('email') ?>" name="email" type="text" id="email" required>
            <label for="email" style="width: 100%;">Email
                <svg style="position: relative;left: 260px" xmlns="http://www.w3.org/2000/svg" height="1em"
                     viewBox="0 0 512 512">
                    <path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/>
                </svg>
            </label>

        </div>
        <?php if (!empty($errors['email'])): ?>
            <div class="text-error"><small><?= $errors['email'] ?></small></div>
        <?php endif; ?>
        <div class="input-box  <?= !empty($errors['password']) ? 'error-border' : '' ?>">
            <input id="password" name="password" type="password" required>
            <label for="password" style="width: 100%;">Password
                <svg style="position: relative;left: 240px" height="1em" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                </svg>
            </label>

        </div>
        <?php if (!empty($errors['password'])): ?>
            <div class="text-error"><small><?= $errors['password'] ?></small></div>
        <?php endif; ?>

        <div class="forget-section" style="margin-top:30px ">
            <a href="#">Forgot Password?</a>
        </div>
        <button class="btn">Sign in</button>

        <div class="account-creation">
            <span>Don't have an account? <a href="<?= ROOT ?>/signup">Sign Up</a></span>

        </div>
    </form>
</div>

</body>
<script src="<?= ROOT ?>/assets/js/alert.js"></script>
</html>
