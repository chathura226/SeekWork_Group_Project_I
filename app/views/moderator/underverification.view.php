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

<div id="popup1" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div class="wrapper">
            <div class="form-wrap column-12 row-6">
                <div class="tab-form row-">
                    <div class="myheader">
                        <div class="active-login"><h2>Change Verification Status</h2></div>
                    </div>
                    <div class="tab-body ">
                        <div class="active1">
                            <form method="post">
                                </br>

                                <input value="" name="verificationID" id="verificationID" hidden>


                                <div class="form-input">
                                    <label>Comments</label>
                                    <textarea rows="10" cols="45" id="comments" name="comments"
                                              placeholder="Enter  Comments about the verification review"
                                              required></textarea>
                                    <br>

                                </div>

                                <div class="form-input">
                                    <label>Status</label>
                                    <select id="status" name="status" required>
                                        <option value="underReview" selected>Under Review</option>
                                        <option value="reviewed">Reviewed</option>
                                    </select>
                                </div>


                                <div class="form-input">
                                    <button>Submit for Approval</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
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
                        <a href="<?= ROOT ?>/moderator/profile/<?= $underReviews[$i]->userID ?>">See Profile</a>
                    </td>
                    <td>
                        <a href="<?= ROOT ?>/download/verification/<?= $underReviews[$i]->userID ?>/<?= $underReviews[$i]->verificationID ?>">Download
                            Document</a></td>
                    <td> <?= ($underReviews[$i]->status == 'underReview') ? 'Under Review' : 'Reviewed' ?></td>

                    <td><a class="popouplink" href="#" data-id="<?= $underReviews[$i]->verificationID ?>">Change
                            Status</a></td>

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


<script>

    var modal = document.getElementById('popup1');

    var link = document.getElementsByClassName('popouplink');
    var linkArray = [...link]
    var closeBtn = document.getElementsByClassName('close')[0];

    var verificationIDInput = document.getElementById('verificationID');
    linkArray.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action of the link
            modal.style.display = 'block';
            verificationIDInput.value = item.getAttribute('data-id')
            // console.log(item.getAttribute('data-id'))
        });
    })


    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
<?php $this->view('moderator/moderator-footer', $data) ?>
