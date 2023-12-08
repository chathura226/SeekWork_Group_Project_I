<?php $this->view('student/student-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/searchNearBreadCrums.styles.css" />

<div class="pagetitle column-12">
  <div class="search-group c-s-2 c-e-13 r-s-1 r-e-2">
    <svg class="icon-search" aria-hidden="true" viewBox="0 0 24 24" style="padding: 0 !important;">
      <g>
        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
      </g>
    </svg>
    <input placeholder="Search" type="search" class="input-search" id="search-bar">
  </div>
  <h1>My Tasks</h1>
  <nav>

    <ul class="breadcrumbs">
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="" class="breadcrumbs__link breadcrumbs__link--active">Tasks</a>
      </li>
    </ul>
  </nav>
</div>
<div class="mytasks-wrapper column-12">
  <?php foreach ($tasks as $task) : ?>
    <div class="mytask-tasks">
      <h2><?= ucfirst($task->title) ?></h2>
      <h4>Deadline: <?php if (!empty($task->deadline)) echo $task->deadline;
                    else echo "No deadline available!"; ?></h4>
      <h4>Status: <?=($task->status==='closed')?'<span style="color: red;">Closed</span>':'<span style="color: green;">'.ucfirst($task->status).'</span>'?></h4>

      <a href="<?= ROOT ?>/student/tasks/<?= $task->taskID ?>">
        <button class="details-button">
          Details
          <div class="arrow-wrapper">
            <div class="arrow"></div>
          </div>
        </button>
      </a>
    </div>
  <?php endforeach; ?>

</div>
<?php $this->view('student/student-footer', $data) ?>


<script type="text/javascript" src="<?= ROOT ?>/assets/js/searchNearBreadCrums.js"></script>
