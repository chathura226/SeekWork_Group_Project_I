<?php $this->view('student/student-header', $data) ?>
    <link href="<?= ROOT ?>/assets/css/updateprofile.styles.css" rel="stylesheet">

    <div class="pagetitle column-12">
        <h1>Update Profile</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/profile" class="breadcrumbs__link">Profile</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">Update Profile</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="form-wrap column-12 row-10">
        <div class="tab-form row-4" style="width: 1000px;max-width: 1000px;min-width: 400px;">
            <div class="myheader">
                <div class="active-login"><h2>Update Profile Details</h2></div>
            </div>
            <div class="tab-body">
                <div class="active1">
                    <form method="post" enctype="multipart/form-data">
                        </br>
                        <div class="form-input">
                            <label>University Email</label>
                            <input value="<?= Auth::getemail() ?>" class="" type="text" name="email" id="email"
                                   placeholder="Enter student email address" disabled>
                        </div>
                        <div class="form-input">
                            <label>University (Corresponding to the Email)</label>
                            <input value="UCSC" class="" type="text" name="uni" id="uni" disabled>
                        </div>
                        <div class="form-input">
                            <label>Contact Number</label>
                            <input value="<?= Auth::getcontactNo() ?>" class="" type="text" name="uni" id="uni"
                                   disabled>
                        </div>

                        <div class="form-input">
                            <label>First Name</label>
                            <input value="<?= (isset($_POST['firstName'])) ? set_value('firstName') : Auth::getfirstName() ?>"
                                   class="<?= !empty($errors['firstName']) ? 'error-border' : '' ?>" type="text"
                                   name="firstName" id="firstName" placeholder="Enter your first name">
                            <?php if (!empty($errors['firstName'])): ?>
                                <div class="text-error"><small><?= $errors['firstName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>Last Name</label>
                            <input value="<?= (isset($_POST['lastName'])) ? set_value('lastName') : Auth::getlastName() ?>"
                                   class="<?= !empty($errors['lastName']) ? 'error-border' : '' ?>" type="text"
                                   name="lastName" id="lastName" placeholder="Enter your last name">
                            <?php if (!empty($errors['lastName'])): ?>
                                <div class="text-error"><small><?= $errors['lastName'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>Address</label>
                            <input value="<?= (isset($_POST['address'])) ? set_value('address') : Auth::getaddress() ?>"
                                   class="<?= !empty($errors['address']) ? 'error-border' : '' ?>" type="text"
                                   name="address" id="address" placeholder="Enter your address">
                            <?php if (!empty($errors['address'])): ?>
                                <div class="text-error"><small><?= $errors['address'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">
                            <label>NIC number</label>
                            <input value="<?= Auth::getNIC() ?>"
                                   class="<?= !empty($errors['NIC']) ? 'error-border' : '' ?>" type="text" name="NIC"
                                   id="NIC" placeholder="Enter your NIC number" disabled>
                            <?php if (!empty($errors['NIC'])): ?>
                                <div class="text-error"><small><?= $errors['NIC'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-input">

                            <label>Description About Yourself</label>
                            <textarea value="" rows="5" cols="45" id="description" name="description"
                                      placeholder="Enter a description about you"><?= (isset($_POST['description'])) ? set_value('description') : Auth::getdescription() ?></textarea>
                            <br>
                            <!-- <input   class="" type="text" name="description" id="description" placeholder="Enter a description about you">               -->
                        </div>
                        <div class="form-input">
                            <label>Qualifications</label>
                            <input value="<?= (isset($_POST['qualifications'])) ? set_value('qualifications') : Auth::getqualifications() ?>"
                                   class="" type="text" name="qualifications" id="qualifications" placeholder="">
                        </div>
                        <div>Current Skills :</div>
                        <div class="skill-wrapper">
                            <?php if (!empty(Auth::getskills())): foreach (Auth::getskills() as $skill): ?>
                                <div style="margin: 5px !important;" class="skill"
                                     data-id="<?= $skill->studentSkillID ?>"><?= $skill->skill ?>
                                    <button class="tag-close-btn">&times;</button>
                                </div>
                            <?php endforeach; else: ?>
                                No Skills added!
                            <?php endif;?>
                        </div>
                        <div class="form-input">

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
                                    Added Skills:
                                    <ul id="skillList"></ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-input">
                            <label>Profile Picture</label>
                            <input onchange="load_image(this.files[0])" class="" type="file" name="imageInput"
                                   id="imageInput" accept="image/*">
                            <div class="image-container">
                                <img id="uploadedImage" <?php if (!empty(Auth::getprofilePic())) echo "src='" . ROOT . '/' . Auth::getprofilePic() . "'style='display: block;'"; ?>>
                            </div>
                            <?php if (!empty($errors['imageInput'])): ?>
                                <div class="text-error"><small><?= $errors['imageInput'] ?></small></div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="newlyAddedSkills" id="newlyAddedSkills"/>
                        <input type="hidden" name="selectedSkills" id="selectedSkills"/>
                        <input type="hidden" name="deletedSkills" id="deletedSkills"/>
                        <div class="form-input">
                            <button>Update</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
    <script src="<?= ROOT ?>/assets/js/main.js"></script>
    <script>
        var selectedSkillsInput = document.getElementById("selectedSkills");
        var newlyAddedSkillsInput = document.getElementById("newlyAddedSkills");
        var deletedSkillsInput = document.getElementById("deletedSkills"); //these are not skill ids. these are student-skillID


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
                tag=tag.parentNode;
                e.preventDefault();
                let DeletingID = tag.getAttribute('data-id');
                deletedSkills.push(DeletingID);
                deletedSkillsInput.value = JSON.stringify(deletedSkills);
                tag.style.display = 'none';
            })
        });


    </script>
<?php $this->view('student/student-footer', $data) ?>