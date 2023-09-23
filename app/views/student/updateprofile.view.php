<?php $this->view('student/student-header',$data) ?>
<link href="<?=ROOT?>/assets/css/updateprofile.styles.css" rel="stylesheet">

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


<div class="tab-form c-s-6 c-e-8 row-4">
  <div class="myheader">
      <div class="active-login"><h2>Update Profile Details</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>   
                <div class="form-input">
                    <label>University Email</label>
                    <input value="<?= Auth::getemail()?>" class="" type="text" name="email" id="email" placeholder="Enter student email address" disabled>
                </div>
                <div class="form-input">
                    <label>University (Corresponding to the Email)</label>
                    <input value="UCSC" class="" type="text" name="uni" id="uni"disabled>
                </div>      
                <div class="form-input">
                    <label>Contact Number</label>
                    <input value="<?=Auth::getcontactNo()?>" class="" type="text" name="uni" id="uni"disabled>
                </div> 
                              
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
                    <label>NIC number</label>
                    <input value="<?= Auth::getNIC()?>" class="<?= !empty($errors['NIC']) ? 'error-border' : '' ?>" type="text" name="NIC" id="NIC" placeholder="Enter your NIC number">
                    <?php if(!empty($errors['NIC'])):?>
                    <div class="text-error"><small><?=$errors['NIC']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    
                  <label>Description About Yourself</label>
                  <textarea value=""rows = "5" cols = "45" id="description" name = "description" placeholder="Enter a description about you"><?=Auth::getdescription()?></textarea>
                    <br>
                  <!-- <input   class="" type="text" name="description" id="description" placeholder="Enter a description about you">               -->
              </div>
              <div class="form-input">
                  <label>Qualifications</label>
                  <input  value="<?=Auth::getqualifications()?>" class="" type="text" name="qualifications" id="qualifications" placeholder="">              
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


<script src="<?=ROOT?>/assets/js/main.js"></script>

<?php $this->view('student/student-footer',$data) ?>