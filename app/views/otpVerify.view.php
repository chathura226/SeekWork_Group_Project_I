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
        An OTP code has been sent to your email account. Please enter the OTP to proceed with registration!
        <form method="post">
          <div class="form-input">
            <label>OTP Code</label>
            <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
            <input class="" type="text" name="otpCode" id="otpCode" maxlength="10" placeholder="Enter the OTP code" required>
          </div>
          
          <div class="form-input">
            <button>Verify</button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>


<?php $this->view("includes/footer",$data);
