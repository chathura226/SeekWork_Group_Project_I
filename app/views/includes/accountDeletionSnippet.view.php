<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/bookmark-button.styles.css"/>
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
            <div>

                <button class="bookmark_button" style="background-color: red;" onclick="delete_account(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
                    </svg>
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">-->
                    <!--                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"></path>-->
                    <!--                    </svg>-->
                    Delete my account
                </button>

                <button class="bookmark_button" style="background-color: green;" onclick="cancel_deletion(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
                    </svg>
                    Cancel
                </button>

            </div>
        </div>
    </div>
</div>

<script>
    function cancel_deletion(e){
        window.location="<?=ROOT?>/<?=Auth::getrole()?>/dashboard";
    }
    function delete_account(e){
        let result = confirm("Are you sure you want to delete?");
        if (result === true) {
            window.location="<?=ROOT?>/<?=Auth::getrole()?>/deleteAccount/confirm"
        }
    }
</script>