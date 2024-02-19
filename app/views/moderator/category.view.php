<?php $this->view('moderator/moderator-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">

    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Title
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('title')">Title</li>
                <li onclick="sortByFilter('Task Count')">Task Count</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search..." type="search">
    </div>

    <a href="<?=ROOT?>/moderator/category/post">
        <div class="floating-button" style="top:70px;">
            <button type="button" class="buttonadd">
                <span class="button__text">Add New Category</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
            </button>
        </div>
    </a>
      <h1>Categories</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/moderator/category" class="breadcrumbs__link breadcrumbs__link--active">Category</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
<?php foreach($categories as $category):?>
<div class="mytask-tasks">
  <h2><?=ucfirst($category->title)?></h2>
  <h4>Description: <?=$category->description?></h4>
  <h4>Relevant Tags: <?=$category->tags?> </h4>
  <h4>No of active tasks: <span><?=$category->taskCount?> </span></h4>

<div class="flex justify-between">
  <a href="<?=ROOT?>/moderator/category/modify/<?=$category->categoryID?>">
    <button class="details-button margin-5">
      Modify
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>


    <button class="details-button margin-5 deletebttn"  data-id="<?=$category->categoryID?>">
      Delete
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>

  </div>
</div>
<?php endforeach;?>

</div>





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
        form.action = `<?=ROOT?>/moderator/category/delete/${id}`; // Use the current URL
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


<?php $this->view('moderator/moderator-footer',$data) ?>


<script type="text/javascript" src="<?= ROOT ?>/assets/js/searchNearBreadCrums.js"></script>
<!--js for sorting-->
<script>
    let AscValue=1;
    let AscDate=1;//for toggling sorting direction of date
    let AscTitle=1;//for toggling sorting direction of title
    function sortByFilter(feature){
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);

        let items = document.getElementsByClassName("mytask-tasks");

        // Convert NodeList to array
        let divsArray = Array.from(items);
        console.log(str);
        //for date sorting
        if(str==='task count'){
            //togle the asc desc for value
            if (AscValue === 0) AscValue = 1;
            else AscValue = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const valueA = a.querySelector('h4:nth-of-type(3) span').textContent.trim();
                const valueB = b.querySelector('h4:nth-of-type(3) span').textContent.trim();
                // console.log(valueA,valueB)
                // Convert values text to float for comparison
                const valA = parseFloat(valueA);
                const valB = parseFloat(valueB);

                // Compare the values
                if (AscValue) {
                    return valA - valB;
                } else {
                    return valB - valA;
                }
            });
        }else if(str==='title'){
            //togle the asc desc for value
            if (AscTitle === 0) AscTitle = 1;
            else AscTitle = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const textA = a.querySelector('h2').textContent.trim().toLowerCase();
                const textB = b.querySelector('h2').textContent.trim().toLowerCase();

                if (textA < textB) return (AscTitle === 0)?-1:1;
                if (textA > textB) return (AscTitle === 0)?1:-1;
                return 0;
            });
        }

        // Clear the container before appending sorted divs
        const container = document.querySelector('.mytasks-wrapper');
        container.innerHTML = '';

        // Append sorted divs back to the container
        divsArray.forEach(div => {
            container.appendChild(div);
        });
    }
</script>