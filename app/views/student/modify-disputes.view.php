<?php $this->view('student/student-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">




<div class="pagetitle column-12">
      <h1>Modify Dispute</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/disputes" class="breadcrumbs__link">Disputes</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Modify Dispute</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12 ">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>Modify Dispute</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>               
                <h3>Task Details</h3>
                <hr>       

                <div class="form-input">
                    <label>Task Name</label>
                    <select id="taskID" name="taskID" required>
                        <option value="" disabled>Select the Task</option>
                        <?php foreach($tasks as $task):?>
                            <option value=<?=$task->taskID?> <?php if($dispute->taskID==$task->taskID)echo 'selected'?>><?=ucfirst($task->title)?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                </br>
                <h3>Dispute Details</h3>
                <hr>
                <div class="form-input">
                    <label>Subject</label>
                    <input value="<?= $dispute->subject?>" class="<?= !empty($errors['subject']) ? 'error-border' : '' ?>" type="text" name="subject" id="subject" placeholder="Enter a subject for the dispute">
                    <?php if(!empty($errors['title'])):?>
                    <div class="text-error"><small><?=$errors['title']?></small></div>
                    <?php endif;?>
                </div>

                <div class="form-input">
                  <label>Dispute Description</label>
                  <textarea rows = "10" cols = "45" id="description" name = "description" placeholder="Describe your task"><?=$dispute->description?></textarea>
                    <br>
                </div>
                <div class="form-input">
                    <label>Dispute Type</label>
                    <select id="type" name="type" required>
                        <option value="payment" <?= ($dispute->type=='payment')?'selected':''?>>Payment Related</option>
                        <option value="other"  <?= ($dispute->type=='other')?'selected':''?> >Other</option>
                    </select>
                </div>



              <div class="form-input">
                  <button>Submit</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>


<?php $this->view('student/student-footer',$data) ?>