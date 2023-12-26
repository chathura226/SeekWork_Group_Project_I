<?php $this->view('company/company-header', $data) ?>


    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eachtask.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">
    <link href="<?= ROOT ?>/assets/css/company-verification.styles.css" rel="stylesheet">


    <div class="pagetitle column-12">
        <h1>Submission Details</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/company/tasks" class="breadcrumbs__link">Tasks</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>"
                       class="breadcrumbs__link"><?= $task->title ?></a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>/submissions" class="breadcrumbs__link">Submissions</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">View Details</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="task-details-wrapper column-12">

    <div class="task-details column-7">
        <h2>Submission Description</h2>
        <div class="task-description">

            <?= $submission->note ?>
            <br>

        </div>
        <br>
        <br>

        <h2>Files:</h2>
        <div class="task-description">
            <?php if (!empty($submission->documents)) {
                echo '
            <table class="table table-striped">
                <thead>
                <tr>
                    <th >#</th>
                    <th >File Name</th>
                    <th >Download Link</th>
                </tr>
                </thead>
                <tbody> ';
                for ($i = 0; $i < sizeof($submission->documents); $i++):?>
                    <tr>
                        <th><?= $i + 1 ?></th>
                        <td> <?= $submission->documents[$i] ?></td>
                        <td>
                            <a href="<?= ROOT ?>/download/tasks/<?= $task->taskID ?>/submissions?file=<?= $submission->documents[$i] ?>">Download</a>
                        </td>
                    </tr>
                <?php endfor;
                echo "</tbody></table>";
            } else echo "No files submitted!"; ?>
            </br>
        </div>
        <div class="about-task">
            <h2>About the Submission</h2>

            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                    <path d="M176 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h16V98.4C92.3 113.8 16 200 16 304c0 114.9 93.1 208 208 208s208-93.1 208-208c0-41.8-12.3-80.7-33.5-113.2l24.1-24.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L355.7 143c-28.1-23-62.2-38.8-99.7-44.6V64h16c17.7 0 32-14.3 32-32s-14.3-32-32-32H224 176zm72 192V320c0 13.3-10.7 24-24 24s-24-10.7-24-24V192c0-13.3 10.7-24 24-24s24 10.7 24 24z"/>
                </svg>
                Submission Date : <?= $submission->createdAt ?></br>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/>
                </svg>
                Submission Status
                : <?php if ($submission->status === 'pendingReview') echo "Submission Review Pending </br>"; else echo ucfirst($submission->status) . "</br>"; ?>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                    <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
                Submission Reviewed Date
                : <?php if ($submission->status === 'pendingReview') echo "Submission Review Pending </br>"; else echo $submission->reviewedDate . "</br>"; ?>
            </div>

        </div>
    </div>

    <div class="price-button c-s-8 c-e-13">


        <a><button id="acceptBtn" class="apply" onclick="acceptSubmission(event,<?=$submission->submissionID?>);">Accept</button></a>
        &nbsp &nbsp
        <a><button id="rejectBtn" class="apply" onclick="rejectSubmission(event,<?=$submission->submissionID?>);">Reject</button></a>
        &nbsp &nbsp
    </div>

    <div id="popup1" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <div class="wrapper">
                <div class="form-wrap column-12 row-6">
                    <div class="tab-form row-">
                        <div class="myheader">
                            <div class="active-login"><h2 id="popup_header"></h2></div>
                        </div>
                        <div class="tab-body ">
                            <div class="active1">
                                <form method="post">
                                    </br>

                                    <input value="" name="status" id="status" hidden>


                                    <div class="form-input">
                                        <label>Comments</label>
                                        <textarea rows="10" cols="45" id="comments" name="comments"
                                                  placeholder="Enter  Comments about the submission"
                                                  required></textarea>
                                        <br>

                                    </div>




                                    <div class="form-input">
                                        <button id="popup_button"></button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    var modal = document.getElementById('popup1');
    var closeBtn = document.getElementsByClassName('close')[0];
    var popup_header=document.getElementById('popup_header');
    var status=document.getElementById('status');
    var popup_button=document.getElementById("popup_button");
    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    function acceptSubmission(e,submissionID){
        popup_header.innerHTML="Accept Submission";
        status.value="accepted";
        popup_button.innerHTML="Accept";
        modal.style.display = 'block';

    }

    function rejectSubmission(e,submissionID){
        popup_header.innerHTML="Reject Submission";
        status.value="rejected";
        popup_button.innerHTML="Reject";
        modal.style.display = 'block';

    }

</script>





<?php $this->view('company/company-footer', $data) ?>