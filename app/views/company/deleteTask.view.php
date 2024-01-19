<?php $this->view('company/company-header', $data) ?>
    <link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/updateprofile.styles.css" rel="stylesheet">


    <div class="pagetitle column-12">
        <h1>Delete the Task</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/tasks" class="breadcrumbs__link">Tasks</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/tasks/<?= $task->taskID ?>" class="breadcrumbs__link">Task</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">Delete Task</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->


    <div class="form-wrap column-12 row-6">
        <div class="tab-form row-4">

            <div class="myheader">
                <div class="active-login" style="background-color:#f33131;"><h2>Delete Task</h2></div>
            </div>
            <div class="tab-body">
                <div class="active1">
                    <form method="post">
                        You are about to delete the following task.<br><br>

                        Task Details
                        <hr>
                        <div class="form-input">
                            <label>Task Title</label>
                            <input value="<?= $task->title ?>"  type="text"
                                   name="title" id="title" placeholder="Enter a title for the task" disabled>
                            <?php if (!empty($errors['title'])) : ?>
                                <div class="text-error"><small><?= $errors['title'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>Task Type</label>
                            <select id="taskType" name="taskType" required disabled>
                                <option value="fixed Price" <?php if ($task->taskType === 'fixed Price') echo 'selected'; ?>>
                                    Fixed Price
                                </option>
                                <option value="auction" <?php if ($task->taskType === 'auction') echo 'selected'; ?>>
                                    Auction
                                </option>
                            </select>
                        </div>

                        <div class="form-input">
                            <label>Task Category</label>
                            <select id="categoryID" name="categoryID" required disabled>
                                <option value="" selected disabled><?= ucfirst($task->categoryTitle) ?></option>
                            </select>
                        </div>
                        Total Submissions that are under review : <?=$pendingSubmissions?><br>
                        Total Submissions : <?=$submissions?><br><br>
                        Confirm Deletion
                        <hr>
                        <div class="form-input">
                            <label>Do you want to delete this task? If so, enter " delete the task " in the following
                                field</label>
                            <!-- <input type="password" name="password"  placeholder="Enter a password" required>  -->
                            <input class="" type="text" name="confirm" id="confirm" placeholder="Enter the phrase"
                                   required>
                        </div>


                        <div class="form-input">
                            <button style="background-color: #f33131">Delete</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


    <script type="text/javascript" src="<?= ROOT ?>/assets/js/passwordStrengthForChangePass.js"></script>

<?php $this->view('company/company-footer', $data) ?>