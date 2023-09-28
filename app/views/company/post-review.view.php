<?php $this->view('company/company-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/rating.styles.css" rel="stylesheet">




<div class="pagetitle column-12">
      <h1>Post a New Review</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Add a Review</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>New Review</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>               
                <h3>Task Details</h3>
                <hr>  
                <div class="form-input">
                    <label>Task Title</label>
                    <input value="<?=ucfirst($task->title)?>" class="<?= !empty($errors['title']) ? 'error-border' : '' ?>" type="text" name="title" id="title" placeholder="Enter the title of the task" disabled>
                    <?php if(!empty($errors['companyName'])):?>
                    <div class="text-error"><small><?=$errors['companyName']?></small></div>
                    <?php endif;?>
                </div>  
                <div class="form-input">
                    <label>Task Finished Date</label>
                    <input value="<?=ucfirst($task->finishedDate)?>" class="<?= !empty($errors['finishedDate']) ? 'error-border' : '' ?>" type="date" name="finishedDate" id="finishedDate" disabled>
                    <?php if(!empty($errors['finishedDate'])):?>
                    <div class="text-error"><small><?=$errors['finishedDate']?></small></div>
                    <?php endif;?>
                </div>        
                <div class="form-input">
                    <label>Company Name</label>
                    <input value="<?=ucfirst(Auth::getcompanyName())?>" class="<?= !empty($errors['companyName']) ? 'error-border' : '' ?>" type="text" name="companyName" id="companyName" placeholder="Enter the name of the company" disabled>
                    <?php if(!empty($errors['companyName'])):?>
                    <div class="text-error"><small><?=$errors['companyName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Student Name</label>
                    <input value="<?=ucfirst($student->firstName)." ".ucfirst($student->lastName)?>" class="<?= !empty($errors['studentName']) ? 'error-border' : '' ?>" type="text" name="studentName" id="studentName" placeholder="Enter the name of the student" disabled>
                    <?php if(!empty($errors['studentName'])):?>
                    <div class="text-error"><small><?=$errors['studentName']?></small></div>
                    <?php endif;?>
                </div>

                    </br>
                <h3>Review Details</h3>
                <hr>
                <div class="form-input">
                    <label>Review Title</label>
                    <input value="" class="<?= !empty($errors['reviewTitle']) ? 'error-border' : '' ?>" type="text" name="reviewTitle" id="reviewTitle" placeholder="Enter a title for the review" required>
                    <?php if(!empty($errors['reviewTitle'])):?>
                    <div class="text-error"><small><?=$errors['reviewTitle']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input font-size-50px">
                  <label>No. of Stars</label>
                  </div>
                  <div class="rating font-size-50px">
                    <label>
                      <input type="radio" name="nStars" value="1" />
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="nStars" value="2" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="nStars" value="3" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>   
                    </label>
                    <label>
                      <input type="radio" name="nStars" value="4" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="stars" value="5" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                  </div>

                <div class="form-input">
                  <label>Review Description</label>
                  <textarea rows = "10" cols = "45" id="reviewDescription" name = "reviewDescription" placeholder="Enter your review"></textarea>
                    <br>
                </div>





              <div class="form-input">
                  <button>Post the Review</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>

<script>
  $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
  });
</script>
<?php $this->view('company/company-footer',$data) ?>
