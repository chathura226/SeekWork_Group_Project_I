<?php $this->view('moderator/moderator-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">


<div class="pagetitle column-12">
      <h1>Change Password</h1>
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
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Change Password</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="form-wrap column-12">

<div class="tab-form row-4">
  
  <div class="myheader">
      <div class="active-login"><h2>Change Password</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>                       
                <div class="form-input">
                  <label>Current Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="password" name="currentpassword" id="currentpassword" placeholder="Enter the current password" required>              
              </div>
              <div class="form-input">
                  <label>New Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="password" name="newpassword" id="newpassword" placeholder="Enter the new password" required>               
              </div>
              <div class="form-input">
                  <label>Confirm New Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="password" name="confirmnewpassword" id="confirmnewpassword" placeholder="Retype the new password" required>              
              </div>
              <div class="form-input">
                  <button>Change</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>
</div>


<?php $this->view('moderator/moderator-footer',$data) ?>