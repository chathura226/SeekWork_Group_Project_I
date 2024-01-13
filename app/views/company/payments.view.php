<?php $this->view('company/company-header', $data) ?>
    <link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/tab-containers.styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">


    <div class="pagetitle column-12">
        <h1>Payments</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>

                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Payments</a>
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
                <input type="radio" name="radioForTab" value="outstanding">
                <span class="name">Outstanding Payments</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="completed">
                <span class="name">Completed Payments</span>
            </label>


        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <h2>All Payments</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>PaymentID</th>
                        <th>Payment Description</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <tr style="height: 70px">
                            <th><?= $payment->paymentID ?></th>
                            <td><?= limitCharacters($payment->paymentDescription, 25) ?></td>
                            <!--                            <td>-->
                            <?php //=ucfirst($payment->paymentStatus)?><!--</td>-->
                            <?php $statusColor = 'yellow';
                            switch ($payment->paymentStatus) {
                                case 'completed':
                                    $statusColor = 'green';
                                    $textColor = 'whitesmoke';
                                    break;
                                case 'outstanding':
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
                                     style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($payment->paymentStatus) ?></div>
                            </td>
                            <td><?= (!empty($payment->paidDate)) ? $payment->paidDate : 'N/A' ?></td>
                            <?php if ($payment->paymentStatus == 'outstanding'): ?>
                                <td>
                                    <div class="flex"
                                         style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                        <a href="<?= ROOT ?>/company/payments/<?= $payment->paymentID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Pay Now</button>
                                        </a>
                                        <a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Go to Task</button>
                                        </a>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td><a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                       style="text-decoration: none;">
                                        <button class="status-btn-working">Go to Task</button>
                                    </a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="content-box-content" id="outstanding">
                <h2>Outstanding Payments</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>PaymentID</th>
                        <th>Payment Description</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <?php if ($payment->paymentStatus == 'outstanding'): ?>
                            <tr style="height: 70px">
                                <th><?= $payment->paymentID ?></th>
                                <td><?= limitCharacters($payment->paymentDescription, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($payment->paymentStatus)?><!--</td>-->
                                <?php $statusColor = 'yellow';
                                switch ($payment->paymentStatus) {
                                    case 'completed':
                                        $statusColor = 'green';
                                        $textColor = 'whitesmoke';
                                        break;
                                    case 'outstanding':
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
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($payment->paymentStatus) ?></div>
                                </td>
                                <td><?= (!empty($payment->paidDate)) ? $payment->paidDate : 'N/A' ?></td>
                                <?php if ($payment->paymentStatus == 'outstanding'): ?>
                                    <td>
                                        <div class="flex"
                                             style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                            <a href="<?= ROOT ?>/company/payments/<?= $payment->paymentID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Pay Now</button>
                                            </a>
                                            <a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Go to Task</button>
                                            </a>
                                        </div>
                                    </td>
                                <?php else: ?>
                                    <td><a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Go to Task</button>
                                        </a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <div class="content-box-content" id="completed">
                <h2>Completed Payments</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>PaymentID</th>
                        <th>Payment Description</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <?php if ($payment->paymentStatus == 'completed'): ?>
                            <tr style="height: 70px">
                                <th><?= $payment->paymentID ?></th>
                                <td><?= limitCharacters($payment->paymentDescription, 25) ?></td>
                                <!--                            <td>-->
                                <?php //=ucfirst($payment->paymentStatus)?><!--</td>-->
                                <?php $statusColor = 'yellow';
                                switch ($payment->paymentStatus) {
                                    case 'completed':
                                        $statusColor = 'green';
                                        $textColor = 'whitesmoke';
                                        break;
                                    case 'outstanding':
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
                                         style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($payment->paymentStatus) ?></div>
                                </td>
                                <td><?= (!empty($payment->paidDate)) ? $payment->paidDate : 'N/A' ?></td>
                                <?php if ($payment->paymentStatus == 'outstanding'): ?>
                                    <td>
                                        <div class="flex"
                                             style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                            <a href="<?= ROOT ?>/company/payments/<?= $payment->paymentID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Pay Now</button>
                                            </a>
                                            <a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                               style="text-decoration: none;">
                                                <button class="status-btn-working">Go to Task</button>
                                            </a>
                                        </div>
                                    </td>
                                <?php else: ?>
                                    <td><a href="<?= ROOT ?>/company/tasks/<?= $payment->taskID ?>"
                                           style="text-decoration: none;">
                                            <button class="status-btn-working">Go to Task</button>
                                        </a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>
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
<?php $this->view('company/company-footer', $data) ?>