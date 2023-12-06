<?php $this->view('moderator/moderator-header',$data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css" />

<div class="pagetitle column-12">
    <h1>To Verify</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">To verify</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->



<div class="mytasks-wrapper column-12">
        <div class="mytask-tasks">
            <h2>All Reviewed Verifications</h2>
            <h4>Count: <?=$reviewed?></h4>

            <a href="<?= ROOT ?>/moderator/toverify/reviewed">
                <button class="details-button">
                    Details
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </a>
        </div>

    <div class="mytask-tasks">
        <h2>Under Review</h2>
        <h4>Count: <?=$underReview?></h4>

        <a href="<?= ROOT ?>/moderator/toverify/underverification">
            <button class="details-button">
                Details
                <div class="arrow-wrapper">
                    <div class="arrow"></div>
                </div>
            </button>
        </a>
    </div>

</div>
<?php $this->view('student/student-footer', $data) ?>



<?php $this->view('moderator/moderator-footer',$data) ?>
