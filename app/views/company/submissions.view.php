<?php $this->view('company/company-header',$data) ?>



<link rel="stylesheet" href="<?=ROOT?>/assets/css/reviews.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>



<div class="pagetitle column-12">
    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Date
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('date')">Date</li>
                <li onclick="sortByFilter('status')">Status</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search by submission note" type="search">
    </div>
      <h1>Submissions</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks" class="breadcrumbs__link">Tasks</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>" class="breadcrumbs__link"><?=$task->title?></a>
          </li>
          <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Submissions</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="myreviews-wrapper column-12">
  <?php if(!empty($submissions)): $count=0;?>
  <?php foreach($submissions as $submission): $count++;?>
  <div class="myreview-review-bttns" data-Details="<?=$submission->note?>">
  <div class="myreview-review">
    <h2>Submission #<?=$count?></h2>
    <h4>Submission Date: <?=ucfirst($submission->createdAt)?></h4>
    <h4>Status: <span style="color:<?=($submission->status=='accepted')?'green':'red'?>"><?= ucfirst($submission->status) ?></span></h4>
    </div>
  <div class="flex justify-between">
    <a href="<?=ROOT?>/company/tasks/<?=$task->taskID?>/submissions/<?=$submission->submissionID?>">
      <button class="details-button margin-5">
        Details
        <div class="arrow-wrapper">
            <div class="arrow"></div>
        </div>
      </button>
    </a>

     

    </div>
    </div>

  <?php endforeach;?>
<?php else: echo "<h2> You have no submissions!</h2>"; endif;?>
</div>





<?php $this->view('company/company-footer',$data) ?>

<script>

    document.getElementById('search-bar').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let items = document.getElementsByClassName("myreview-review-bttns");

        for (let i = 0; i < items.length; i++) {
            let itemName = items[i].getAttribute('data-Details').toLowerCase();
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
    let AscDate=1;//for toggling sorting direction of date
    let AscTitle=1;//for toggling sorting direction of title
    function sortByFilter(feature){
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);

        let items = document.getElementsByClassName("myreview-review-bttns");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for date sorting
        if(str==='date') {
            console.log(AscDate);
            //togle the asc desc for date
            if (AscDate === 0) AscDate = 1;
            else AscDate = 0;
            //not available deadlines
            divsWithDeadlines=divsArray.filter((div)=>div.getElementsByTagName('h4')[0].textContent.trim()!=='Deadline: No deadline available!')
            nodeadline=divsArray.filter((div)=>div.getElementsByTagName('h4')[0].textContent.trim()==='Deadline: No deadline available!')
            // Sort the divs based on their date text
            divsWithDeadlines.sort((a, b) => {
                // Extract the date text from the divs
                const dateTextA = a.querySelector('.myreviews-wrapper h4').textContent.trim();
                const dateTextB = b.querySelector('.myreviews-wrapper h4').textContent.trim();
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

            // Clear the container before appending sorted divs
            const container = document.querySelector('.myreviews-wrapper');
            container.innerHTML = '';
            if(AscDate===1){
                // Append sorted divs back to the container
                divsWithDeadlines.forEach(div => {
                    container.appendChild(div);
                });
                nodeadline.forEach(div => {
                    container.appendChild(div);
                });
            }else{
                nodeadline.forEach(div => {
                    container.appendChild(div);
                });
                divsWithDeadlines.forEach(div => {
                    container.appendChild(div);
                });
            }
            return;

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
            const container = document.querySelector('.myreviews-wrapper');
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
        const container = document.querySelector('.myreviews-wrapper');
        container.innerHTML = '';

        // Append sorted divs back to the container
        divsArray.forEach(div => {
            container.appendChild(div);
        });
    }
</script>
