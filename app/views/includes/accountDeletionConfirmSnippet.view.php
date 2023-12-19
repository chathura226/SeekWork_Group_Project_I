
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/bookmark-button.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/floating-button.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/deleteAccount.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/one-field-form.styles.css"/>

<div class="pagetitle column-12">
    <h1>Confirm Deletion</h1>
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

<div class="one-form-container c-s-5 c-e-9 row-2">
    <div class="logo-container">
        Confirm Deletion
    </div>

    <form class="form" method="post">
        <div class="form-group">
            <label for="email">Enter your password to confirm deletion of your account</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required="">
        </div>

        <button class="form-submit-btn" type="submit" style="background-color: red;font-size: 15px;"><b>Delete</b></button>
    </form>

</div>
