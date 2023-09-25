<?php $this->view('company/company-header',$data) ?>


<link rel="stylesheet" href="<?=ROOT?>/assets/css/company-verification.styles.css"/>

<div class="pagetitle column-12">
      <h1>Verification</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/Verification" class="breadcrumbs__link breadcrumbs__link--active">Verification</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12">
<div class="tab-form  row-4">
<div class="alert alert-danger text-center" >Your account is not yet verified! Please fill the details and upload relavant documents!</div>
  <div class="myheader">
      <div class="active-login"><h2>Profile Details and Verification Documents</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>                       
                
                <div class="form-input">
                    
                  <label>Company Description</label>
                  <textarea rows = "5" cols = "45" id="description" name = "description" placeholder="Enter a description about company"></textarea>
                    <br>
              </div>
             
              <div class="form-input">
                  <label>Clear Image of the Business Registration</label>
                  <input   class="" type="file" name="imageInput" id="imageInput" accept="image/*">    
                  <div class="image-container">
                    <img id="uploadedImage">
                </div>                      
              </div>
              <div class="form-input">
                  <button>Submit for Approval</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>
</div>


<script src="<?=ROOT?>/assets/js/main.js"></script>

<?php $this->view('company/company-footer',$data) ?>
