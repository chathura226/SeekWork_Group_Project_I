<?php $this->view('company/company-header', $data) ?>

    <link href="<?= ROOT ?>/assets/css/post-task.styles.css" rel="stylesheet">


    <div class="pagetitle column-12">
        <h1>Modify Task - <?= $task->title ?></h1>
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
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">Modify</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="form-wrap column-12">

        <div class="tab-form">
            <div class="myheader">
                <div class="active-login">
                    <h2>Modify Task</h2>
                </div>
            </div>
            <div class="tab-body">
                <div class="active1">
                    <form method="post" enctype="multipart/form-data">
                        </br>
                        <h3>Company Details</h3>
                        <hr>
                        <div class="form-input">
                            <label>Company Name</label>
                            <input value="<?= ucfirst(Auth::getcompanyName()) ?>"
                                   class="<?= !empty($errors['companyName']) ? 'error-border' : '' ?>" type="text"
                                   name="companyName" id="companyName" placeholder="Enter the name of the company"
                                   disabled>
                            <?php if (!empty($errors['companyName'])) : ?>
                                <div class="text-error"><small><?= $errors['companyName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>Location</label>
                            <input value="<?= ucfirst(Auth::getaddress()) ?>"
                                   class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text"
                                   name="address" id="address" placeholder="Enter address of the company" disabled>
                            <?php if (!empty($errors['address'])) : ?>
                                <div class="text-error"><small><?= $errors['address'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        </br>
                        <h3>Task Details</h3>
                        <hr>
                        <div class="form-input">
                            <label>Task Title</label>
                            <input value="<?= (isset($_POST['title'])) ? set_value('title') : $task->title ?>"
                                   class="<?= !empty($errors['title']) ? 'error-border' : '' ?>" type="text"
                                   name="title" id="title" placeholder="Enter a title for the task">
                            <?php if (!empty($errors['title'])) : ?>
                                <div class="text-error"><small><?= $errors['title'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>Task Type</label>
                            <select id="taskType" name="taskType" required>
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
                            <select id="categoryID" name="categoryID" required>
                                <option value="" selected disabled>Select a Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value=<?= $category->categoryID ?> <?php if ($task->categoryID === $category->categoryID) echo 'selected'; ?>><?= ucfirst($category->title) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-input">
                            <label>Task Description</label>
                            <textarea rows="10" cols="45" id="description" name="description"
                                      placeholder="Describe your task"><?= (isset($_POST['description'])) ? set_value('description') : $task->description ?></textarea>
                            <br>
                            <?php if (!empty($errors['description'])) : ?>
                                <div class="text-error"><small><?= $errors['description'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        <div>Current required or preferred Skills :</div>
                        <div class="skill-wrapper">
                            <?php if (!empty($taskSkills)): foreach ($taskSkills as $skill): ?>
                                <div style="margin: 5px !important;" class="skill"
                                     data-id="<?= $skill->taskSkillID ?>"><?= $skill->skill ?>
                                    <button class="tag-close-btn">&times;</button>
                                </div>
                            <?php endforeach; else: ?>
                                No Skills added!
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            Required or preferred skills:
                            <div class="drop-input-container">
                                <label for="skills">Select or Add Skills:</label>
                                <div class="drop-input-group">
                                    <select id="skillsSelect" onchange="checkOtherOption(this)">
                                        <option value="" disabled selected>Select or type skill</option>
                                        <option value="other">Other...</option>
                                        <?php if (!empty($skills)): foreach ($skills as $skill): ?>
                                            <option id="<?= $skill->skillID ?>"
                                                    value="<?= $skill->skill ?>"><?= $skill->skill ?></option>
                                        <?php endforeach;endif; ?>
                                    </select>
                                </div>
                                <input type="text" id="newSkill" placeholder="Add new skill" style="display: none;">
                                <button onclick="addSkill(event)"
                                        style="margin-bottom: 5px; width:100px; background-color: black;color: white;">
                                    Add
                                </button>
                                <div class="horizontal-list">
                                    Newly Added Skills:
                                    <ul id="skillList"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <label>Any Related Document</label>
                            <?php if (!empty($task->documents)) : ?>
                                <?php $fileName = array_reverse(explode("/", $task->documents))[0]; ?>
                                Uploaded File: <?= $fileName ?><br>
                                <a href="<?= ROOT ?>/download/tasks/<?= $task->taskID ?>/details?file=<?= $fileName ?>">Download</a>
                                <br>
                                <small>Note that old file will be replaced by the new file you upload!</small><br>
                            <?php endif; ?>
                            <small>If there are more than one file, Zip the files before upload</small>
                            <input class="" type="file" name="documents" id="documents">
                            <?php if (!empty($errors['documents'])) : ?>
                                <div class="text-error"><small><?= $errors['documents'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-input">
                            <label>Price <small>(If the task is for bidding, enter the starting value)</small></label>
                            <input value="<?= (isset($_POST['value'])) ? set_value('value') : $task->value ?>"
                                   type="number" name="value" id="value" placeholder="Enter the price" required>
                            <?php if (!empty($errors['value'])) : ?>
                                <div class="text-error"><small><?= $errors['value'] ?></small></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-input">
                            <label>Deadline <small>(If any)</small></label>
                            <input value="<?= (isset($_POST['deadline'])) ? set_value('deadline') : $task->deadline ?>"
                                   type="date" id="deadline" name="deadline">
                            <?php if (!empty($errors['deadline'])) : ?>
                                <div class="text-error"><small><?= $errors['deadline'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input" style="display: flex;gap: 5px;">
                            <label for="isPdfRequiredProposal">Is document required to be submitted along with the
                                proposal?
                                (check if true) :</label>
                            <input style="width: fit-content;" type="checkbox" id="isPdfRequiredProposal"
                                   name="isPdfRequiredProposal" <?php if (isset($_POST['isPdfRequiredProposal'])) {
                                if ($_POST['isPdfRequiredProposal']) echo 'checked';
                            } else if ($task->isPdfRequiredProposal) {
                                echo 'checked';
                            } ?>>
                        </div>

                        <input type="hidden" name="newlyAddedSkills" id="newlyAddedSkills"/>
                        <input type="hidden" name="selectedSkills" id="selectedSkills"/>
                        <input type="hidden" name="deletedSkills" id="deletedSkills"/>

                        <div class="form-input">
                            <button>Modify</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <script>
        var selectedSkillsInput = document.getElementById("selectedSkills");
        var newlyAddedSkillsInput = document.getElementById("newlyAddedSkills");
        var deletedSkillsInput = document.getElementById("deletedSkills"); //these are not skill ids. these are task-skillID


        let newlyAddedSkills = [];
        let addedPredefinedSkills = [];
        let addedSkills = []; // Array to store added skills
        let deletedSkills = []; // Array to store removing skills. //these are not skill ids. these are student-skillID

        function checkOtherOption(selectElement) {
            const newSkillInput = document.getElementById('newSkill');
            newSkillInput.style.display = selectElement.value === 'other' ? 'block' : 'none';
        }

        function isSkillAdded(skillId) {
            return addedSkills.some(existingSkill => existingSkill.id === skillId);
        }

        function addSkill(e) {
            e.preventDefault();
            const select = document.getElementById('skillsSelect');
            const newSkillInput = document.getElementById('newSkill');
            const skillList = document.getElementById('skillList');

            const selectedOption = select.options[select.selectedIndex];
            const enteredSkill = newSkillInput.value.trim();

            let skillId = '';
            // console.log(selectedOption.value )
            if (selectedOption.value !== '' && selectedOption.value !== 'other') {//if its a predefined skill
                skillId = selectedOption.id; // Use the ID attribute of the selected option as the skill ID
                if (!isSkillAdded(skillId)) {
                    addedPredefinedSkills.push(skillId);
                }
            } else if (enteredSkill !== '') {
                skillId = generateSkillId(); // Generate a unique ID for the new skill
                newlyAddedSkills.push(enteredSkill)
            }

            const skillName = (selectedOption.value !== '' && selectedOption.value !== 'other') ? selectedOption.value : enteredSkill;

            if (skillId !== '' && skillName !== '' && !isSkillAdded(skillId)) {
                const skillObject = {id: skillId, name: skillName}; // Create an object with ID and skill name

                addedSkills.push(skillObject); // Add the skill object to the array of added skills

                const listItem = document.createElement('li');
                listItem.textContent = skillName;
                listItem.dataset.skillId = skillId; // Store the ID as a data attribute
                skillList.appendChild(listItem);

                // Clear inputs after adding skill
                select.selectedIndex = 0;
                newSkillInput.value = '';
                newSkillInput.style.display = 'none';

                //updating input values
                newlyAddedSkillsInput.value = JSON.stringify(newlyAddedSkills); //names of new skills
                selectedSkillsInput.value = JSON.stringify(addedPredefinedSkills); //ids of predefined skills
            } else {
                alert('Skill already added or empty!');
            }

            // console.log(addedPredefinedSkills)
            // console.log(newlyAddedSkills)
        }

        function generateSkillId() {
            // This function should generate a unique ID for each new skill
            // For simplicity, here's a basic example using a timestamp:
            return 'new_skill_' + Date.now(); // This generates an ID like 'new_skill_1641708497296'
        }


        //remove skills, adding event listners for each close btn
        $skilltags = document.querySelectorAll(".tag-close-btn");
        $skilltags.forEach((tag) => {
            tag.addEventListener('click', (e) => {
                tag = tag.parentNode;
                e.preventDefault();
                let DeletingID = tag.getAttribute('data-id');
                deletedSkills.push(DeletingID);
                deletedSkillsInput.value = JSON.stringify(deletedSkills);
                tag.style.display = 'none';
            })
        });


    </script>
<?php $this->view('company/company-footer', $data) ?>