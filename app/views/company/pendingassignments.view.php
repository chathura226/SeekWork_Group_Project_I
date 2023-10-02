<?php $this->view('company/company-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>

<div class="pagetitle column-12">
      <h1>Pending Assignments</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Pending Assignment Invitations</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="mytasks-wrapper column-12">
<?php  if(!empty($assignments)): foreach($assignments as $assignment):?>
<div class="mytask-tasks height-150">
  <h2><?=ucfirst($assignment->student->firstName)." ".ucfirst($assignment->student->lastName)?></h2>
  <h4>Assignment Status: <?=ucfirst($assignment->status)?></h4>
  <h4>Invited Date: <?=ucfirst($assignment->createdAt)?></h4>

</div>
<?php endforeach; else:?>
  <h2>No tasks posted!</h2>

  <?php endif;?>
</div>
<?php $this->view('company/company-footer',$data) ?>
