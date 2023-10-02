<?php $this->view('company/company-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>

<div class="pagetitle column-12">
      <h1>My Tasks</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Tasks</a>
          </li>
        </ul>
      </nav>
</div>
<div class="mytasks-wrapper column-12">
<?php  if(!empty($tasks)): foreach($tasks as $task):?>
<div class="mytask-tasks height-150">
  <h2><?=ucfirst($task->title)?></h2>
  <h4>Deadline: 06/10/2023</h4>
  <h4>Number of proposals: 45</h4>
  <h4>Status: <?=ucfirst($task->status)?></h4>
  <h4>Assignment status: <?=empty($task->assignmentID)?'<span style="color: red;">Not Assigned</span>':'<span style="color: green;">Assigned</span>'?></h4>

  <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>">
    <button class="details-button">
      Details
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
</div>
<?php endforeach; else:?>
  <h2>No tasks posted!</h2>

  <?php endif;?>
</div>
<?php $this->view('company/company-footer',$data) ?>
