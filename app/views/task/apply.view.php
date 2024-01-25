<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>

    <link href="<?= ROOT ?>/assets/css/apply.styles.css" rel="stylesheet">


    <div class="pagetitle column-12">
        <h1>Apply for '<?= $task->title ?>'</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/tasks" class="breadcrumbs__link">Tasks</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/tasks/<?= $task->taskID ?>" class="breadcrumbs__link"><?= $task->title ?></a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">Apply</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->


    <div class="tab-form c-s-3 c-e-11 row-4">
        <div class="myheader">
            <div class="active-login"><h2>Proposal</h2></div>
        </div>
        <div class="tab-body">
            <div class="active1">
                <form method="post" enctype="multipart/form-data">
                    </br>
                    <h3>Student Details</h3>
                    <hr>
                    <div class="form-input">
                        <label>First Name</label>
                        <input value="<?= Auth::getfirstName() ?>"
                               class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text"
                               name="firstName" id="firstName" placeholder="Enter your first name" disabled>
                        <?php if (!empty($errors['firstName'])): ?>
                            <div class="text-error"><small><?= $errors['firstName'] ?></small></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-input">
                        <label>Last Name</label>
                        <input value="<?= Auth::getlastName() ?>"
                               class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text"
                               name="lastName" id="lastName" placeholder="Enter your last name" disabled>
                        <?php if (!empty($errors['lastName'])): ?>
                            <div class="text-error"><small><?= $errors['lastName'] ?></small></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-input">
                        <label>University</label>
                        <input value="<?= Auth::getuniversityName() ?>"
                               class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text"
                               name="address" id="address" placeholder="Enter your address" disabled>
                        <?php if (!empty($errors['address'])): ?>
                            <div class="text-error"><small><?= $errors['address'] ?></small></div>
                        <?php endif; ?>
                    </div>

                    </br>
                    <h3>Task Details</h3>
                    <hr>

                    <div class="form-input">
                        <label>Task Title</label>
                        <input value="<?= ucfirst($task->title) ?>" type="text" name="title" id="title" placeholder=""
                               disabled>
                    </div>
                    <div class="form-input">
                        <label>Task Type</label>
                        <input value="<?= ucfirst($task->taskType) ?>" type="text" name="taskType" id="taskType"
                               placeholder="" disabled>
                    </div>


                    </br>
                    <h3>Proposal Details</h3>
                    <hr>

                    <div class="form-input">
                        <label>Proposal Description</label>
                        <textarea rows="10" cols="45" id="description" name="description"
                                  placeholder="Enter your proposal"><?= set_value('description') ?></textarea>
                        <br>
                        <?php if (!empty($errors['description'])): ?>
                            <div class="text-error"><small><?= $errors['description'] ?></small></div>
                        <?php endif; ?>
                        <!-- <input   class="" type="text" name="description" id="description" placeholder="Enter a description about you">               -->
                    </div>

                    <div class="form-input">
                        <label>Any Related Document</label>
                        <small>If there are more than one file, Zip the files before upload</small>
                        <?php if ($task->isPdfRequiredProposal): ?>
                            <small><br>For this task, file submission with proposal is required!</small>
                        <?php endif; ?>
                        <input class="" type="file" name="documents"
                               id="documents" <?= ($task->isPdfRequiredProposal) ? 'required' : ''; ?>>
                        <?php if (!empty($errors['documents'])): ?>
                            <div class="text-error"><small><?= $errors['documents'] ?></small></div>
                        <?php endif; ?>
                    </div>


                    <div class="form-input">
                        <label>Proposing Price</label>

                        <?php if ($task->taskType !== 'auction'): ?>
                            <input value="Rs.<?= ucfirst($task->value) ?>/=" type="text" name="value" id="value"
                                   placeholder="Enter the bidding value" disabled>
                            <small>Since the task is Fixed Price, You can't change the value</small>
                        <?php else: ?>
                            <input value="<?= set_value('proposeAmount') ?>" type="number" name="proposeAmount"
                                   id="proposeAmount" placeholder="Enter the bidding value">
                        <?php endif; ?>
                        <?php if (!empty($errors['proposeAmount'])): ?>
                            <div class="text-error"><small><?= $errors['proposeAmount'] ?></small></div>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="taskID" value="<?= $task->taskID ?>">

                    <div class="form-input">
                        <button>Apply</button>
                    </div>
                </form>
            </div>

        </div>

    </div>


<?php $this->view("includes/footer", $data);