
<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<link href="<?=ROOT?>/assets/css/login.styles.css" rel="stylesheet">



<?php if(message()):?>
    <div class="alert alert-danger text-center" id="alert"><?=message('',true)?></div>
<?php endif;?>
<!-- <main class="wrapper"> -->
<div class="tab-form c-s-6 c-e-8 row-10">
    <div class="tab-header">
        <div class="<? if(!empty($errors['form_id'])){if($errors['form_id']==='student') {echo 'active';}else echo '';}else echo 'active'; ?>">As a Student</div>
        <div class="<? if(!empty($errors['form_id'])){if($errors['form_id']==='company') {echo 'active';} else echo '';}else echo ''; ?>">As a company</div>
    </div>
    <div class="tab-body">
        <div class="<? if(!empty($errors['form_id'])){if($errors['form_id']==='student') {echo 'student active';}else echo 'student';}else echo 'student active'; ?>">
            <form method="post">
            
                <h2>Create an account</h2>
                <!-- to recognize the correct form we use hidden input -->
                <input type="hidden" name="form_id" value="student">
                <div class="form-input">
                    <label>First Name</label>
                    <input value="<?= set_value('firstName')?>" class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text" name="firstName" id="firstName" placeholder="Enter your first name">
                    <?php if(!empty($errors['firstName'])):?>
                    <div class="text-error"><small><?=$errors['firstName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Last Name</label>
                    <input value="<?= set_value('lastName')?>" class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text" name="lastName" id="lastName" placeholder="Enter your last name">
                    <?php if(!empty($errors['lastName'])):?>
                    <div class="text-error"><small><?=$errors['lastName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Address</label>
                    <input value="<?= set_value('address')?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter your address">
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>NIC number</label>
                    <input value="<?= set_value('NIC')?>" class="<?= !empty($errors['NIC']) ? 'error-border' : '' ?>" type="text" name="NIC" id="NIC" placeholder="Enter your NIC number">
                    <?php if(!empty($errors['NIC'])):?>
                    <div class="text-error"><small><?=$errors['NIC']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>University Student Email (with .stu domain)</label>
                    <!-- <input type="email" placeholder="Enter your university student email address" required> -->
                    <input value="<?= set_value('email')?>" class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text" name="email" id="email" placeholder="Enter your university student email address">
                    <?php if(!empty($errors['email'])):?>
                    <div class="text-error"><small><?=$errors['email']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Contact Number</label>
                    <!-- <input type="tel" name="contactNo" placeholder="Enter your contact number 012-345-6789" required> -->
                    <input value="<?= set_value('contactNo')?>" class="<?= !empty($errors['contactNo']) ? 'error-border' : '' ?>" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  name="contactNo" id="contactNo" placeholder="Enter your contact number 012-345-6789">
                    <?php if(!empty($errors['contactNo'])):?>
                    <div class="text-error"><small><?=$errors['contactNo']?></small></div>
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
                <span> </br>By clicking sign-up you are agreeing to the <a rel="terms" href="<?=ROOT?>/terms" class='terms'>terms</a> of use and acknowledging the privacy policies.</span>
        
                <div class="form-input">
                    <button>Signup as a student</button>
                    <p style="margin-top: 10px;">Already have an account?
                        <a rel="signup" href="<?=ROOT?>/login" class="">Log in</a>
                    </p>
                </div>
            </form>
        </div>
        <div class="<? if(!empty($errors['form_id'])){if($errors['form_id']==='company') {echo 'company active';} else echo 'company';}else echo 'company'; ?>">
            <form method="post">
                <h2>Create an account</h2>
                
                <!-- to recognize the correct form we use hidden input -->
                <input type="hidden" name="form_id" value="company">
                <div class="form-input">
                    <label>Company Name</label>
                    <input value="<?= set_value('companyName')?>" class="<?= !empty($errors['companyName']) ? 'error-border' : '' ?>" type="text" name="companyName" id="companyName" placeholder="Enter the name of the company">
                    <?php if(!empty($errors['companyName'])):?>
                    <div class="text-error"><small><?=$errors['companyName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Address</label>
                    <input value="<?= set_value('address')?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter address of the company">
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>
                
                <div class="form-input">
                    <label>Website URL in the format "https://www.seekwork.com" (If Available) </label>
                    <input value="<?= set_value('website')?>" class="<?= !empty($errors['website']) ? 'error-border' : '' ?>" type="text" name="website" id="website" placeholder="Enter company website URL if available">
                    <?php if(!empty($errors['website'])):?>
                    <div class="text-error"><small><?=$errors['website']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>BRN number</label>
                    <input value="<?= set_value('brn')?>" class="<?= !empty($errors['brn']) ? 'error-border' : '' ?>" type="text" name="brn" id="brn" placeholder="Enter company BRN number">
                    <?php if(!empty($errors['brn'])):?>
                    <div class="text-error"><small><?=$errors['brn']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>First Name of contact person</label>
                    <input value="<?= set_value('firstName')?>" class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text" name="firstName" id="firstName" placeholder="Enter first name of contact person">
                    <?php if(!empty($errors['firstName'])):?>
                    <div class="text-error"><small><?=$errors['firstName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Last Name of contact person</label>
                    <input value="<?= set_value('lastName')?>" class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text" name="lastName" id="lastName" placeholder="Enter last name of contact person">
                    <?php if(!empty($errors['lastName'])):?>
                    <div class="text-error"><small><?=$errors['lastName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Contact Number</label>
                    <!-- <input type="tel" name="contactNo" placeholder="Enter your contact number 012-345-6789" required> -->
                    <input value="<?= set_value('contactNo')?>" class="<?= !empty($errors['contactNo']) ? 'error-border' : '' ?>" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  name="contactNo" id="contactNo" placeholder="Enter your contact number 012-345-6789">
                    <?php if(!empty($errors['contactNo'])):?>
                    <div class="text-error"><small><?=$errors['contactNo']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Company Email</label>
                    <!-- <input type="email" placeholder="Enter your university student email address" required> -->
                    <input value="<?= set_value('email')?>" class="<?= !empty($errors['email']) ? 'error-border' : '' ?>" type="text" name="email" id="email" placeholder="Enter company email address">
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
                <span> </br>By clicking sign-up you are agreeing to the <a rel="terms" href="<?=ROOT?>/terms" class='terms'>terms</a> of use and acknowledging the privacy policies.</span>
        
                <div class="form-input">
                    <button>Signup as a company</button>
                    <p style="margin-top: 10px;">Already have an account?
                        <a rel="signup" href="<?=ROOT?>/login" class="">Log in</a>
                    </p>
                </div>
            </form>
        </div>
        
    </div>
    
</div>
                <!-- </main> -->

                <!-- importing js -->
<script type="text/javascript" src="<?=ROOT?>/assets/js/signup.js"></script>


<?php $this->view("includes/footer",$data);
