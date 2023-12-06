<?php $this->view('moderator/moderator-header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/tables.styles.css">

<div class="pagetitle column-12">
    <h1>Under Verification</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/toverify" class="breadcrumbs__link">To Verify</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Under Verification</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<?php if (!empty($underReviews)): ?>
<div class="c-s-1 c-e-13">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Company Name</th>
            <th>Company Profile</th>
            <th>Verification Document</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < sizeof($underReviews); $i++): ?>
            <tr>
                <th><?= $i + 1 ?></th>
                <td> <?= $underReviews[$i]->companyName ?></td>
                <td>
                    <a href="<?= ROOT ?>/moderator/profile/<?=$underReviews[$i]->userID  ?>">See Profile</a>
                </td>
                <td><a href="<?= ROOT ?>/download/verification/<?=$underReviews[$i]->userID  ?>/<?=$underReviews[$i]->verificationID?>">Download Document</a></td>
                <td> <?= ($underReviews[$i]->status=='underReview')?'Under Review':'Reviewed' ?></td>

                <td><a href="#" onclick="changeVerificationState(<?=$underReviews[$i]->verificationID?>)">Change Status</a></td>

            </tr>
        <?php endfor; ?>

        </tbody>
    </table>
</div>

<?php else: ?>
    <div class="c-s-1 c-e-13">
        <h2>No Verifications To Review</h2>
    </div>
<?php endif; ?>

<?php $this->view('moderator/moderator-footer', $data) ?>
