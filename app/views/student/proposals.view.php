<?php $this->view('student/student-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/searchNearBreadCrums.styles.css" />


<div class="pagetitle column-12" style="position: relative">
    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 100px;">
                Date
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('date')">Date</li>
                <li onclick="sortByFilter('status')">Status</li>
                <li onclick="sortByFilter('value')">Value</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search..." type="search">
    </div>
<!--  <div class="search-group c-s-2 c-e-13 r-s-1 r-e-2">-->
<!--    <svg class="icon-search" aria-hidden="true" viewBox="0 0 24 24" style="padding: 0 !important;">-->
<!--      <g>-->
<!--        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>-->
<!--      </g>-->
<!--    </svg>-->
<!--    <input placeholder="Search" type="search" class="input-search" id="search-bar">-->
<!--  </div>-->


  <h1>Proposals</h1>
  <nav>

    <ul class="breadcrumbs">
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>/student/proposals" class="breadcrumbs__link breadcrumbs__link--active">Proposals</a>
      </li>
    </ul>
  </nav>



</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
  <?php foreach ($proposals as $proposal) : ?>
    <div class="mytask-tasks">
      <h2><?= ucfirst($proposal->task->title) ?></h2>
      <h4 id="proposalDate">Submitted Date: <?= $proposal->submissionDate ?></h4>
      <?php if (empty($proposal->proposeAmount)) echo "<h4>Proposal Value: Rs.<span class='proVal'>" . $proposal->task->value . "</span> </h4>"; ?>
      <?php if (!empty($proposal->proposeAmount)) echo "<h4>Proposal Value: Rs.<span class='proVal'>" . $proposal->proposeAmount . "</span> </h4>"; ?>
      <h4>Task Type: <?= $proposal->task->taskType ?> </h4>
        <div style="    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 200px;">
        <h4 >Task Status: <span style="color: <?=($proposal->task->status=='active')?'green':(($proposal->task->status=='closed')?'red':'#d7601b')?>"><?= ucfirst($proposal->task->status) ?></span></h4>

      <a href="<?= ROOT ?>/student/proposals/<?= $proposal->proposalID ?>">
        <button class="details-button">
          Details
          <div class="arrow-wrapper">
            <div class="arrow"></div>
          </div>
        </button>
      </a>
        </div>
    </div>
  <?php endforeach; ?>

</div>



<?php $this->view('student/student-footer', $data) ?>


<script type="text/javascript" src="<?= ROOT ?>/assets/js/searchNearBreadCrums.js"></script>
<script>
    let AscDate=0;//for toggling sorting direction of date
    let AscValue=0;//for toggling sorting direction of value
    function sortByFilter(feature){
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);

            let items = document.getElementsByClassName("mytask-tasks");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for date sorting
        if(str==='date') {
            //togle the asc desc for date
            if (AscDate === 0) AscDate = 1;
            else AscDate = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const dateTextA = a.getElementsByTagName('h4')[0].textContent.trim();
                const dateTextB = b.getElementsByTagName('h4')[0].textContent.trim();

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
        }else if(str==='value'){
            //togle the asc desc for value
            if (AscValue === 0) AscValue = 1;
            else AscValue = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const valueA = a.querySelector('h4 span').textContent.trim();
                const valueB = b.querySelector('h4 span').textContent.trim();

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
        }else{
// Group divs by status group
            const divsByCategory = {};
            divsArray.forEach(div => {
                const categoryTag = div.getElementsByTagName('h4');
                const category = categoryTag[categoryTag.length-1].textContent.trim().toLowerCase();
                if (!divsByCategory[category]) {
                    divsByCategory[category] = [];
                }
                divsByCategory[category].push(div);
            });

            // console.log(divsByCategory)
            // Clear the container before appending sorted divs
            const container = document.querySelector('.mytasks-wrapper');
            container.innerHTML = '';
// Sort and append divs for each status group
            Object.keys(divsByCategory).forEach(category => {
                const divsInCategory = divsByCategory[category];
                // Sort the divs based on their date text
                divsInCategory.sort((a, b) => {
                    const dateTextA = a.getElementsByTagName('h4')[0].textContent.trim();
                    const dateTextB = b.getElementsByTagName('h4')[0].textContent.trim();

                    const dateA = new Date(dateTextA);
                    const dateB = new Date(dateTextB);
                    return dateA - dateB;
                });
                divsInCategory.forEach(div => {
                    container.appendChild(div);
                });

            });
            return;
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