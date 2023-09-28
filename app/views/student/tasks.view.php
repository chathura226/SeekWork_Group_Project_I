<?php $this->view('student/student-header',$data) ?>
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
<?php foreach($tasks as $task):?>
<div class="mytask-tasks">
  <h2><?=ucfirst($task->title)?></h2>
  <h4>Deadline: <?php if(!empty($task->deadline)) echo $task->deadline; else echo "No deadline available!";?></h4>
  <h4>Status: <?=ucfirst($task->status)?></h4>

  <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>">
    <button class="details-button">
      Details
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
</div>
<?php endforeach;?>

</div>
<?php $this->view('student/student-footer',$data) ?>
