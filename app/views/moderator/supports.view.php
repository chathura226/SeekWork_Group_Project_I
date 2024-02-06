<?php $this->view('moderator/moderator-header', $data) ?>
    <link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/tab-containers.styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">


    <div class="pagetitle column-12">
        <h1>Support Requests</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>

                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Support Requests</a>
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
                <span class="name">Pending Support Requests</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="resolved">
                <span class="name">Resolved Support Requests</span>
            </label>


        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <h2>All Support Requests</h2>
                <?php if (!empty($supports)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>SupportID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($supports)): foreach ($supports as $support): ?>
                            <tr style="height: 70px">
                                <th><?= $support->supportID ?></th>
                                <td><?= limitCharacters($support->subject, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($dispute->status)?><!--</td>-->
                                <?php $statusColor = 'yellow';
                                switch ($support->status) {
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
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($support->status) ?></div>
                                </td>
                                <td><?= $support->createdAt ?></td>
                                <td>
                                    <div class="flex"
                                         style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                        <a href="<?= ROOT ?>/moderator/support/<?= $support->supportID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Details</button>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No support requests</h2> <?php endif; ?>
            </div>
            <div class="content-box-content" id="pending">
                <h2>Pending Support Requests</h2>
                <?php if (!empty($supports)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>SupportID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($supports)): foreach ($supports as $support):if($support->status=='pending'): ?>
                            <tr style="height: 70px">
                                <th><?= $support->supportID ?></th>
                                <td><?= limitCharacters($support->subject, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($dispute->status)?><!--</td>-->
                                <?php $statusColor = 'yellow';
                                switch ($support->status) {
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
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($support->status) ?></div>
                                </td>
                                <td><?= $support->createdAt ?></td>
                                <td>
                                    <div class="flex"
                                         style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                        <a href="<?= ROOT ?>/moderator/support/<?= $support->supportID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Details</button>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        <?php endif; endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No support requests</h2><?php endif; ?>

            </div>

            <div class="content-box-content" id="resolved">
                <h2>Resolved Support Requests</h2>
                <?php if (!empty($disputes)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>SupportID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($supports)): foreach ($supports as $support):if($support->status=='pending'): ?>
                            <tr style="height: 70px">
                                <th><?= $support->supportID ?></th>
                                <td><?= limitCharacters($support->subject, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($dispute->status)?><!--</td>-->
                                <?php $statusColor = 'yellow';
                                switch ($support->status) {
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
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($support->status) ?></div>
                                </td>
                                <td><?= $support->createdAt ?></td>
                                <td>
                                    <div class="flex"
                                         style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                        <a href="<?= ROOT ?>/moderator/support/<?= $support->supportID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Details</button>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        <?php endif; endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h2>No support requests</h2> <?php endif; ?>

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