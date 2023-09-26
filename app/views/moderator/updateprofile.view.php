<?php $this->view('moderator/moderator-header',$data) ?>
<link href="<?=ROOT?>/assets/css/adminupdateprofile.styles.css" rel="stylesheet">

<div class="pagetitle column-12">
      <h1>Update Profile</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/profile" class="breadcrumbs__link">Profile</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Update Profile</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>Update Profile Details</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>                       
                <div class="form-input">
                    <label>First Name</label>
                    <input value="<?=Auth::getfirstName()?>" class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text" name="firstName" id="firstName" placeholder="Enter your first name">
                    <?php if(!empty($errors['firstName'])):?>
                    <div class="text-error"><small><?=$errors['firstName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Last Name</label>
                    <input value="<?=Auth::getlastName()?>" class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text" name="lastName" id="lastName" placeholder="Enter your last name">
                    <?php if(!empty($errors['lastName'])):?>
                    <div class="text-error"><small><?=$errors['lastName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Address</label>
                    <input value="<?=Auth::getaddress()?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter your address">
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                  <label>Profile Picture</label>
                  <input   class="" type="file" name="imageInput" id="imageInput" accept="image/*">    
                  <div class="image-container">
                    <img id="uploadedImage" >
                </div>          
              </div>
              <div class="form-input">
                  <button>Update</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>

<script src="<?=ROOT?>/assets/js/main.js"></script>

<?php $this->view('moderator/moderator-footer',$data) ?>