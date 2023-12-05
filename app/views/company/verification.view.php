<?php $this->view('company/company-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">


<link rel="stylesheet" href="<?= ROOT ?>/assets/css/company-verification.styles.css"/>

<div class="pagetitle column-12">
    <h1>Verification</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/Verification"
                   class="breadcrumbs__link breadcrumbs__link--active">Verification</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->
<?php if (!empty($verifications)): ?>
    <div class="profile-details c-s-2 c-e-11 ">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Documents</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < sizeof($verifications); $i++): ?>
                <tr>
                    <th><?= $i + 1 ?></th>
                    <td> <?= array_reverse(explode('/',$verifications[$i]->documents))[0] ?> <a href="<?= ROOT ?>/download/verification/<?= Auth::getuserID() ?>/<?=$verifications[$i]->verificationID?>">Download</a></td>
                    <td> <?= ($verifications[$i]->status=='reviewed')?'Reviewed':'Under Review' ?></td>
                    <td> <?= $verifications[$i]->comments ?></td>

                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
<div class="form-wrap column-12 row-5">
    <div class="tab-form  row-4">
        <div class="alert alert-danger text-center">Your account is not yet verified! Please fill the details
            and upload
            relavant documents!
        </div>
        <div class="myheader">
            <div class="active-login"><h2>Profile Details and Verification Documents</h2></div>
        </div>
        <div class="tab-body">
            <div class="active1">

                <form method="post" enctype="multipart/form-data">
                    </br>


                    <div class="form-input">

                        <label>Company Description</label>
                        <textarea value="" rows="5" cols="45" id="description" name="description"
                                  placeholder="Enter a description about you"><?= (isset($_POST['description'])) ? set_value('description') : Auth::getdescription() ?></textarea>
                        <br>
                        <!-- <input   class="" type="text" name="description" id="description" placeholder="Enter a description about you">               -->
                        <?php if (!empty($errors['description'])): ?>
                            <div class="text-error"><small><?= $errors['description'] ?></small></div>
                        <?php endif; ?>
                    </div>


                    <div class="form-input">
                        <label>Clear Image of the Business Registration</label>
                        <input onchange="load_image(this.files[0])" class="" type="file" name="imageInput"
                               id="imageInput" accept="image/*">
                        <div class="image-container">
                            <img id="uploadedImage" ?>
                        </div>
                        <?php if (!empty($errors['imageInput'])): ?>
                            <div class="text-error"><small><?= $errors['imageInput'] ?></small></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-input">
                        <button>Submit for Approval</button>
                    </div>
                </form>
                <?php endif; ?>

            </div>

        </div>

    </div>
</div>


<script src="<?= ROOT ?>/assets/js/main.js"></script>

<?php $this->view('company/company-footer', $data) ?>
