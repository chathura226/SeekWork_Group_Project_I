<?php $this->view('admin/admin-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">


<div class="tab-form c-s-6 c-e-8 row-4">
  
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
                  <input   class="" type="password" name="currentpassword" id="currentpassword" placeholder="Enter the current password">              
              </div>
              <div class="form-input">
                  <label>New Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="password" name="newpassword" id="newpassword" placeholder="Enter the new password">              
              </div>
              <div class="form-input">
                  <label>Confirm New Password</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="password" name="confirmnewpassword" id="confirmnewpassword" placeholder="Retype the new password">              
              </div>
              <div class="form-input">
                  <button>Change</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>


<?php $this->view('admin/admin-footer',$data) ?>