<?php $this->view('moderator/moderator-header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">
<link href="<?= ROOT ?>/assets/css/company-verification.styles.css" rel="stylesheet">

<style>
    /* Changing the height of table rows */
    .table tr {
        height: 50px; /* Change this value to adjust the height */
    }
</style>
<div class="pagetitle column-12">
    <h1>Reviewed Verification</h1>
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
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Reviewed Verification</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<?php if (!empty($reviewed)): ?>
    <div class="c-s-1 c-e-13">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Company Profile</th>
                <th>Verification Document</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < sizeof($reviewed); $i++): ?>
                <tr>
                    <th><?= $i + 1 ?></th>
                    <td> <?= $reviewed[$i]->companyName ?></td>
                    <td>
                        <a href="<?= ROOT ?>/moderator/profile/<?= $reviewed[$i]->userID ?>">See Profile</a>
                    </td>
                    <td>
                        <a href="<?= ROOT ?>/download/verification/<?= $reviewed[$i]->userID ?>/<?= $reviewed[$i]->verificationID ?>">Download
                            Document</a></td>
                    <td> <?= ($reviewed[$i]->status == 'underReview') ? 'Under Review' : 'Reviewed' ?></td>


                </tr>
            <?php endfor; ?>

            </tbody>
        </table>
    </div>

<?php else: ?>
    <div class="c-s-1 c-e-13">
        <h2>No Reviewed Verifications </h2>
    </div>
<?php endif; ?>


<?php $this->view('moderator/moderator-footer', $data) ?>
