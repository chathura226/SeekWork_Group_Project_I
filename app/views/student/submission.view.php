<?php $this->view('student/student-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/eachtask.styles.css">


<div class="pagetitle column-12">
      <h1>Submission Details</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions" class="breadcrumbs__link">Submissions</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">View Details</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->

<div class="task-details-wrapper column-12">

    <div class="task-details column-7">
    <h2>Submission Description</h2>
    <div class="task-description">
        
        <?=$submission->note?>
        </br>

    </div>
    <h2>Files:</h2>
    <div class="task-description">
        
        <?php if(!empty($submission->documents)) echo $submission->documents; else echo "No files submitted!";?>
        </br>
    </div>
    <div class="about-task">
        <h2>About the Submission</h2>

        <div class="about-task-item">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                <path d="M176 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h16V98.4C92.3 113.8 16 200 16 304c0 114.9 93.1 208 208 208s208-93.1 208-208c0-41.8-12.3-80.7-33.5-113.2l24.1-24.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L355.7 143c-28.1-23-62.2-38.8-99.7-44.6V64h16c17.7 0 32-14.3 32-32s-14.3-32-32-32H224 176zm72 192V320c0 13.3-10.7 24-24 24s-24-10.7-24-24V192c0-13.3 10.7-24 24-24s24 10.7 24 24z"/>
            </svg>
            Submission Date : <?=$submission->createdAt?></br>
        </div>
        <div class="about-task-item">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/>
            </svg>
            Submission Status : <?php if($submission->status==='pendingReview') echo "Submission Review Pending </br>"; else echo ucfirst($submission->status)."</br>"; ?>
        </div>
        <div class="about-task-item">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
            Submission Reviewed Date : <?php if($submission->status==='pendingReview') echo "Submission Review Pending </br>"; else echo $submission->reviewedDate."</br>"; ?>
        </div>
        
    </div>
    </div>
    <div class="price-button c-s-8 c-e-13">


                        <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>/modify"><button  class="apply" <?=($submission->status==='pendingReview')? '':'disabled'?>> Modify Submission</button></a>
                        &nbsp &nbsp
                        <a ><button id="deleteButton" class="apply" <?=($submission->status==='pendingReview')? '':'disabled'?> >Delete Submission</button></a>
                    </div>


</div>





<script >
    const deleteButton = document.getElementById("deleteButton");

    deleteButton.addEventListener("click", function () {
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
        form.action = "<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>/delete"; // Use the current URL
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

<?php $this->view('student/student-footer',$data) ?>
