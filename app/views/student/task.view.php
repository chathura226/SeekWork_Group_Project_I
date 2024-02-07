<?php $this->view('student/student-header', $data) ?>


<link rel="stylesheet" href="<?= ROOT ?>/assets/css/eachtask.styles.css">

<div class="pagetitle column-12">
    <h1><?= ucfirst($task->title) ?></h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/student/tasks" class="breadcrumbs__link">Tasks</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active"><?= $task->title ?></a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="task-details-wrapper column-12">

    <div class="task-details column-7">
        <h2>Task Details</h2>
        <div class="task-description">
            <?= $task->description ?>
            <br><br>
            <h4>Relavant Documents : </h4>
            <?php if (!empty($task->documents)) : ?>
                <?php $fileName=array_reverse(explode("/",$task->documents))[0];?>
                File Name: <?=$fileName?><br>
                <a href="<?=ROOT?>/download/tasks/<?=$task->taskID?>/details?file=<?=$fileName?>">Download</a><br>
            <?php else:?>
                No files uploaded for this task!<br>
            <?php endif; ?>
            <br>
            <h4>Required or Preferred Skills : </h4>
            <?php if (!empty($skills)): ?>
                <div class="skill-wrapper" style="padding: 0px !important; margin-top: 0px !important;">
                    <?php foreach ($skills as $skill): ?>
                        <div class="skill" style="margin: 5px !important;"><?= $skill->skill ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else:?>
                N/A
            <?php endif;?>
        </div>
        <div class="about-task">
            <h2>About the task</h2>

            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 640 512">
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0l57.4-43c23.9-59.8 79.7-103.3 146.3-109.8l13.9-10.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176V384c0 35.3 28.7 64 64 64H360.2C335.1 417.6 320 378.5 320 336c0-5.6 .3-11.1 .8-16.6l-26.4 19.8zM640 336a144 144 0 1 0 -288 0 144 144 0 1 0 288 0zm-76.7-43.3c6.2 6.2 6.2 16.4 0 22.6l-72 72c-6.2 6.2-16.4 6.2-22.6 0l-40-40c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L480 353.4l60.7-60.7c6.2-6.2 16.4-6.2 22.6 0z" />
                </svg>
                No. of proposals : <?=$task->nProposals?> </br>
            </div>

            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                    <path d="M176 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h16V98.4C92.3 113.8 16 200 16 304c0 114.9 93.1 208 208 208s208-93.1 208-208c0-41.8-12.3-80.7-33.5-113.2l24.1-24.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L355.7 143c-28.1-23-62.2-38.8-99.7-44.6V64h16c17.7 0 32-14.3 32-32s-14.3-32-32-32H224 176zm72 192V320c0 13.3-10.7 24-24 24s-24-10.7-24-24V192c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
                </svg>
                Deadline : <?=(!empty($task->deadline))?$task->deadline:'N/A'?> </br>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                    <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
                Task Type : <?=ucwords($task->taskType)?> </br>
            </div>

        </div>
    </div>
    <div class="price-button c-s-8 c-e-13">

        <h1>Rs.<?= $task->value ?>/=</h1>

        <a href="<?= ROOT ?>/student/tasks/<?= $task->taskID ?>/submissions"><button class="apply">Submissions</button></a>
        &nbsp &nbsp

        <?php if ($task->status === 'closed') : ?>
            &nbsp &nbsp
            <a href="<?= ROOT ?>/student/review/post/<?= $task->taskID ?>"><button class="apply height-50 width-160">Add a Review</button></a>
            &nbsp &nbsp

        <?php endif; ?>
    </div>
    <?php  $this->view('includes/companyDetail', (array)$company) ?>

</div>





<?php $this->view('student/student-footer', $data) ?>