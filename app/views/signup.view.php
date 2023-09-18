
<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<link href="<?=ROOT?>/assets/css/login.styles.css" rel="stylesheet">

<?php if(message()):?>
    <div class="alert alert-danger text-center"><?=message('',true)?></div>
<?php endif;?>
<main class="wrapper">
<div class="form-container c-s-5 c-e-9">
        <p class="title">Create an Account</p>
        <form class="form" method="post">
            <!-- <div class="input-group">
                <label for="fName">First Name</label>
                <input type="text" name="fName" id="fName" placeholder="Enter your first name">
            </div>
            <div class="input-group">
                <label for="lName">Last Name</label>
                <input type="text" name="lName" id="lName" placeholder="Enter your last name">
            </div> -->
            <div class="input-group">
                <label for="email">Email</label>
                <input value="<?= set_value('email')?>" class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text" name="email" id="email" placeholder="Enter your email">
                <?php if(!empty($errors['email'])):?>
                <div class="text-error"><small><?=$errors['email']?></small></div>
                <?php endif;?>
            </div>
            <div class="input-group">
                <label for="contactNo">Contact No.</label>
                <input value="<?= set_value('contactNo')?>" class="<?= !empty($errors['contactNo']) ? 'error-border' : '' ?>" type="text" name="contactNo" id="contactNo" placeholder="Enter your mobile number">
                <?php if(!empty($errors['contactNo'])):?>
                <div class="text-error"><small><?=$errors['contactNo']?></small></div>
                <?php endif;?>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input value="<?= set_value('password')?>"  class="<?= !empty($errors['password']) ? 'error-border' : '' ?>" type="password" name="password" id="password" placeholder="Enter the password">
                <?php if(!empty($errors['password'])):?>
                <div class="text-error"><small><?=$errors['password']?></small></div>
                <?php endif;?>
            </div>
            <div class="input-group"> 
                <label for="rePassword">Confirm Password</label>
                <input value="<?= set_value('rePassword')?>"  class="<?= !empty($errors['rePassword']) ? 'error-border' : '' ?>" type="password" name="rePassword" id="rePassword" placeholder="Re-enter the password">
                <?php if(!empty($errors['rePassword'])):?>
                <div class="text-error"><small><?=$errors['rePassword']?></small></div>
                <?php endif;?>
            </div>
               <span> </br>By clicking sign-up you are agreeing to the <a rel="terms" href="<?=ROOT?>/terms" class='terms'>terms</a> of use and acknowledging the privacy policies.</span>
            <button type="submit" class="sign">Sign Up</button>
        </form>
        
        
        <p class="signup">Already have an account?
            <a rel="signup" href="<?=ROOT?>/login" class="">Log in</a>
        </p>
    </div>
</main>


<?php $this->view("includes/footer",$data);
