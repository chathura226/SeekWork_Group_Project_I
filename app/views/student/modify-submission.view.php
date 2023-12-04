<?php $this->view('student/student-header',$data) ?>

<link href="<?=ROOT?>/assets/css/post-task.styles.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/rating.styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?=ROOT?>/assets/css/tables.styles.css">



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
          <form method="post" enctype="">
                </br>               
                <h3>Submission Details</h3>
                <hr>  

                <div class="form-input">
                  <label>Documents</label>
                  <input   class="" type="file" name="documents" id="documents" accept="image/*">    
                  <div class="image-container">
                    <img id="uploadedImage" >
                    </div>          
                </div>


                <div class="form-input">
                  <label>Any Notes</label>
                  <textarea rows = "10" cols = "45" id="note" name = "note" placeholder="Enter a description about the submission"><?=$submission->note?></textarea>
                    <br>
                </div>
                


              <div class="form-input">
                  <button>Modify the Submission</button>
              </div>
          </form>
      </div>
      
  </div>
  
</div>

</div>
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
