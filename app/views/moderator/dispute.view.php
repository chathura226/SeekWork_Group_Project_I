<?php $this->view('moderator/moderator-header', $data) ?>


    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eachtask.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">
    <link href="<?= ROOT ?>/assets/css/company-verification.styles.css" rel="stylesheet">


    <div class="pagetitle column-12">
        <h1>Dispute Details</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/moderator/disputes" class="breadcrumbs__link">Disputes</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">View Details</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="task-details-wrapper column-12">

    <div class="task-details column-7">
        <h2>Dispute Description</h2>
        <div class="task-description">

            <?= $dispute->description ?>
            <br>

        </div>
        <br>
        <br>

        <div class="about-task">
            <h2>About the Dispute</h2>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l44.9 74.7c-16.1 17.6-28.6 38.5-36.6 61.5c-1.9-1.8-3.5-3.9-4.9-6.3L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152zM432 224a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm0 240a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm0-192c-8.8 0-16 7.2-16 16v80c0 8.8 7.2 16 16 16s16-7.2 16-16V288c0-8.8-7.2-16-16-16z"/>
                </svg>

                Dispute Initiated Party : (<?= ucfirst($dispute->initiatedParty) ?>)
                <?= ucfirst($dispute->complainer->firstName) . ' ' . ucfirst($dispute->complainer->lastName) ?> <a
                        href="<?= ROOT ?>/<?= Auth::getrole() ?>/profile/<?= $dispute->complainer->userID ?>"> Check
                    Profile</a></br>

            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 640 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M480 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-8 384V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V256.9l28.6 47.5c9.1 15.1 28.8 20 43.9 10.9s20-28.8 10.9-43.9l-58.3-97c-17.4-28.9-48.6-46.6-82.3-46.6H465.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L408 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32zM190.9 18.1C188.4 12 182.6 8 176 8s-12.4 4-14.9 10.1l-29.4 74L55.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1L10.9 206.4c-5.4 3.7-8 10.3-6.5 16.7s6.7 11.2 13.1 12.2l78.7 12.2L90.6 327c-.5 6.5 3.1 12.7 9 15.5s12.9 1.8 17.8-2.6L176 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 50.5-7.8 24.3-40.5-55.2-38L315 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L220.3 92.1l-29.4-74z"/>
                </svg>

                Associated other Party : (<?= $dispute->initiatedParty == 'company' ? 'Student' : 'Company' ?>)
                <?= ucfirst($dispute->target->firstName) . ' ' . ucfirst($dispute->target->lastName) ?> <a
                        href="<?= ROOT ?>/<?= Auth::getrole() ?>/profile/<?= $dispute->target->userID ?>"> Check
                    Profile</a></br>

            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M448 160H320V128H448v32zM48 64C21.5 64 0 85.5 0 112v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zM448 352v32H192V352H448zM48 288c-26.5 0-48 21.5-48 48v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48H48z"/>
                </svg>


                Related Task :
                <?=limitCharacters( ucfirst($dispute->task->title),25) ?> <a
                        href="<?= ROOT ?>/<?= Auth::getrole() ?>/tasks/<?= $dispute->task->taskID ?>"> Check
                    Task</a></br>

            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                    <path d="M176 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h16V98.4C92.3 113.8 16 200 16 304c0 114.9 93.1 208 208 208s208-93.1 208-208c0-41.8-12.3-80.7-33.5-113.2l24.1-24.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L355.7 143c-28.1-23-62.2-38.8-99.7-44.6V64h16c17.7 0 32-14.3 32-32s-14.3-32-32-32H224 176zm72 192V320c0 13.3-10.7 24-24 24s-24-10.7-24-24V192c0-13.3 10.7-24 24-24s24 10.7 24 24z"/>
                </svg>
                Dispute Date : <?= $dispute->createdAt ?></br>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/>
                </svg>
                <?php $statusColor = 'yellow';
                switch ($dispute->status) {
                    case 'resolved':
                        $statusColor = 'green';
                        $textColor = 'whitesmoke';
                        break;
                    case 'pending':
                        $statusColor = 'yellow';
                        $textColor = 'var(--text-color)';
                        break;
                    default:
                        $statusColor = 'yellow';
                        $textColor = 'var(--text-color)';
                        break;

                }; ?>
                Dispute Status :
                <div class="status-btn-like-for-desc"
                     style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($dispute->status) ?></div>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                    <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
                Dispute Resolved Date
                : <?php if ($dispute->status === 'pending') echo "Dispute Review Pending </br>"; else echo $dispute->resolvedDate . "</br>"; ?>
            </div>

        </div>
    </div>

    <?php if ($dispute->status != 'resolved'): ?>
        <div class="price-button c-s-8 c-e-13">

            <a>
                <button id="acceptBtn" class="apply"
                        onclick="resolvedDispute(event,<?= $dispute->disputeID ?>);">Mark as resolved
                </button>
            </a>
        </div>
    <?php else: ?>
        <div class="task-details column-5">
            <h2 style="color: <?= ($dispute->status == 'accepted') ? 'green' : 'red' ?>;">Dispute Review Report</h2>
            <div class="task-description">

                You already <span
                        style="color: <?= ($dispute->status == 'resolved') ? 'green' : 'red' ?>">resolved</span>
                this dispute on <?= $dispute->resolvedDate ?>.
                <br>

            </div>
            <br>
            <br>

            <h2>Comments:</h2>
            <div class="task-description">
                <?= $dispute->moderatorComment ?>
                </br>
            </div>

        </div>
    <?php endif; ?>

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

                                    <input type="text" value="" name="status" id="status" hidden/>


                                    <div class="form-input">
                                        <label>Comments</label>
                                        <textarea rows="10" cols="45" id="moderatorComment" name="moderatorComment"
                                                  placeholder="Enter  Comments about the dispute"
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
        var popup_header = document.getElementById('popup_header');
        var popup_button = document.getElementById("popup_button");
        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        function resolvedDispute(e, submissionID) {
            popup_header.innerHTML = "Resolve Dispute";
            document.getElementById("status").value = "resolved";
            popup_button.innerHTML = "Resolve";
            modal.style.display = 'block';

        }


    </script>





<?php $this->view('moderator/moderator-footer', $data) ?>