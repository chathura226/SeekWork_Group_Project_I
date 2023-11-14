<?php $this->view('company/company-header',$data) ?>
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

<div class="form-wrap column-12 row-10">

<div class="tab-form row-4">
  <div class="myheader">
      <div class="active-login"><h2>Update Profile Details</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post" enctype="multipart/form-data"> 
                </br>   
                <div class="form-input">
                    <label>Email</label>
                    <input value="<?= Auth::getemail()?>" class="" type="text" name="email" id="email" placeholder="Enter company email address" disabled>
                </div>    
                <div class="form-input">
                    <label>Contact Number</label>
                    <input value="<?=Auth::getcontactNo()?>" class="" type="text" name="uni" id="uni"disabled>
                </div> 
                <div class="form-input">
                    <label>Company Name</label>
                    <input value="<?=(isset($_POST['companyName']))?set_value('companyName'):Auth::getcompanyName()?>" class="<?= !empty($errors['companyName']) ? 'error-border' : '' ?>" type="text" name="companyName" id="companyName" placeholder="Enter the name of the company">
                    <?php if(!empty($errors['companyName'])):?>
                    <div class="text-error"><small><?=$errors['companyName']?></small></div>
                    <?php endif;?>
                </div> 
                <div class="form-input">
                    <label>Website URL in the format "https://www.seekwork.com" (If Available) </label>
                    <input value="<?=(isset($_POST['website']))?set_value('website'):Auth::getwebsite()?>" class="<?= !empty($errors['website']) ? 'error-border' : '' ?>" type="text" name="website" id="website" placeholder="Enter company website URL if available">
                    <?php if(!empty($errors['website'])):?>
                    <div class="text-error"><small><?=$errors['website']?></small></div>
                    <?php endif;?>
                </div>              
                <div class="form-input">
                    <label>First Name of the Contact Person</label>
                    <input value="<?=(isset($_POST['firstName']))?set_value('firstName'):Auth::getfirstName()?>" class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text" name="firstName" id="firstName" placeholder="Enter your first name">
                    <?php if(!empty($errors['firstName'])):?>
                    <div class="text-error"><small><?=$errors['firstName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Last Name of the Contact Person</label>
                    <input value="<?=(isset($_POST['lastName']))?set_value('lastName'):Auth::getlastName()?>" class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text" name="lastName" id="lastName" placeholder="Enter your last name">
                    <?php if(!empty($errors['lastName'])):?>
                    <div class="text-error"><small><?=$errors['lastName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Company Location</label>
                    <input value="<?=(isset($_POST['address']))?set_value('address'):Auth::getaddress()?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter your address">
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>BRN number</label>
                    <input value="<?= Auth::getbrn()?>" class="<?= !empty($errors['brn']) ? 'error-border' : '' ?>" type="text" name="brn" id="brn" placeholder="Enter your BRN number" disabled>
                    <?php if(!empty($errors['brn'])):?>
                    <div class="text-error"><small><?=$errors['brn']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    
                  <label>Company Description</label>
                  <textarea value=""rows = "5" cols = "45" id="description" name = "description" placeholder="Enter a description about the company"><?=(isset($_POST['description']))?set_value('description'):Auth::getdescription()?></textarea>
                    <br>
              </div>

              <div class="form-input">
                  <label>Profile Picture</label>
                  <input  onchange="load_image(this.files[0])" class="" type="file" name="imageInput" id="imageInput" accept="image/*">    
                  <div class="image-container">
                    <img  id="uploadedImage" <?php if(!empty(Auth::getprofilePic())) echo "src='".ROOT.'/'.Auth::getprofilePic()."'style='display: block;'";?>>
                </div>  
                <?php if(!empty($errors['imageInput'])):?>
                    <div class="text-error"><small><?=$errors['imageInput']?></small></div>
                    <?php endif;?>        
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

<?php $this->view('company/company-footer',$data) ?>