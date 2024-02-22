<?php $this->view('admin/admin-header',$data) ?>

<link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">
<link href="<?= ROOT ?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
<link href="<?= ROOT ?>/assets/css/tab-containers.styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/tables.styles.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">


<div class="pagetitle column-12">
    <div class="searchAndFilter" style="position:absolute;right: 30px;top: 17px;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                TaskID
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('title')">Title</li>
                <li onclick="sortByFilter('company id')">CompanyID</li>
                <li onclick="sortByFilter('task ID')">TaskID</li>
            </ul>

        </label>

        <input class="input-search-new" id="search-bar" name="search-bar" placeholder="Search by title" type="search">
    </div>
    <h1>Tasks</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>

            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Tasks</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content">
    <div class="tab-radio-inputs">
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="all" checked="">
            <span class="name">All Tasks</span>
        </label>
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="active">
            <span class="name">Active Tasks</span>
        </label>

        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="inProgress">
            <span class="name">Tasks InProgress</span>
        </label>

        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="closed">
            <span class="name">Closed Tasks</span>
        </label>
        <label class="tab-radio-btn">
            <input type="radio" name="radioForTab" value="disabled">
            <span class="name">Disabled Tasks</span>
        </label>

    </div>
    <div class="content-box">
        <div class="content-box-content" id="all">
            <h2>All Tasks</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): ?>
                    <tr class="tableRow" style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,50) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($task->status) {
                            case 'active':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'inProgress':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            case 'closed':
                                $statusColor = 'orange';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($task->status) ?></div>
                        </td>
                        <td><?=$task->companyID?></td>
                        <td>
                            <div class="flex"
                                 style="margin: auto;justify-content: center;align-items: center;gap: 20px">

                                <a href="<?= ROOT ?>/admin/tasks/<?= $task->taskID ?>"
                                   style="text-decoration: none;">
                                    <button class="status-btn-working">Go to Task</button>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; else: ?>
                    <h3>No Tasks available!</h3>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
        <div class="content-box-content" id="active">
            <h2>Active Tasks</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): if($task->status=='active'): ?>
                    <tr class="tableRow" style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,50) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($task->status) {
                            case 'active':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'inProgress':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            case 'closed':
                                $statusColor = 'orange';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($task->status) ?></div>
                        </td>
                        <td><?=$task->companyID?></td>
                        <td>
                            <div class="flex"
                                 style="margin: auto;justify-content: center;align-items: center;gap: 20px">

                                <a href="<?= ROOT ?>/admin/tasks/<?= $task->taskID ?>"
                                   style="text-decoration: none;">
                                    <button class="status-btn-working">Go to Task</button>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endif; endforeach; else: ?>
                    <h3>No Tasks available!</h3>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
        <div class="content-box-content" id="inProgress">
            <h2>Tasks inProgress</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): if($task->status=='inProgress'): ?>
                    <tr class="tableRow" style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,50) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($task->status) {
                            case 'active':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'inProgress':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            case 'closed':
                                $statusColor = 'orange';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($task->status) ?></div>
                        </td>
                        <td><?=$task->companyID?></td>
                        <td>
                            <div class="flex"
                                 style="margin: auto;justify-content: center;align-items: center;gap: 20px">

                                <a href="<?= ROOT ?>/admin/tasks/<?= $task->taskID ?>"
                                   style="text-decoration: none;">
                                    <button class="status-btn-working">Go to Task</button>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endif; endforeach; else: ?>
                    <h3>No Tasks available!</h3>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
        <div class="content-box-content" id="closed">
            <h2>Closed Tasks</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): if($task->status=='closed'): ?>
                    <tr class="tableRow" style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,50) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($task->status) {
                            case 'active':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'inProgress':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            case 'closed':
                                $statusColor = 'orange';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($task->status) ?></div>
                        </td>
                        <td><?=$task->companyID?></td>
                        <td>
                            <div class="flex"
                                 style="margin: auto;justify-content: center;align-items: center;gap: 20px">

                                <a href="<?= ROOT ?>/admin/tasks/<?= $task->taskID ?>"
                                   style="text-decoration: none;">
                                    <button class="status-btn-working">Go to Task</button>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endif; endforeach; else: ?>
                    <h3>No Tasks available!</h3>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
        <div class="content-box-content" id="disabled">
            <h2>Disabled Tasks</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>TaskID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>CompanyID</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($tasks)): foreach ($tasks as $task): if($task->status=='disabled'): ?>
                    <tr class="tableRow" style="height: 70px">
                        <th><?= $task->taskID ?></th>
                        <td><?= limitCharacters($task->title,50) ?></td>
                        <?php $statusColor = 'yellow';
                        switch ($task->status) {
                            case 'active':
                                $statusColor = 'green';
                                $textColor = 'whitesmoke';
                                break;
                            case 'inProgress':
                                $statusColor = 'yellow';
                                $textColor = 'var(--text-color)';
                                break;
                            case 'closed':
                                $statusColor = 'orange';
                                $textColor = 'var(--text-color)';
                                break;
                            default:
                                $statusColor = 'red';
                                $textColor = 'whitesmoke';
                                break;

                        }; ?>
                        <td>
                            <div class="status-btn-like"
                                 style="background-color: <?= $statusColor ?>;color: <?= $textColor ?>"> <?= ucfirst($task->status) ?></div>
                        </td>
                        <td><?=$task->companyID?></td>
                        <td>
                            <div class="flex"
                                 style="margin: auto;justify-content: center;align-items: center;gap: 20px">

                                <a href="<?= ROOT ?>/admin/tasks/<?= $task->taskID ?>"
                                   style="text-decoration: none;">
                                    <button class="status-btn-working">Go to Task</button>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endif; endforeach; else: ?>
                    <h3>No Tasks available!</h3>
                <?php endif; ?>

                </tbody>
            </table>
        </div>



    </div>
