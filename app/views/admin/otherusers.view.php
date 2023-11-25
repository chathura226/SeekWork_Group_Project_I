<?php $this->view('admin/admin-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/otherusers.styles.css"/>

<div class="pagetitle column-12">
      <h1>Other Users</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Other Users</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->
<div class="user-wrapper column-12">
  <?php foreach($users as $user):?>

    <div class="card ">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?=ROOT?>/assets/images/profile1.png" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($user->firstName)?> <?=ucfirst($user->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($user->role)?> <small><?=($user->status==='active')?'&#x1F7E2;':'&#x1F534;'?></small></div>
      <div class="card__wrapper">
 
          <a href="<?=ROOT?>/<?=Auth::getrole()?>/profile/<?=$user->userID?>"> <button class="card__btn">Details</button></a>
          <?=($user->status==='active')?
          '<button data-id='.$user->userID.' class="card__btn card__btn-solid disableBtn" >Disable</button>'
          :'<button data-id='.$user->userID.' class="card__btn card__btn-solid enableBtn">Enable</button>'?>
      </div>
    </div>

    <?php endforeach;?>

    </div>

    <script >
    // Get all disble buttons
const disableBtns = document.querySelectorAll('.card__btn.card__btn-solid.disableBtn');
console.log(disableBtns)
const enableBtns = document.querySelectorAll('.card__btn.card__btn-solid.enableBtn');
console.log(enableBtns)

// Attach a click event listener to each button
disableBtns.forEach(button => {
    button.addEventListener('click', function(event) {
        // Get the data-id attribute value
        const itemId = event.currentTarget.getAttribute('data-id');
        const confirmDisable = confirm("Are you sure you want to disbale the user?");

        if (confirmDisable) {
            const action = "disable"; // Define the action here
            // Send the action to the current URL
            sendActionToCurrentURL(action,itemId);
        } else {
            alert("Canceled!");
        }
    });
});


enableBtns.forEach(button => {
    button.addEventListener('click', function(event) {
        // Get the data-id attribute value
        const itemId = event.currentTarget.getAttribute('data-id');
        const confirmEnable = confirm("Are you sure you want to enable the user?");

        if (confirmEnable) {
            const action = "enable"; // Define the action here
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
        form.action = `<?=ROOT?>/admin/otherusers/${action}/${id}`; 
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

<?php $this->view('admin/admin-footer',$data) ?>
