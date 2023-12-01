<?php $this->view('company/company-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">




<div class="pagetitle column-12">
      <h1>Post a New Task</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Post a New Task</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>New Task</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <form method="post" enctype="multipart/form-data">
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
                    <input value="<?= set_value('title')?>" class="<?= !empty($errors['title']) ? 'error-border' : '' ?>" type="text" name="title" id="title" placeholder="Enter a title for the task">
                    <?php if(!empty($errors['title'])):?>
                    <div class="text-error"><small><?=$errors['title']?></small></div>
                    <?php endif;?>
                </div>
                <div class="form-input">
                    <label>Task Type</label>
                    <select id="taskType" name="taskType" required>
                        <option value="fixed Price" selected>Fixed Price</option>
                        <option value="auction" >Auction</option>
                    </select>
                </div>

                <div class="form-input">
                    <label>Task Category</label>
                    <select id="categoryID" name="categoryID" required>
                        <option value="" selected disabled>Select a Category</option>
                        <?php foreach($categories as $category):?>
                            <option value=<?=$category->categoryID?>><?=ucfirst($category->title)?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                <div class="form-input">
                  <label>Task Description</label>
                  <textarea rows = "10" cols = "45" id="description" name = "description" placeholder="Describe your task"><?= set_value('description')?></textarea>
                    <br>
                </div>

              <div class="form-input">
                  <label>Any Related Document</label>
                  <input   class="" type="file" name="documents" id="documents" >
              </div>

                <div class="form-input">
                  <label>Price <small>(If the task is for bidding, enter the starting value)</small></label>
                  <input   value="<?= set_value('value')?>" type="number" name="value" id="value" placeholder="Enter the price" required>              
                </div>

                <div class="form-input">
                    <label>Deadline <small>(If any)</small></label>
                    <input value="<?= set_value('deadline')?>" type="date" id="deadline" name="deadline" >
                </div>




              <div class="form-input">
                  <button>Post</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>


<?php $this->view('company/company-footer',$data) ?>
