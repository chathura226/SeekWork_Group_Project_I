<?php $this->view('company/company-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/tab-containers.styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/tables.styles.css">


<div class="pagetitle column-12">
      <h1>Pending Assignment Invitations</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>

          <li class="breadcrumbs__item">
            <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Pending Invites</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->
<label for="assignments" id="assignments" hidden><?=(!empty($assignments))?json_encode($assignments):json_encode('')?></label>

    <div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content">
        <div class="tab-radio-inputs">
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="all" checked="">
                <span class="name">All</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="pending">
                <span class="name">Pending</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="accepted">
                <span class="name">Accepted</span>
            </label>

            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="declined">
                <span class="name">Declined</span>
            </label>

        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <h2>All Invitations</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>InviteID</th>
                        <th>Task Title</th>
                        <th>Invited Date</th>
                        <th>Status</th>
                        <th>Reply Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment):?>
                        <tr style="height: 70px">
                            <th><?=$assignment->assignmentID?></th>
                            <td><?=limitCharacters($assignment->title,13)?></td>
                            <td><?=$assignment->assignmentDate?></td>
                            <?php $statusColor='green'; switch ($assignment->assignmentStatus){
                                case 'accepted':
                                    $statusColor='green';
                                    $textColor='whitesmoke';
                                    break;
                                case 'declined':
                                    $statusColor='red';
                                    $textColor='whitesmoke';
                                    break;
                                default:
                                    $statusColor='yellow';
                                    $textColor='var(--text-color)';
                                    break;

                            };?>
                            <td><div class="status-btn-like" style="background-color: <?=$statusColor?>;color: <?=$textColor?>"> <?=ucfirst($assignment->assignmentStatus)?></div></td>
                            <td><?=(!empty($assignment->replyDate))?$assignment->replyDate:'N/A'?></td>

                            <td><a href="<?=ROOT?>/company/tasks/<?=$assignment->taskID?>" style="text-decoration: none;"><button class="status-btn-working">Go to task</button></a></td>

                        </tr>
                    <?php endforeach;?>

                    </tbody>
                </table>
            </div>
            <div class="content-box-content" id="accepted">
                <h2>Accepted Invitations</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>InviteID</th>
                        <th>Task Title</th>
                        <th>Invited Date</th>
                        <th>Status</th>
                        <th>Reply Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment): if($assignment->assignmentStatus=='accepted'):?>
                        <tr style="height: 70px">
                            <th><?=$assignment->assignmentID?></th>
                            <td><?=limitCharacters($assignment->title,13)?></td>
                            <td><?=$assignment->assignmentDate?></td>
                            <?php $statusColor='green'; switch ($assignment->assignmentStatus){
                                case 'accepted':
                                    $statusColor='green';
                                    $textColor='whitesmoke';
                                    break;
                                case 'declined':
                                    $statusColor='red';
                                    $textColor='whitesmoke';
                                    break;
                                default:
                                    $statusColor='yellow';
                                    $textColor='var(--text-color)';
                                    break;

                            };?>
                            <td><div class="status-btn-like" style="background-color: <?=$statusColor?>;color: <?=$textColor?>"> <?=ucfirst($assignment->assignmentStatus)?></div></td>
                            <td><?=(!empty($assignment->replyDate))?$assignment->replyDate:'N/A'?></td>

                            <td><a href="<?=ROOT?>/company/tasks/<?=$assignment->taskID?>" style="text-decoration: none;"><button class="status-btn-working">Go to task</button></a></td>

                        </tr>
                    <?php endif;endforeach;?>

                    </tbody>
                </table>
            </div>
            <div class="content-box-content" id="declined">
                <h2>Declined Invitations</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>InviteID</th>
                        <th>Task Title</th>
                        <th>Invited Date</th>
                        <th>Status</th>
                        <th>Reply Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment): if($assignment->assignmentStatus=='declined'):?>
                        <tr style="height: 70px">
                            <th><?=$assignment->assignmentID?></th>
                            <td><?=limitCharacters($assignment->title,13)?></td>
                            <td><?=$assignment->assignmentDate?></td>
                            <?php $statusColor='green'; switch ($assignment->assignmentStatus){
                                case 'accepted':
                                    $statusColor='green';
                                    $textColor='whitesmoke';
                                    break;
                                case 'declined':
                                    $statusColor='red';
                                    $textColor='whitesmoke';
                                    break;
                                default:
                                    $statusColor='yellow';
                                    $textColor='var(--text-color)';
                                    break;

                            };?>
                            <td><div class="status-btn-like" style="background-color: <?=$statusColor?>;color: <?=$textColor?>"> <?=ucfirst($assignment->assignmentStatus)?></div></td>
                            <td><?=(!empty($assignment->replyDate))?$assignment->replyDate:'N/A'?></td>

                            <td><a href="<?=ROOT?>/company/tasks/<?=$assignment->taskID?>" style="text-decoration: none;"><button class="status-btn-working">Go to task</button></a></td>

                        </tr>
                    <?php endif;endforeach;?>

                    </tbody>
                </table>
            </div>
            <div class="content-box-content" id="pending">
                <h2>Pending Invitations</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>InviteID</th>
                        <th>Task Title</th>
                        <th>Invited Date</th>
                        <th>Status</th>
                        <th>Reply Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment): if($assignment->assignmentStatus=='pending'):?>
                        <tr style="height: 70px">
                            <th><?=$assignment->assignmentID?></th>
                            <td><?=limitCharacters($assignment->title,13)?></td>
                            <td><?=$assignment->assignmentDate?></td>
                            <?php $statusColor='green'; switch ($assignment->assignmentStatus){
                                case 'accepted':
                                    $statusColor='green';
                                    $textColor='whitesmoke';
                                    break;
                                case 'declined':
                                    $statusColor='red';
                                    $textColor='whitesmoke';
                                    break;
                                default:
                                    $statusColor='yellow';
                                    $textColor='var(--text-color)';
                                    break;

                            };?>
                            <td><div class="status-btn-like" style="background-color: <?=$statusColor?>;color: <?=$textColor?>"> <?=ucfirst($assignment->assignmentStatus)?></div></td>
                            <td><?=(!empty($assignment->replyDate))?$assignment->replyDate:'N/A'?></td>

                            <td><a href="<?=ROOT?>/company/tasks/<?=$assignment->taskID?>" style="text-decoration: none;"><button class="status-btn-working">Go to task</button></a></td>

                        </tr>
                    <?php endif;endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
    // Get all radio buttons by their name
    const radioButtons = document.getElementsByName("radioForTab");

    const contentBoxes=document.querySelectorAll(".content-box-content")

    //default one
    contentBoxes[0].style.display='block'

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
                contentBoxes.forEach((box)=>{box.style.display='none'})
                var x=document.getElementById(selectedValue).style.display ='block';
            }
        }
    }

</script>
<?php $this->view('company/company-footer',$data) ?>