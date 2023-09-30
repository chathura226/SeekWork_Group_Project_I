<?php $this->view('company/company-header',$data) ?>

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
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks/<?=$task->taskID?>/view-proposals" class="breadcrumbs__link breadcrumbs__link--active">Proposals</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
<?php if(!empty($proposals)) : foreach($proposals as $proposal):?>
<div class="mytask-tasks">
  <h2>Propose Amount : <?php if(!empty($proposal->proposeAmount)) echo "Rs.".$proposal->proposeAmount."/="; else echo "Rs.".$task->value."/=" ?></h2>
  <h4>Submitted Date: <?=$proposal->submissionDate?></h4>

  <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>/proposal/<?=$proposal->proposalID?>">
    <button class="details-button">
      Details
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
</div>
<?php endforeach; else: ?>
  <h2>No proposals have submitted for this task</h2>
  <?php endif; ?>
</div>



<?php $this->view('company/company-footer',$data) ?>