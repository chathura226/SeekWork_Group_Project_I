<?php $this->view('admin/admin-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/otherusers.styles.css"/>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">

    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Name
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('title')">Name</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search..." type="search">
    </div>

      <h1>Manage Moderators</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Manage Moderators</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->



<div class="user-wrapper column-12">
  <?php foreach($moderators as $moderator):?>

    <div class="card ">
      <div class="card__img"><img src="<?=ROOT?>/assets/images/logo.png" alt="Profile Picture"></div>
      <div class="card__avatar"><img src="<?= ROOT ?><?= (!empty($moderator->profilePic)) ? "/" . $moderator->profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture"></div>
      <div class="card__title"><?=ucfirst($moderator->firstName)?> <?=ucfirst($moderator->lastName)?> </div>
      <div class="card__subtitle"><?=ucfirst($moderator->role)?> <small><?=($moderator->status==='active')?'&#x1F7E2;':'&#x1F534;'?></small></div>
      <div class="card__wrapper">
          <a href="<?=ROOT?>/<?=Auth::getrole()?>/profile/<?=$moderator->userID?>"> <button class="card__btn">Details</button></a>
          <?=($moderator->status==='active')?
          '<button data-id='.$moderator->moderatorID.' class="card__btn card__btn-solid disableBtn">Disable</button>'
          :'<button data-id='.$moderator->moderatorID.' class="card__btn card__btn-solid enableBtn">Enable</button>'?>
      </div>
    </div>

    <?php endforeach;?>

    </div>
    

    



<a href="<?=ROOT?>/admin/managemoderators/post">
    <div class="floating-button" style="top: 145px;">
        <button type="button" class="buttonadd">
        <span class="button__text">Add New Moderator</span>
        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
        </button>
    </div>
</a>



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
        form.action = `<?=ROOT?>/admin/managemoderators/${action}/${id}`; // Use the current URL
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

<!--//script for search-->
<script>
    document.getElementById('search-bar').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let items = document.getElementsByClassName("card");

        for (let i = 0; i < items.length; i++) {
            let itemName = items[i].querySelectorAll('.card__title')[0].textContent.toLowerCase();
            console.log(itemName)
            if (itemName.indexOf(filter) > -1) {
                items[i].style.display = 'flex';
            } else {
                items[i].style.display = 'none';
            }
        }
    });
</script>



<!--js for sorting-->
<script>
    let AscTitle = 0;
    let AscDate = 0;//for toggling sorting direction of date
    let AscValue = 0;//for toggling sorting direction of value
    function sortByFilter(feature) {
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent = str.charAt(0).toUpperCase() + str.slice(1);

        let items = document.getElementsByClassName("card");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for name sorting
         if (str === 'title') {
            //togle the asc desc for value
            if (AscTitle === 0) AscTitle = 1;
            else AscTitle = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const textA = a.querySelectorAll('.card__title')[0].textContent.trim().toLowerCase();
                const textB = b.querySelectorAll('.card__title')[0].textContent.trim().toLowerCase();
                // console.log(textA,textB)
                if (textA < textB) return (AscTitle === 0) ? -1 : 1;
                if (textA > textB) return (AscTitle === 0) ? 1 : -1;
                return 0;
            });
        }

        // Clear the container before appending sorted divs
        const container = document.querySelector('.user-wrapper.column-12');
        container.innerHTML = '';

        // Append sorted divs back to the container
        divsArray.forEach(div => {
            container.appendChild(div);
        });
    }
</script>