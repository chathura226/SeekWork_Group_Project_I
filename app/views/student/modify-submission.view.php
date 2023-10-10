<?php $this->view('student/student-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/rating.styles.css" rel="stylesheet">



<div class="pagetitle column-12">
      <h1>Modify Submission</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions" class="breadcrumbs__link">Submissions</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>" class="breadcrumbs__link">View Details</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Modify Submission</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->



<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>Modify Submission</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>               
                <h3>Submission Details</h3>
                <hr>  

                <div class="form-input">
                  <label>Documents</label>
                  <input   class="" type="file" name="documents" id="documents" accept="image/*">    
                  <div class="image-container">
                    <img id="uploadedImage" >
                    </div>          
                </div>


                <div class="form-input">
                  <label>Any Notes</label>
                  <textarea rows = "10" cols = "45" id="note" name = "note" placeholder="Enter a description about the submission"><?=$submission->note?></textarea>
                    <br>
                </div>
                


              <div class="form-input">
                  <button>Modify the Submission</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>


<?php $this->view('student/student-footer',$data) ?>
