<?php $this->view('student/student-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/floating-button.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/deleteAccount.styles.css"/>

<div class="pagetitle column-12">
    <h1>Delete Your Account</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/profile" class="breadcrumbs__link">Profile</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Delete Account</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="profile-details c-s-1 c-e-13 row-6">
    Hi <?= Auth::getfirstName() ?>,<br>
    We're sorry to hear you'd like to delete your account. You can contact us for any help regarding the platform or a
    process.<br><br>

    <div class="delete-account">
        <h4>We want to ensure you're fully informed about this process. Deleting your account will result in the
            following:</h4><br>

        <ul>
            <li><strong>Loss of Access: </strong> You'll no longer be able to access your account, including any
                associated data, history, or
                preferences.
            </li>
            <li><strong>Irreversible Action: </strong> This action cannot be undone. All account information, including
                stored data, posts,
                messages, and settings, will be permanently removed.
            </li>
            <li><strong>Impact on Services: </strong> Any linked services, subscriptions, or associated accounts may be
                affected by this deletion.
            </li>
            <li><strong>Payments: </strong> Please resolve any payments, disputes before account deletion, since you
                won't be able to access them after account deletion
            </li>
        </ul>

        <div class="deleteAccountButton">
            <h5>Still want to delete your account? </h5>
        </div>
    </div>
</div>

<?php $this->view('student/student-footer', $data) ?>
