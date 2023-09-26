<?php $this->view('moderator/moderator-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">


<div class="pagetitle column-12">
      <h1>Add new University</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/university" class="breadcrumbs__link">University</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Add new University</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="form-wrap column-12">

<div class="tab-form row-4">
  
  <div class="myheader">
      <div class="active-login"><h2>Add new University</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>                       
                <div class="form-input">
                  <label>University Name</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="text" name="universityName" id="universityName" placeholder="Enter the university name" required>              
              </div>
              <div class="form-input">
                  <label>University Domain for Student Emails</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="text" name="domain" id="domain" placeholder="Enter the domain " required>              
              </div>

              <div class="form-input">
                  <button>Add</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>
</div>


<?php $this->view('moderator/moderator-footer',$data) ?>