<?php $this->view('student/student-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>


<div class="pagetitle column-12">
      <h1>Proposals</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/proposals" class="breadcrumbs__link breadcrumbs__link--active">Proposals</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
<?php foreach($proposals as $proposal):?>
<div class="mytask-tasks">
  <h2><?=ucfirst($proposal->task->title)?></h2>
  <h4>Submitted Date: <?=$proposal->submissionDate?></h4>
  <?php if(empty($proposal->proposeAmount)) echo"<h4>Proposal Value: ".$proposal->task->value."</h4>";?>
  <?php if(!empty($proposal->proposeAmount)) echo"<h4>Proposal Value: ".$proposal->proposeAmount."</h4>";?>
  <h4>Task Type: <?=$proposal->task->taskType?> </h4>
  <h4>Task Status: <?=ucfirst($proposal->task->status)?></h4>

  <a href="<?=ROOT?>/student/proposals/<?=$proposal->proposalID?>">
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
