<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<link href="<?=ROOT?>/assets/css/login.styles.css" rel="stylesheet">

<div class="msg c-s-6 c-e-8">


  <?php if(!empty($errors['email'])):?>
  <div class="alert alert-danger text-center" id="alert"><?=$errors['email']?></div>
  <?php endif;?>
  </div>

  <div class="form-wrap column-12">

<div class="tab-form row-4">
  
  <div class="myheader">
      <div class="active-login"><h2>Login</h2></div>
  </div>
  <div class="tab-body">
      <div class="active">
          <form method="post"> 
  </br>                       
              <div class="form-input" >
                  <label>Email</label>
                  <!-- <input type="email" placeholder="Enter your university student email address" required> -->
                  <input value="<?= set_value('email')?>" class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text" name="email" id="email" placeholder="Enter the email address">
                  <?php if(!empty($errors['email'])):?>
                  <div class="text-error"><small><?=$errors['email']?></small></div>
                  <?php endif;?>
              </div>
              
              <div class="form-input">
                  <label>Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="<?= !empty($errors['password']) ? 'error-border' : '' ?>" type="password" name="password" id="password" placeholder="Enter the password">
                  <?php if(!empty($errors['password'])):?>
                  <div class="text-error"><small><?=$errors['password']?></small></div>
                  <?php endif;?>
                  <div class="forgot">
                      <a rel="noopener noreferrer" href="#">Forgot Password ?</a>
                  </div>
              </div>
              <div class="form-input">
                  <button>Log in</button>
                  <p style="margin-top: 10px;">Don't have an account?
                      <a rel="" href="<?=ROOT?>/signup" class="">Sign up</a>
                  </p>
                  
              </div>
          </form>
      </div>
      
  </div>
  
  </div>
</div>


<?php $this->view("includes/footer",$data);
