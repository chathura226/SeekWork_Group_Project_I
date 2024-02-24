<?php $this->view('company/company-header',$data) ?>

<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>


<div class="pagetitle column-12">
    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Date
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('date')">Date</li>
                <li onclick="sortByFilter('value')">Value</li>
                <li onclick="sortByFilter('rating')">Rating</li>
            </ul>

        </label>

    </div>

      <h1>Proposals</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/tasks/<?=$task->taskID?>/view-proposals" class="breadcrumbs__link breadcrumbs__link--active">Proposals</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
<?php if(!empty($proposals)) : foreach($proposals as $proposal):?>
<div class="mytask-tasks">
  <h2>Propose Amount : <?php if(!empty($proposal->proposeAmount)) echo "Rs.<span>".$proposal->proposeAmount."</span>/="; else echo "Rs.<span>".$task->value."</span>/=" ?></h2>
    <h4>Submitted Date: <?=$proposal->submissionDate?></h4>
    <h4 data-rating="<?=$proposal->final_rating?>">Submitted Student's Rating: <?php $this->view('includes/stars', ['nStars'=>$proposal->final_rating,'nReviews'=>$proposal->nReviews]) ?></h4>


  <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>/proposal/<?=$proposal->proposalID?>">
    <button class="details-button">
      Details
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
</div>
<?php endforeach; else: ?>
  <h2>No proposals have submitted for this task</h2>
  <?php endif; ?>
</div>



<?php $this->view('company/company-footer',$data) ?>
<!--js for sorting-->
<script>
    let AscDate=0;//for toggling sorting direction of date
    let AscValue=0;//for toggling sorting direction of value
    let AscRating=0;
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
                const valueA = a.querySelector('h2 span').textContent.trim();
                const valueB = b.querySelector('h2 span').textContent.trim();

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
        }else if(str==='rating'){
            //togle the asc desc for value
            if (AscRating === 0) AscRating = 1;
            else AscRating = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const valueA = a.getElementsByTagName('h4')[1].getAttribute('data-rating').trim();
                const valueB = b.getElementsByTagName('h4')[1].getAttribute('data-rating').trim();

                // Convert values text to float for comparison
                const valA = parseFloat(valueA);
                const valB = parseFloat(valueB);
                console.log(valA,valB)

                // Compare the values
                if (AscValue) {
                    return valA - valB;
                } else {
                    return valB - valA;
                }
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