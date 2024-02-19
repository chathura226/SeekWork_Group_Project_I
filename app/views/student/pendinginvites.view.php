<?php $this->view('student/student-header', $data) ?>


<link rel="stylesheet" href="<?= ROOT ?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/floating-button.styles.css"/>


<div class="pagetitle column-12">
    <div class="searchAndFilter"
         style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 100px;">
                Title
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('date')">Invitation Date</li>
                <li onclick="sortByFilter('title')">Title</li>
                <li onclick="sortByFilter('value')">Value</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search..." type="search">
    </div>
    <h1>Pending Assignment Invitations</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link breadcrumbs__link--active">Pending Invites</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->


<div class="myreviews-wrapper column-12">
    <?php if (!empty($assignments)): ?>
        <?php foreach ($assignments as $assignment): ?>
            <div class="myreview-review-bttns">
                <div class="myreview-review">
                    <h2>For Task : <span> <?= ucfirst($assignment->task->title) ?></span></h2>
                    <h4>Proposal Submitted Date: <?= ucfirst($assignment->proposal->submissionDate) ?></h4>
                    <h4>Proposal
                        Value: Rs.
                        <span><?= (!empty($assignment->proposal->proposeAmount)) ? ucfirst($assignment->proposal->proposeAmount) : ucfirst($assignment->task->value) ?></span>
                    </h4>
                    <h4>Assignment Invitation Date: <?= ucfirst($assignment->createdAt) ?></h4>
                    <h4>By Company: <?= ucfirst($assignment->company->companyName) ?></h4>


                </div>
                <div class="bttn-wrapper-new">
                    <a href="<?= ROOT ?>/tasks/<?= $assignment->task->taskID ?>">
                        <button class="details-button bigbttn">
                            View the task
                            <div class="arrow-wrapper">
                                <div class="arrow"></div>
                            </div>
                        </button>
                    </a>
                    <a href="<?= ROOT ?>/student/proposals/<?= $assignment->proposal->proposalID ?>">
                        <button class="details-button bigbttn">
                            View the Proposal
                            <div class="arrow-wrapper">
                                <div class="arrow"></div>
                            </div>
                        </button>
                    </a>
                    <button class="details-button margin-5 accbtn deletebttn"
                            data-id="<?= $assignment->assignmentID ?>">
                        Accept
                        <div class="arrow-wrapper">
                            <div class="arrow"></div>
                        </div>
                    </button>
                    <button style="background-color: red" class="details-button margin-5 decbtn red deletebttn"
                            data-id="<?= $assignment->assignmentID ?>">
                        Decline
                        <div class="arrow-wrapper">
                            <div class="arrow" style="background-color: red"></div>
                        </div>
                    </button>

                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>


<script>
    // Get all accept buttons
    const accbttns = document.querySelectorAll('.details-button.margin-5.accbtn.deletebttn');

    // Attach a click event listener to each button
    accbttns.forEach(button => {
        button.addEventListener('click', function (event) {
            // Get the data-id attribute value
            const itemId = event.currentTarget.getAttribute('data-id');
            const confirmDelete = confirm("Are you sure you want to Accept the invitation?");

            if (confirmDelete) {
                const action = "accept"; // Define the action here
                // Send the action to the current URL
                sendActionToCurrentURL(action, itemId);
            } else {
                alert("Canceled!");
            }
        });
    });


    // Get all decline buttons
    const decbtns = document.querySelectorAll('.details-button.margin-5.decbtn.red.deletebttn');

    // Attach a click event listener to each button
    decbtns.forEach(button => {
        button.addEventListener('click', function (event) {
            // Get the data-id attribute value
            const itemId = event.currentTarget.getAttribute('data-id');
            const confirmDelete = confirm("Are you sure you want to Decline the invitation?");

            if (confirmDelete) {
                const action = "decline"; // Define the action here
                // Send the action to the current URL
                sendActionToCurrentURL(action, itemId);
            } else {
                alert("Canceled!");
            }
        });
    });


    function sendActionToCurrentURL(action, id) {
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


<?php $this->view('student/student-footer', $data) ?>

<!--//script for search-->
<script>
    document.getElementById('search-bar').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let items = document.getElementsByClassName("myreview-review-bttns");

        for (let i = 0; i < items.length; i++) {
            let itemName = items[i].querySelectorAll('.myreview-review h2 span')[0].textContent.toLowerCase();
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

        let items = document.getElementsByClassName("myreview-review-bttns");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for date sorting
        if (str === 'date') {
            //togle the asc desc for date
            if (AscDate === 0) AscDate = 1;
            else AscDate = 0;
//todo:change the js according to this above div structure

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const dateTextA = a.querySelectorAll('.myreview-review h4')[2].textContent.trim();
                const dateTextB = b.querySelectorAll('.myreview-review h4')[2].textContent.trim();
                // console.log(dateTextA)
                // Convert date text to Date objects for comparison
                const dateA = new Date(dateTextA);
                const dateB = new Date(dateTextB);

                // Compare the dates
                if (AscDate) {
                    return dateA - dateB;
                } else {
                    return dateB - dateA;
                }
            });
        } else if (str === 'value') {
            //togle the asc desc for value
            if (AscValue === 0) AscValue = 1;
            else AscValue = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const valueA = a.querySelector('.myreview-review h4:nth-of-type(2) span').textContent.trim();
                const valueB = b.querySelector('.myreview-review h4:nth-of-type(2) span').textContent.trim();
                console.log(valueA, valueB)
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
        } else if (str === 'title') {
            //togle the asc desc for value
            if (AscTitle === 0) AscTitle = 1;
            else AscTitle = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const textA = a.querySelectorAll('.myreview-review h2 span')[0].textContent.trim().toLowerCase();
                const textB = b.querySelectorAll('.myreview-review h2 span')[0].textContent.trim().toLowerCase();
                console.log(textA,textB)
                if (textA < textB) return (AscTitle === 0) ? -1 : 1;
                if (textA > textB) return (AscTitle === 0) ? 1 : -1;
                return 0;
            });
        }

        // Clear the container before appending sorted divs
        const container = document.querySelector('.myreviews-wrapper.column-12');
        container.innerHTML = '';

        // Append sorted divs back to the container
        divsArray.forEach(div => {
            container.appendChild(div);
        });
    }
</script>