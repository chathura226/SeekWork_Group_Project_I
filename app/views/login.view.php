<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>
    <link href="<?= ROOT ?>/assets/css/login.styles.css" rel="stylesheet">

    <div class="msg c-s-6 c-e-8">


        <?php if (!empty($errors['email'])): ?>
            <div class="alert alert-danger text-center" id="alert"><?= $errors['email'] ?></div>
        <?php endif; ?>
    </div>
<style>
    .login-wrapper{
        background-color: white;
    }
    .login-side{
        padding: 20px;
        width: 100%;
        display: flex;
    }
    .login-side-left{
        width: 50%;
        max-height:400px ;
    }
    .login-side-right{
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
    <div class="form-wrap column-12 login-wrapper">
        <div class="login-side">
            <div class="login-side-left" >

                <img style="width: 100%;height: 100%" src="<?=ROOT?>/assets/images/login-wallpaper.jpg" alt="">
                <h1>Welcome back</h1>
                <h1>to SeekWork</h1>
                <h5>Login to your account from here</h5>

            </div>
            <div class="login-side-right">
        <div class="tab-form row-4" style="border-radius: 20px;">

            <div class="myheader">
                <div class="active-login"><h2>Login</h2></div>
            </div>
            <div class="tab-body">
                <div class="active">
                    <form method="post">
                        </br>
                        <div class="form-input">
                            <label>Email</label>
                            <!-- <input type="email" placeholder="Enter your university student email address" required> -->
                            <input value="<?= set_value('email') ?>"
                                   class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text"
                                   name="email" id="email" placeholder="Enter the email address">
                            <?php if (!empty($errors['email'])): ?>
                                <div class="text-error"><small><?= $errors['email'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-input">
                            <label>Password</label>
                            <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                            <input class="<?= !empty($errors['password']) ? 'error-border' : '' ?>" type="password"
                                   name="password" id="password" placeholder="Enter the password">
                            <?php if (!empty($errors['password'])): ?>
                                <div class="text-error"><small><?= $errors['password'] ?></small></div>
                            <?php endif; ?>
                            <div class="forgot">
                                <a rel="noopener noreferrer" href="#">Forgot Password ?</a>
                            </div>
                        </div>
                        <div class="form-input">
                            <button>Log in</button>
                            <p style="margin-top: 10px;">Don't have an account?
                                <a rel="" href="<?= ROOT ?>/signup" class="">Sign up</a>
                            </p>

                        </div>
                    </form>
                </div>

            </div>

        </div>
            </div>
        </div>
    </div>


<?php $this->view("includes/footer", $data);
