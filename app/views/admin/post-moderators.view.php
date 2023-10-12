<?php $this->view('admin/admin-header',$data) ?>
<link href="<?=ROOT?>/assets/css/post-moderators.styles.css" rel="stylesheet">


<div class="pagetitle column-12">
      <h1>Add new Moderator</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/admin/managemoderators" class="breadcrumbs__link">Manage Moderators</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Add new Moderator</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="msg c-s-6 c-e-8">


  <?php if(!empty($errors['email'])):?>
  <div class="alert alert-danger text-center" id="alert"><?=$errors['email']?></div>
  <?php endif;?>
  </div>

  <div class="form-wrap column-12">

<div class="tab-form row-6">
  
  <div class="myheader">
      <div class="active-login"><h2>New Moderator</h2></div>
  </div>
  <div class="tab-body">
      <div class="active">
          <form method="post"> 
  </br>                       
              
                <h2>Create an moderator account</h2>
                <!-- to recognize the correct form we use hidden input -->
                <input type="hidden" name="form_id" value="student">
                <div class="form-input">
                    <label>First Name</label>
                    <input value="<?= set_value('firstName')?>" class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text" name="firstName" id="firstName" placeholder="Enter moderator's first name">
                    <?php if(!empty($errors['firstName'])):?>
                    <div class="text-error"><small><?=$errors['firstName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Last Name</label>
                    <input value="<?= set_value('lastName')?>" class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text" name="lastName" id="lastName" placeholder="Enter moderator's last name">
                    <?php if(!empty($errors['lastName'])):?>
                    <div class="text-error"><small><?=$errors['lastName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Address</label>
                    <input value="<?= set_value('address')?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter moderator's address">
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Contact Number</label>
                    <!-- <input type="tel" name="contactNo" placeholder="Enter your contact number 012-345-6789" required> -->
                    <input value="<?= set_value('contactNo')?>" class="<?= !empty($errors['contactNo']) ? 'error-border' : '' ?>" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  name="contactNo" id="contactNo" placeholder="Enter moderator's contact number ">
                    <?php if(!empty($errors['contactNo'])):?>
                    <div class="text-error"><small><?=$errors['contactNo']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Email</label>
                    <!-- <input type="email" placeholder="Enter your university student email address" required> -->
                    <input value="<?= set_value('email')?>" class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text" name="email" id="email" placeholder="Enter moderator's email address">
                    <?php if(!empty($errors['email'])):?>
                    <div class="text-error"><small><?=$errors['email']?></small></div>
                    <?php endif;?>
                </div>
               
                <div class="form-input">
                    <label>Password</label>
                    <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                    <input value="<?= set_value('password')?>"  class="<?= !empty($errors['password']) ? 'error-border' : '' ?>" type="password" name="password" id="password" placeholder="Enter a password">
                    <?php if(!empty($errors['password'])):?>
                    <div class="text-error"><small><?=$errors['password']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Confirm Password</label>
                    <!-- <input type="password" name="rePassword"  placeholder="Confirm the password" required> -->
                    <input value="<?= set_value('rePassword')?>"  class="<?= !empty($errors['rePassword']) ? 'error-border' : '' ?>" type="password" name="rePassword" id="rePassword" placeholder="Re-enter the password">
                    <?php if(!empty($errors['rePassword'])):?>
                    <div class="text-error"><small><?=$errors['rePassword']?></small></div>
                    <?php endif;?>
                </div>
        
                <div class="form-input">
                    <button>Create the new moderator account</button>
                </div>

          </form>
      </div>
      
  </div>
  
  </div>
</div>



<?php $this->view('admin/admin-footer',$data) ?>
