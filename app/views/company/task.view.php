<?php $this->view('company/company-header', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/eachtask.styles.css">

<div class="pagetitle column-12">
    <h1><?= $task->title ?></h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/company/tasks" class="breadcrumbs__link">Tasks</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active"><?= $task->title ?></a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="task-details-wrapper column-12">

    <div class="task-details column-7">
        <h2>Task Details</h2>
        <div class="task-description">
            <?= $task->description ?>
            <h4>Relavant Tags : </h4>
            <div class="tags-wrapper">

                <div class="tags">Logo</div>
                <div class="tags">Graphic</div>
                <div class="tags">Photoshop</div>
                <div class="tags">Illustrator</div>
                <div class="tags">Desiging</div>
                <div class="tags">Arwork</div>

            </div>
        </div>
        <div class="about-task">
            <h2>About the task</h2>

            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 640 512">
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0l57.4-43c23.9-59.8 79.7-103.3 146.3-109.8l13.9-10.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176V384c0 35.3 28.7 64 64 64H360.2C335.1 417.6 320 378.5 320 336c0-5.6 .3-11.1 .8-16.6l-26.4 19.8zM640 336a144 144 0 1 0 -288 0 144 144 0 1 0 288 0zm-76.7-43.3c6.2 6.2 6.2 16.4 0 22.6l-72 72c-6.2 6.2-16.4 6.2-22.6 0l-40-40c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L480 353.4l60.7-60.7c6.2-6.2 16.4-6.2 22.6 0z" />
                </svg>
                No. of proposals : 30</br>
            </div>

            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                    <path d="M176 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h16V98.4C92.3 113.8 16 200 16 304c0 114.9 93.1 208 208 208s208-93.1 208-208c0-41.8-12.3-80.7-33.5-113.2l24.1-24.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L355.7 143c-28.1-23-62.2-38.8-99.7-44.6V64h16c17.7 0 32-14.3 32-32s-14.3-32-32-32H224 176zm72 192V320c0 13.3-10.7 24-24 24s-24-10.7-24-24V192c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
                </svg>
                Deadline : 06/12/2023</br>
            </div>
            <div class="about-task-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                    <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
                Task Type : Fixed Price</br>
            </div>


        </div>
    </div>
    <div class="price-button c-s-8 c-e-13">

        <h1>Rs.<?= $task->value ?>/=</h1>
        <a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>/view-proposals"><button class="apply">View Proposals</button></a>
        &nbsp &nbsp
        <a href="<?= ROOT ?>/company/modify/<?= $task->taskID ?>"><button class="apply">Modify Task</button></a>
        &nbsp &nbsp
        <a><button id="deleteButton" class="apply">Delete Task</button></a>
        &nbsp &nbsp
        <?php if (!empty($assignments)) : ?><a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>/pendingassignments"><button class="apply">Assignment Invites</button></a><?php endif; ?>
        &nbsp &nbsp
        <?php if (!empty($assignments)) : ?><a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>/submissions"><button class="apply">Submissions</button></a><?php endif; ?>

        <?php if ($task->status === 'closed') : ?>
            &nbsp &nbsp
            <a href="<?= ROOT ?>/company/review/post/<?= $task->taskID ?>"><button class="apply height-50 width-160">Add a Review</button></a>
            &nbsp &nbsp

        <?php endif; ?>
    </div>
    <div class="comp-details c-s-8 c-e-13">
        <h2>About the company</h2>
        <div class="comp-img">
            <img src="<?= ROOT ?><?= (!empty(Auth::getprofilePic())) ? "/" . Auth::getprofilePic() : "/assets/images/noImage.png" ?>" alt="Profile Picture">
        </div>
        <h3><?= ucfirst(Auth::getcompanyName()) ?> <small>(2000 tasks)</small></h3>
        <div class="rating">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
            </svg><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
            </svg><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
            </svg>
        </div>
        Company Description : <?= Auth::getdescription() ?></br>
        Location : <?= ucfirst(Auth::getaddress()) ?></br>
        <?php if (!empty(Auth::getwebsite())) echo "Website : " . Auth::getwebsite(); ?></br>
        Joined Date: <?= Auth::getcreatedAt() ?></br>

    </div>

</div>





<script>
    const deleteButton = document.getElementById("deleteButton");

    deleteButton.addEventListener("click", function() {
        const confirmDelete = confirm("Are you sure you want to delete?");

        if (confirmDelete) {
            const action = "delete"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action);
        } else {
            alert("Deletion canceled!");
        }
    });

    function sendActionToCurrentURL(action) {
        // Create a form dynamically
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "<?= ROOT ?>/company/delete/<?= $task->taskID ?>"; // Use the current URL
        form.style.display = "none"; // Hide the form

        // Create an input element for the action parameter
        const actionInput = document.createElement("input");
        actionInput.type = "hidden";
        actionInput.name = "action";
        actionInput.value = action;

        // Append the input element to the form
        form.appendChild(actionInput);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }
</script>

<?php $this->view('company/company-footer', $data) ?>