</div>

<script>
    // Get all radio buttons by their name
    const radioButtons = document.getElementsByName("radioForTab");

    const contentBoxes = document.querySelectorAll(".content-box-content")

    //default one
    contentBoxes[0].style.display = 'block'

    // Attach click event listener to each radio button
    for (const radioButton of radioButtons) {
        radioButton.addEventListener("click", radioButtonClicked);
    }

    // Function to handle radio button click event
    function radioButtonClicked() {
        // Loop through all radio buttons
        for (const radioButton of radioButtons) {
            // Check if the radio button is checked
            if (radioButton.checked) {
                // Get the value of the checked radio button
                const selectedValue = radioButton.value;
                // console.log(`Selected option: ${selectedValue}`);
                contentBoxes.forEach((box) => {
                    box.style.display = 'none'
                })
                var x = document.getElementById(selectedValue).style.display = 'block';
            }
        }
    }

</script>


<!--for popup-->

<script>

    var modal = document.getElementById('popup1');

    var link = document.getElementsByClassName('popouplink');
    var linkArray = [...link]
    var closeBtn = document.getElementsByClassName('close')[0];

    var verificationIDInput = document.getElementById('transactionID');
    linkArray.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action of the link
            modal.style.display = 'block';
            verificationIDInput.value = item.getAttribute('data-id')
            dataObj = item.getAttribute('data-Details')
            dataObj=JSON.parse(dataObj)
            document.getElementById('bankName').value=dataObj.bankName;
            document.getElementById('branch').value=dataObj.branch;
            document.getElementById('accNo').value=dataObj.accNo;
            // console.log(item.getAttribute('data-id'))
        });
    })


    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

<?php $this->view('admin/admin-footer',$data) ?>

<!--search and sort-->
<script>
    let allTask=document.querySelector('.content-box-content#all');
    let activeTask=document.querySelector('.content-box-content#active');
    let inProgressTask=document.querySelector('.content-box-content#inProgress');
    let closedTask=document.querySelector('.content-box-content#closed');

    tabArray=[allTask,activeTask,inProgressTask,closedTask];

    document.getElementById('search-bar').addEventListener('input', function () {
        let filter = this.value.toLowerCase();

        console.log(tabArray)
        tabArray.forEach((tab)=>{
            //below code must run for each tab
            let items = tab.getElementsByClassName('tableRow');

            for (let i = 0; i < items.length; i++) {
                let itemName = items[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                if (itemName.indexOf(filter) > -1) {
                    items[i].style.display = 'table-row';
                } else {
                    items[i].style.display = 'none';
                }
            }
        })

    });



    //sorting.....................
    let AscTaskID=1;//for toggling sorting direction of date
    let AscTitle=1;//for toggling sorting direction of title
    let AscCompID=1;
    function sortByFilter(feature){
        let str = feature.toLowerCase();
        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);
        if(str==='title') {
            //togle the asc desc for value
            if (AscTitle === 0) AscTitle = 1;
            else AscTitle = 0;
        }else if(str==='task id') {
            //togle the asc desc for value
            if (AscTaskID === 0) AscTaskID = 1;
            else AscTaskID = 0;
        }else{
            if (AscCompID === 0) AscCompID = 1;
            else AscCompID = 0;
        }
        tabArray.forEach((tab)=>{

            let items = tab.getElementsByClassName('tableRow');


            // Convert NodeList to array
            let divsArray = Array.from(items);

            //for date sorting
            if(str==='title'){

                // Sort the divs based on their date text
                divsArray.sort((a, b) => {
                    // Extract the title text from the divs
                    const textA = a.getElementsByTagName('td')[0].textContent.trim().toLowerCase();
                    const textB = b.getElementsByTagName('td')[0].textContent.trim().toLowerCase();

                    if (textA < textB) return (AscTitle === 0)?-1:1;
                    if (textA > textB) return (AscTitle === 0)?1:-1;
                    return 0;
                });
            }else if(str==='task id'){
                // Sort the divs based on their date text
                divsArray.sort((a, b) => {
                    // Extract the title text from the divs
                    const textA = a.getElementsByTagName('th')[0].textContent.trim().toLowerCase();
                    const textB = b.getElementsByTagName('th')[0].textContent.trim().toLowerCase();
                    valueA=parseInt(textA)
                    valueB=parseInt(textB)
                    console.log(valueA,valueB)

                    if (valueA < valueB) return (AscTaskID === 0)?-1:1;
                    if (valueA > valueB) return (AscTaskID === 0)?1:-1;
                    return 0;
                });
            }else if(str==='company id'){
                // Sort the divs based on their date text
                divsArray.sort((a, b) => {
                    // Extract the title text from the divs
                    const textA = a.getElementsByTagName('td')[2].textContent.trim().toLowerCase();
                    const textB = b.getElementsByTagName('td')[2].textContent.trim().toLowerCase();
                    valueA=parseInt(textA)
                    valueB=parseInt(textB)
                    console.log(valueA,valueB)

                    if (valueA < valueB) return (AscCompID === 0)?-1:1;
                    if (valueA > valueB) return (AscCompID === 0)?1:-1;
                    return 0;
                });
            }

            // Clear the container before appending sorted divs
            const container = tab.getElementsByTagName('tbody')[0];
            container.innerHTML = '';
// console.log(container)
            // Append sorted divs back to the container
            divsArray.forEach(div => {
                container.appendChild(div);
            });
        });

    }
</script>