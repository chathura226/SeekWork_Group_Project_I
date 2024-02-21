<?php $this->view('moderator/moderator-header', $data) ?>

<link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">
<link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
<link href="<?= ROOT ?>/assets/css/tab-containers.styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">


<div class="pagetitle column-12">
    <h1>Tasks</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>

            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Tasks</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content">
    <div class="tab-radio-inputs">
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="all" checked="">
            <span class="name">All Tasks</span>
        </label>
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="active">
            <span class="name">Active Tasks</span>
        </label>

        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="inProgress">
            <span class="name">Tasks InProgress</span>
        </label>

        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="closed">
            <span class="name">Closed Tasks</span>
        </label>
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="disabled">
            <span class="name">Disabled Tasks</span>
        </label>

    </div>
    <div class="content-box">
        <div class="content-box-content" id="all">
            <h2>All Tasks</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): ?>
                    <tr style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,28) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($earning->earningStatus) {
                            case 'withdrawn':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'requested':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($earning->earningStatus) ?></div>
                        </td>
                        <td><?= (!empty($earning->transactionDate)) ? $earning->transactionDate : 'N/A' ?></td>
                        <?php if ($earning->earningStatus == 'requested'): ?>
                            <td>
                                <div class="flex"
                                     style="margin: auto;justify-content: center;align-items: center;gap: 20px">
                                    <a href="" class="popouplink"
                                       style="text-decoration: none;" data-id="<?= $earning->transactionID ?>" data-details='<?php
                                    $dataNew=[];
                                    $dataNew['bankName']=$earning->bankName;
                                    $dataNew['branch']=$earning->branch;
                                    $dataNew['accNo']=$earning->accNo;
                                    echo json_encode($dataNew);
                                    ?>'>
                                        <button class="status-btn-working">Change Status</button>
                                    </a>

                                    <a href="<?= ROOT ?>/moderator/tasks/<?= $earning->taskID ?>"
                                       style="text-decoration: none;">
                                        <button class="status-btn-working">Go to Task</button>
                                    </a>
                                    <a href="<?= ROOT ?>/moderator/profile/<?= $earning->userID ?>"
                                       style="text-decoration: none;">
                                        <button class="status-btn-working">View Student</button>
                                    </a>
                                </div>
                            </td>
                        <?php else: ?>
                            <td>
                                <div class="flex"
                                     style="margin: auto;justify-content: center;align-items: center;gap: 20px"><a
                                        href="<?= ROOT ?>/moderator/tasks/<?= $earning->taskID ?>"
                                        style="text-decoration: none;">
                                        <button class="status-btn-working">Go to Task</button>
                                    </a>
                                    <a href="<?= ROOT ?>/moderator/profile/<?= $earning->userID ?>"
                                       style="text-decoration: none;">
                                        <button class="status-btn-working">View Student</button>
                                    </a></div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; else: ?>
                    <h3>No Requests available!</h3>
                <?php endif; ?>

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


<!--for popup-->

<script>

    var modal = document.getElementById('popup1');

    var link = document.getElementsByClassName('popouplink');
    var linkArray = [...link]
    var closeBtn = document.getElementsByClassName('close')[0];

    var verificationIDInput = document.getElementById('transactionID');
    linkArray.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action of the link
            modal.style.display = 'block';
            verificationIDInput.value = item.getAttribute('data-id')
            dataObj = item.getAttribute('data-Details')
            dataObj=JSON.parse(dataObj)
            document.getElementById('bankName').value=dataObj.bankName;
            document.getElementById('branch').value=dataObj.branch;
            document.getElementById('accNo').value=dataObj.accNo;
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
