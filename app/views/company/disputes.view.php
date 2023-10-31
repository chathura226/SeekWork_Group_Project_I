<?php $this->view('company/company-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">
      <h1>My Disputes</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/disputes" class="breadcrumbs__link breadcrumbs__link--active">Disputes</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="myreviews-wrapper column-12">
<?php if(!empty($disputes)):?>
<?php foreach($disputes as $dispute):?>
<div class="myreview-review-bttns">
<div class="myreview-review">
  <h2><?=ucfirst($dispute->subject)?></h2>
  <h4>Dispute Date: <?=ucfirst($dispute->createdAt)?></h4>
  <h4>For Task: <?=ucfirst($dispute->task->title)?></h4>
  
  </div>
<div class="flex justify-between">
  <a href="<?=ROOT?>/company/disputes/modify/<?=$dispute->disputeID?>">
    <button class="details-button margin-5">
      Modify
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>

    <button class="details-button margin-5 deletebttn"  data-id="<?=$dispute->disputeID?>">
      Delete
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>

  </div>
  </div>

<?php endforeach;?>
<?php else:?>
    <h2>No disputes!</h2>
<?php endif;?>
</div>

<a href="<?=ROOT?>/company/disputes/post">
    <div class="floating-button">
        <button type="button" class="buttonadd">
        <span class="button__text">New Dispute</span>
        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
        </button>
    </div>
</a>




<?php $this->view('company/company-footer',$data) ?>



<script >
    // Get all delete buttons
const deleteButtons = document.querySelectorAll('.details-button.margin-5.deletebttn');
console.log(deleteButtons)
// Attach a click event listener to each button
deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        // Get the data-id attribute value
        const itemId = event.currentTarget.getAttribute('data-id');
        const confirmDelete = confirm("Are you sure you want to delete?");

        if (confirmDelete) {
            const action = "delete"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action,itemId);
        } else {
            alert("Deletion canceled!");
        }
    });
});

function sendActionToCurrentURL(action,id) {
        // Create a form dynamically
        const form = document.createElement("form");
        form.method = "POST";
        form.action = `<?=ROOT?>/company/disputes/delete/${id}`; // Use the current URL
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

