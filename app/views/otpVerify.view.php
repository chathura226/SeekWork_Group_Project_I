<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">


<div class="form-wrap column-12">

  <div class="tab-form row-4">

    <div class="myheader">
      <div class="active-login">
        <h2>OTP Verification</h2>
      </div>
    </div>
    <div class="tab-body">
      <div class="active1">
        <span id="sent-cont"></span>
        <form method="post">
          <div class="form-input">
            <label>OTP Code</label>
            <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
            <input class="" type="text" name="otpCode" id="otpCode" maxlength="10" placeholder="Enter the OTP code" required>
          </div>
          Click on the below link to get an OTP to your email address.<br>
          An OTP is only valid for 10 minutes.<br>
          <a href="<?=ROOT?>/otp/get" id="getOTP">Get an OTP</a>
          <br><span id="countdown"></span>
          
          <div class="form-input">
            <button>Verify</button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>


        <!-- ------------------scripts---------------- -->
        <?=(!empty($updatedAt))?'<label for="updatedAt" hidden>'.$updatedAt.'</label>':''?>
<script type="text/javascript" src="<?=ROOT?>/assets/js/otp.js"></script>

<?php $this->view("includes/footer",$data);
