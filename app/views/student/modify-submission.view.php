<?php $this->view('student/student-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/rating.styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/tables.styles.css">
<link href="<?= ROOT ?>/assets/css/multipleUploads.styles.css" rel="stylesheet">



<div class="pagetitle column-12">
      <h1>Modify Submission</h1>
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
            <a href="<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>" class="breadcrumbs__link">View Details</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Modify Submission</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->



<div class="form-wrap column-12">

<div class="tab-form">
  <div class="myheader">
      <div class="active-login"><h2>Modify Submission</h2></div>
  </div>
  <div class="tab-body">
      <div class="active1">
          <h3>Uploaded Files</h3>
          <hr>
          <div class="task-description">
              <?php if(!empty($submission->documents)) {echo '
            <table class="table table-striped">
                <thead>
                <tr>
                    <th >#</th>
                    <th >File Name</th>
                    <th >Download Link</th>
                    <th >Delete</th>
                </tr>
                </thead>
                <tbody> ';
                  for($i=0;$i<sizeof($submission->documents);$i++):?>
                      <tr>
                          <th><?=$i+1?></th>
                          <td> <?=$submission->documents[$i]?></td>
                          <td><a href="<?=ROOT?>/download/tasks/<?=$task->taskID?>/submissions?file=<?=$submission->documents[$i]?>">Download</a></td>
                          <td><a href="#" onclick='deleteFile(<?='"'.$submission->documents[$i].'"'?>)'>Delete</a></td>
                      </tr>
                  <?php endfor; echo "</tbody></table>";}
              else echo "No files submitted!";?>
              </br>
          </div>
          <form method="post" enctype="multipart/form-data">
                </br>               
                <h3>Submission Details</h3>
                <hr>

              <div class="form-input">
                  <label>New Files</label>
                  <!--                  <input   class="" type="file" name="documents" id="documents" accept="image/*">    -->
                  <div class="file-upload-div" id="fileUploadDiv">
                      <label for="documents" class="file-upload-label">
                          <div class="file-upload-design">
                              <svg viewBox="0 0 640 512" height="1em">
                                  <path
                                          d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                                  ></path>
                              </svg>
                              <p id="pTag">Drag and Drop</p>
                              <p>or</p>
                              <span class="browse-button">Browse file</span>
                          </div>

                          <input id="documents" type="file" name="documents[]" multiple/>
                      </label>
                  </div>
                  <br>
                  <label>Selected Files: </label>
                  <div id="file-list"></div>
                  <?php if(!empty($errors['documents'])):?>
                      <div class="text-error"><small><?=$errors['documents']?></small></div>
                  <?php endif;?>
              </div>


              <div class="form-input">
                  <label>Any Notes</label>
                  <textarea rows="10" cols="45" id="note" name="note"
                            placeholder="Enter a description about the submission"><?=$submission->note?></textarea>
                  <br>
                  <?php if(!empty($errors['note'])):?>
                      <div class="text-error"><small><?=$errors['note']?></small></div>
                  <?php endif;?>
              </div>
                


              <div class="form-input">
                  <button>Modify the Submission</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>

<!-- importing js -->
<script type="text/javascript" src="<?= ROOT ?>/assets/js/dragAndDrop.js"></script>

<script>
    function deleteFile(fileName){
        // console.log("dede")
        const confirmDelete = confirm("Are you sure you want to delete "+fileName+" ?");

        if (confirmDelete) {
            const action = "deleteFile"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action,fileName);
        } else {
            alert("Deletion canceled!");
        }
    }

    function sendActionToCurrentURL(action,fileName) {
        // Create a form dynamically
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "<?=ROOT?>/student/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>/deleteFile"; // Use the current URL
        form.style.display = "none"; // Hide the form

        // Create an input element for the action parameter
        const actionInput = document.createElement("input");
        actionInput.type = "hidden";
        actionInput.name = "fileName";
        actionInput.value = fileName;

        // Append the input element to the form
        form.appendChild(actionInput);

        // Append the form to the document body
        document.body.appendChild(form);
// console.log("dede")
        // Submit the form
        form.submit();
    }

</script>

<?php $this->view('student/student-footer',$data) ?>
