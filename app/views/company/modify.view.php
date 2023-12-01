

<?php $this->view('company/company-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">




<div class="pagetitle column-12">
      <h1>Modify Task - <?=$task->title?></h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Modify</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>Modify Task</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post"> 
                </br>               
                <h3>Company Details</h3>
                <hr>       
                <div class="form-input">
                    <label>Company Name</label>
                    <input value="<?=ucfirst(Auth::getcompanyName())?>" class="<?= !empty($errors['companyName']) ? 'error-border' : '' ?>" type="text" name="companyName" id="companyName" placeholder="Enter the name of the company" disabled>
                    <?php if(!empty($errors['companyName'])):?>
                    <div class="text-error"><small><?=$errors['companyName']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Location</label>
                    <input value="<?=ucfirst(Auth::getaddress())?>" class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text" name="address" id="address" placeholder="Enter address of the company" disabled>
                    <?php if(!empty($errors['address'])):?>
                    <div class="text-error"><small><?=$errors['address']?></small></div>
                    <?php endif;?>
                </div>

                    </br>
                <h3>Task Details</h3>
                <hr>
                <div class="form-input">
                    <label>Task Title</label>
                    <input value="<?=(isset($_POST['title']))?set_value('title'):$task->title?>" class="<?= !empty($errors['title']) ? 'error-border' : '' ?>" type="text" name="title" id="title" placeholder="Enter a title for the task">
                    <?php if(!empty($errors['title'])):?>
                    <div class="text-error"><small><?=$errors['title']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Task Type</label>
                    <select id="taskType" name="taskType" required>
                        <option value="fixed Price" <?php if($task->taskType==='fixed Price') echo 'selected';?>>Fixed Price</option>
                        <option value="auction" <?php if($task->taskType==='auction') echo 'selected';?> >Auction</option>
                    </select>
                </div>

                <div class="form-input">
                    <label>Task Category</label>
                    <select id="categoryID" name="categoryID" required>
                        <option value="" selected disabled>Select a Category</option>
                        <?php foreach($categories as $category):?>
                            <option value=<?=$category->categoryID?> <?php if($task->categoryID===$category->categoryID) echo 'selected';?> ><?=ucfirst($category->title)?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                <div class="form-input">
                  <label>Task Description</label>
                  <textarea rows = "10" cols = "45" id="description" name = "description" placeholder="Describe your task"><?=(isset($_POST['description']))?set_value('description'):$task->description?></textarea>
                    <br>
                </div>

              <div class="form-input">
                  <label>Any Related Document</label>
                  <small>If there are more than one file, Zip the files before upload</small>
                  <input   class="" type="file" name="documents" id="documents" >
                  <?php if(!empty($errors['documents'])):?>
                      <div class="text-error"><small><?=$errors['documents']?></small></div>
                  <?php endif;?>
              </div>

                <div class="form-input">
                  <label>Price <small>(If the task is for bidding, enter the starting value)</small></label>
                  <input   value="<?=(isset($_POST['value']))?set_value('value'):$task->value?>" type="number" name="value" id="value" placeholder="Enter the price" required>
                </div>

                <div class="form-input">
                    <label>Deadline <small>(If any)</small></label>
                    <input value="<?=(isset($_POST['deadline']))?set_value('deadline'):$task->deadline?>" type="date" id="deadline" name="deadline" >
                </div>




              <div class="form-input">
                  <button>Modify</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>


<?php $this->view('company/company-footer',$data) ?>


