<?php $this->view('company/company-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/searchNearBreadCrums.styles.css" />


<div class="pagetitle column-12">

    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Title
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('title')">Title</li>
                <li onclick="sortByFilter('deadline')">Deadline</li>
                <li onclick="sortByFilter('status')">Status</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search..." type="search">
    </div>

  <h1>My Tasks</h1>
  <nav>

    <ul class="breadcrumbs">
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
      </li>
      <li class="breadcrumbs__item">
        <a href="" class="breadcrumbs__link breadcrumbs__link--active">Tasks</a>
      </li>
    </ul>
  </nav>
</div>
<div class="mytasks-wrapper column-12">
  <?php if (!empty($tasks)) : foreach ($tasks as $task) : ?>
      <div class="mytask-tasks height-150">
        <h2><?= ucfirst($task->title) ?></h2>
        <h4>Deadline: <?=($task->deadline)?$task->deadline:"No deadline"?></h4>
        <h4>Number of proposals: 45</h4>
        <h4>Status: <?=($task->status==='closed')?'<span style="color: red;">Closed</span>':'<span style="color: green;">'.ucfirst($task->status).'</span>'?></h4>
        <h4>Assignment status: <?= empty($task->assignmentID) ? '<span style="color: red;">Not Assigned</span>' : '<span style="color: green;">Assigned</span>' ?></h4>

        <a href="<?= ROOT ?>/company/tasks/<?= $task->taskID ?>">
          <button class="details-button">
            Details
            <div class="arrow-wrapper">
              <div class="arrow"></div>
            </div>
          </button>
        </a>
      </div>
    <?php endforeach;
  else : ?>
    <h2>No tasks posted!</h2>

  <?php endif; ?>
</div>
<?php $this->view('company/company-footer', $data) ?>

<script type="text/javascript" src="<?= ROOT ?>/assets/js/searchNearBreadCrums.js"></script>
<!--js for sorting-->
<script>
    let AscDate=1;//for toggling sorting direction of date
    let AscTitle=1;//for toggling sorting direction of title
    function sortByFilter(feature){
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);

        let items = document.getElementsByClassName("mytask-tasks");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for date sorting
        if(str==='deadline') {
            //togle the asc desc for date
            if (AscDate === 0) AscDate = 1;
            else AscDate = 0;
            //not available deadlines
            divsWithDeadlines=divsArray.filter((div)=>div.getElementsByTagName('h4')[0].textContent.trim()!=='Deadline: No deadline')
            nodeadline=divsArray.filter((div)=>div.getElementsByTagName('h4')[0].textContent.trim()==='Deadline: No deadline')
            // Sort the divs based on their date text
            divsWithDeadlines.sort((a, b) => {
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

            // Clear the container before appending sorted divs
            const container = document.querySelector('.mytasks-wrapper');
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

        }else if(str==='title'){
            //togle the asc desc for value
            if (AscTitle === 0) AscTitle = 1;
            else AscTitle = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the title text from the divs
                const textA = a.querySelector('h2').textContent.trim().toLowerCase();
                const textB = b.querySelector('h2').textContent.trim().toLowerCase();

                if (textA < textB) return (AscTitle === 0)?-1:1;
                if (textA > textB) return (AscTitle === 0)?1:-1;
                return 0;
            });
        }else{
// Group divs by status group
            const divsByCategory = {};
            divsArray.forEach(div => {
                const categoryTag = div.getElementsByTagName('h4');
                const category = categoryTag[2].textContent.trim().toLowerCase();
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
                // Sort the divs based on their title
                divsInCategory.sort((a, b) => {
                    // Extract the title text from the divs
                    const textA = a.querySelector('h2').textContent.trim().toLowerCase();
                    const textB = b.querySelector('h2').textContent.trim().toLowerCase();

                    if (textA < textB) return -1;
                    if (textA > textB) return 1;
                    return 0;
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