<?php $this->view('student/student-header',$data) ?>


<link rel="stylesheet" href="<?=ROOT?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>


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
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Pending Invites</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="myreviews-wrapper column-12">
  <?php if(!empty($assignments)):?>
  <?php foreach($assignments as $assignment):?>
  <div class="myreview-review-bttns">
  <div class="myreview-review">
    <h2>For Task : <?=ucfirst($assignment->task->title)?></h2>
    <h4>Proposal Submitted Date: <?=ucfirst($assignment->proposal->submissionDate)?></h4>
    <h4>Proposal Value: <?=(!empty($assignment->proposal->proposeAmount))?ucfirst($assignment->proposal->proposeAmount):ucfirst($assignment->task->value)?></h4>
    <h4>Assignment Invitation Date: <?=ucfirst($assignment->createdAt)?></h4>
    <h4>By Company:  <?=ucfirst($assignment->company->companyName)?></h4>
    

    </div>
  <div class="bttn-wrapper-new">
  <a href="<?=ROOT?>/tasks/<?=$assignment->task->taskID?>">
    <button class="details-button bigbttn">
      View the task
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
  <a href="<?=ROOT?>/student/proposals/<?=$assignment->proposal->proposalID?>">
    <button class="details-button bigbttn">
      View the Proposal
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
        <button class="details-button margin-5 accbtn deletebttn"  data-id="<?=$assignment->assignmentID?>">
        Accept
        <div class="arrow-wrapper">
            <div class="arrow"></div>
        </div>
      </button>
      <button class="details-button margin-5 decbtn red deletebttn"  data-id="<?=$assignment->assignmentID?>">
        Decline
        <div class="arrow-wrapper">
            <div class="arrow"></div>
        </div>
      </button>

    </div>
    </div>

  <?php endforeach;?>
<?php endif;?>
</div>




<script >
    // Get all accept buttons
const accbttns = document.querySelectorAll('.details-button.margin-5.accbtn.deletebttn');

// Attach a click event listener to each button
accbttns.forEach(button => {
    button.addEventListener('click', function(event) {
        // Get the data-id attribute value
        const itemId = event.currentTarget.getAttribute('data-id');
        const confirmDelete = confirm("Are you sure you want to Accept the invitation?");

        if (confirmDelete) {
            const action = "accept"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action,itemId);
        } else {
            alert("Canceled!");
        }
    });
});


    // Get all decline buttons
    const decbtns = document.querySelectorAll('.details-button.margin-5.decbtn.red.deletebttn');

// Attach a click event listener to each button
decbtns.forEach(button => {
    button.addEventListener('click', function(event) {
        // Get the data-id attribute value
        const itemId = event.currentTarget.getAttribute('data-id');
        const confirmDelete = confirm("Are you sure you want to Decline the invitation?");

        if (confirmDelete) {
            const action = "decline"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action,itemId);
        } else {
            alert("Canceled!");
        }
    });
});



function sendActionToCurrentURL(action,id) {
        // Create a form dynamically
        const form = document.createElement("form");
        form.method = "POST";
        form.action = `<?=ROOT?>/student/pendinginvites/${action}/${id}`; // Use the current URL
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
        console.log(form.action);
        
    }
</script>


<?php $this->view('student/student-footer',$data) ?>
