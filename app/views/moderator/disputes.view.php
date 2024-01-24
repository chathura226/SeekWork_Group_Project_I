<?php $this->view('moderator/moderator-header', $data) ?>
    <link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/tab-containers.styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">


    <div class="pagetitle column-12">
        <h1>Disputes</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>

                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Disputes</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content">
        <div class="tab-radio-inputs">
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="all" checked="">
                <span class="name">All</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="pending">
                <span class="name">Pending Disputes</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="resolved">
                <span class="name">Resolved Disputes</span>
            </label>


        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <h2>All Disputes</h2>
                <?php if (!empty($disputes)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>DisputeID</th>
                            <th>Dispute Description</th>
                            <th>Status</th>
                            <th>Dispute Date</th>
                            <th>Initiated Party</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($disputes)): foreach ($disputes as $dispute): ?>
                            <tr style="height: 70px">
                                <th><?= $dispute->disputeID ?></th>
                                <td><?= limitCharacters($dispute->subject, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($dispute->status)?><!--</td>-->
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
                                <td>
                                    <div class="status-btn-like"
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($dispute->status) ?></div>
                                </td>
                                <td><?= $dispute->createdAt ?></td>
                                <td><?= ucfirst($dispute->initiatedParty) ?></td>
                                <td>
                                    <div class="flex"
                                         style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                        <a href="<?= ROOT ?>/moderator/disputes/<?= $dispute->disputeID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Details</button>
                                        </a>
                                        <a href="<?= ROOT ?>/moderator/tasks/<?= $dispute->taskID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Go to Task</button>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No disputes</h2> <?php endif; ?>
            </div>
            <div class="content-box-content" id="pending">
                <h2>Pending Disputes</h2>
                <?php if (!empty($disputes)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>DisputeID</th>
                            <th>Dispute Description</th>
                            <th>Status</th>
                            <th>Dispute Date</th>
                            <th>Initiated Party</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($disputes)): foreach ($disputes as $dispute): ?>
                            <?php if ($dispute->status == 'pending'): ?>
                                <tr style="height: 70px">
                                    <th><?= $dispute->disputeID ?></th>
                                    <td><?= limitCharacters($dispute->subject, 25) ?></td>
                                    <!--                            <td>-->
                                    <?php //=ucfirst($dispute->status)?><!--</td>-->
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
                                    <td>
                                        <div class="status-btn-like"
                                             style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($dispute->status) ?></div>
                                    </td>
                                    <td><?= $dispute->createdAt ?></td>
                                    <td><?= ucfirst($dispute->initiatedParty) ?></td>
                                    <td>
                                        <div class="flex"
                                             style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                            <a href="<?= ROOT ?>/moderator/disputes/<?= $dispute->disputeID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Details</button>
                                            </a>
                                            <a href="<?= ROOT ?>/moderator/tasks/<?= $dispute->taskID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Go to Task</button>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No disputes</h2><?php endif; ?>

            </div>

            <div class="content-box-content" id="resolved">
                <h2>Resolved Disputes</h2>
                <?php if (!empty($disputes)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>DisputeID</th>
                            <th>Dispute Description</th>
                            <th>Status</th>
                            <th>Dispute Date</th>
                            <th>Initiated Party</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($disputes)): foreach ($disputes as $dispute): ?>
                            <?php if ($dispute->status == 'resolved'): ?>
                                <tr style="height: 70px">
                                    <th><?= $dispute->disputeID ?></th>
                                    <td><?= limitCharacters($dispute->subject, 25) ?></td>
                                    <!--                            <td>-->
                                    <?php //=ucfirst($dispute->status)?><!--</td>-->
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
                                    <td>
                                        <div class="status-btn-like"
                                             style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($dispute->status) ?></div>
                                    </td>
                                    <td><?= $dispute->createdAt ?></td>
                                    <td><?= ucfirst($dispute->initiatedParty) ?></td>
                                    <td>
                                        <div class="flex"
                                             style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                            <a href="<?= ROOT ?>/moderator/disputes/<?= $dispute->disputeID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Details</button>
                                            </a>
                                            <a href="<?= ROOT ?>/moderator/tasks/<?= $dispute->taskID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Go to Task</button>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No disputes</h2> <?php endif; ?>

            </div>


        </div>
    </div>

    <script>
        // Get all radio buttons by their name
        const radioButtons = document.getElementsByName("radioForTab");

        const contentBoxes = document.querySelectorAll(".content-box-content")

        //default one
        contentBoxes[0].style.display = 'block'

        // Attach click event listener to each radio button
        for (const radioButton of radioButtons) {
            radioButton.addEventListener("click", radioButtonClicked);
        }

        // Function to handle radio button click event
        function radioButtonClicked() {
            // Loop through all radio buttons
            for (const radioButton of radioButtons) {
                // Check if the radio button is checked
                if (radioButton.checked) {
                    // Get the value of the checked radio button
                    const selectedValue = radioButton.value;
                    // console.log(`Selected option: ${selectedValue}`);
                    contentBoxes.forEach((box) => {
                        box.style.display = 'none'
                    })
                    var x = document.getElementById(selectedValue).style.display = 'block';
                }
            }
        }

    </script>
<?php $this->view('moderator/moderator-footer', $data) ?>