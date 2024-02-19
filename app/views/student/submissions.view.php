<?php $this->view('student/student-header', $data) ?>


<link rel="stylesheet" href="<?= ROOT ?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">

    <!--if not closed-->
    <?php if ($task->status != 'closed'): ?>
        <a href="<?= ROOT ?>/student/tasks/<?= $task->taskID ?>/addsubmission/">
            <div class="floating-button" style="top:70px;">
                <button type="button" class="buttonadd">
                    <span class="button__text">New Submission</span>
                    <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                                                    stroke="currentColor" height="24" fill="none" class="svg"><line y2="19"
                                                                                                                    y1="5"
                                                                                                                    x2="12"
                                                                                                                    x1="12"></line><line
                                    y2="12" y1="12" x2="19" x1="5"></line></svg></span>
                </button>
            </div>
        </a>
    <?php endif; ?>
    <h1>Submissions</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/student/tasks" class="breadcrumbs__link">Tasks</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/student/tasks/<?= $task->taskID ?>"
                   class="breadcrumbs__link"><?= $task->title ?></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Submissions</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->


<div class="myreviews-wrapper column-12">
    <?php if (!empty($submissions)): $count = 0; ?>
        <?php foreach ($submissions as $submission): $count++; ?>
            <div class="myreview-review-bttns">
                <div class="myreview-review">
                    <h2>Submission #<?= $count ?></h2>
                    <h4>Submission Date: <?= ucfirst($submission->createdAt) ?></h4>
                    <h4>Status: <?= ucfirst($submission->status) ?></h4>
                </div>
                <div class="flex justify-between">
                    <a href="<?= ROOT ?>/student/tasks/<?= $task->taskID ?>/submissions/<?= $submission->submissionID ?>">
                        <button class="details-button margin-5">
                            Details
                            <div class="arrow-wrapper">
                                <div class="arrow"></div>
                            </div>
                        </button>
                    </a>


                </div>
            </div>

        <?php endforeach; ?>
    <?php else: echo "<h2> You have no submissions!</h2>"; endif; ?>
</div>





<?php $this->view('student/student-footer', $data) ?>
