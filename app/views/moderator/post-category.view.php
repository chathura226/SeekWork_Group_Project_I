<?php $this->view('moderator/moderator-header',$data) ?>
<link href="<?=ROOT?>/assets/css/category.styles.css" rel="stylesheet">


<div class="pagetitle column-12">
      <h1>Add new Category</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/category" class="breadcrumbs__link">Category</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Add new Category</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="form-wrap column-12">

<div class="tab-form row-4">
  
  <div class="myheader">
      <div class="active-login"><h2>Add new Category</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>                       
                <div class="form-input">
                  <label>Category Title</label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="text" name="title" id="title" placeholder="Enter the category title" required>              
              </div>
              <div class="form-input">
                  <label>Category Description</label>
                  <textarea rows = "10" cols = "37" id="description" name = "description" placeholder="Enter the category description"></textarea>
                    <br>
              </div>
              <div class="form-input">
                  <label>Relevant Tags <small>Seperate by commas</small></label>
                  <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                  <input   class="" type="text" name="tags" id="tags" placeholder="Enter relevant tags " required>              
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