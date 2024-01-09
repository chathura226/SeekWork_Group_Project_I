<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tasks.styles.css">
    <!-- <link rel="stylesheet" href="--><?php //= ROOT ?><!--/assets/css/search.styles.css">-->
    <link href="<?= ROOT ?>/assets/css/tab-task-containers.styles.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/pagination.styles.css" rel="stylesheet">


<?php if (!empty($errors['email'])) : ?>
    <div class="alert alert-danger text-center" id="alert"><?= $errors['email'] ?></div>
<?php endif; ?>


    <div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content; margin-top: 20px;">
        <div class="tab-radio-inputs">
            <label class="tab-radio-btn">
                <input id="all-tab-radio" type="radio" name="radioForTab" value="all">
                <span class="name">All</span>
            </label>
            <label class="tab-radio-btn">
                <input id="recommended-tab-radio" type="radio" name="radioForTab" value="recommended">
                <span class="name">Recommended Tasks</span>
            </label>

        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <div style="margin-left:20px "><h2>All Tasks</h2></div>

                <div class="task-wrapper column-12">


                    <?php foreach ($tasks as $task) : ?>


                        <div class="post-container" id="$task->taskID">
                            <img class="post-img" src="<?= ROOT ?>/assets/images/cover.jpg">
                            <div class="task-title-con">
                                <img class="post-title-profile-img"
                                     src="<?= ROOT ?><?= (!empty($task->profilePic)) ? "/" . $task->profilePic : "/assets/images/noImage.png" ?>"
                                     alt="Profile Picture">
                                <div class="disc-title">
                                    <h2><?= $task->title ?></h2>
                                    <div class="comp">
                                        <div class="compName-task">
                                            <h4><?= $task->companyName ?></h4>
                                        </div>
                                        <div class="ratingNew">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                                <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.6 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="task-con-description">
                                <?= $task->description ?>
                            </div>
                            <div class="post-val">
                                <div class="task-price-val">
                                    <h2>Rs.<?= $task->value ?>/=</h2>
                                </div>
                                <a style="text-decoration: none;" href="<?= ROOT ?>/tasks/<?= $task->taskID ?>">
                                    <button class="apply-btn">
                                        Apply
                                    </button>
                                </a>

                            </div>
                        </div>

                    <?php endforeach; ?>


                </div>

                <?php if ($tab == "all") {
                    $pageNumNew = $pageNum;
                } else {
                    $pageNumNew = 1;
                } ?>
                <div id="all-pagination" class="pagination-wrapper">
                    <div class="pagination">
                        <!--if page number is greater than 5-->
                        <?php if ($pageNumNew > 5): ?>

                            <a class="prev page-numbers" href="?tab=all&page=<?= ($pageNumNew - 1) ?>">prev</a>
                            <?php for ($i = -4; $i <= 5; $i++): ?>
                                <a class="page-numbers <?= ($i == 0) ? 'current' : '' ?>" <?= ($i == 0) ? 'aria-current="page"' : '' ?>
                                   href="?tab=all&page=<?= ($pageNumNew + $i) ?>"><?= ($pageNumNew + $i) ?></a>
                            <?php endfor; ?>
                            <a class="next page-numbers" href="?tab=all&page=<?= ($pageNumNew + 1) ?>">next</a>

                        <?php else: ?>

                            <!-- if page number is less than  or equal 5-->
                            <?php if ($pageNumNew != 1): ?><a class="prev page-numbers"
                                                              href="?tab=all&page=<?= ($pageNumNew - 1) ?>">
                                    prev</a><?php endif; ?>
                            <?php for ($i = 1 - $pageNumNew; $i <= 10 - $pageNumNew; $i++): ?>
                                <a class="page-numbers <?= ($i == 0) ? 'current' : '' ?>" <?= ($i == 0) ? 'aria-current="page"' : '' ?>
                                   href="?tab=all&page=<?= ($pageNumNew + $i) ?>"><?= ($pageNumNew + $i) ?></a>
                            <?php endfor; ?>
                            <a class="next page-numbers" href="?tab=all&page=<?= ($pageNumNew + 1) ?>">next</a>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-box">
            <div class="content-box-content" id="recommended">
                <div style="margin-left:20px "><h2>Recommended Tasks</h2></div>


                <?php if (!Auth::logged_in()): ?>
                    <!-- not logged in-->
                    <h3 style="color: red;margin-left: 20px;">You have to be logged in to see recommended tasks!</h3>
                <?php elseif (!Auth::is_student()): ?>
                    <!-- not a student-->
                    <h3 style="color: red;margin-left: 20px;">You have to be a student to see recommended tasks!</h3>
                <?php elseif (empty($recommendedTasks)): ?>
                    <!-- not recommende tasks-->
                    <h3 style="color: red;margin-left: 20px;">No recommended tasks! Add more skills to see tasks</h3>
                <?php else: ?>
                    <!-- recommende tasks-->
                    <div class="task-wrapper column-12">

                    </div>
                <?php endif; ?>





                <?php if ($tab == "recommended") {
                    $pageNumNew = $pageNum;
                } else {
                    $pageNumNew = 1;
                } ?>
                <div id="recommended-pagination" class="pagination-wrapper">
                    <div class="pagination">
                        <!--if page number is greater than 5-->
                        <?php if ($pageNumNew > 5): ?>

                            <a class="prev page-numbers" href="?tab=recommended&page=<?= ($pageNumNew - 1) ?>">prev</a>
                            <?php for ($i = -4; $i <= 5; $i++): ?>
                                <a class="page-numbers <?= ($i == 0) ? 'current' : '' ?>" <?= ($i == 0) ? 'aria-current="page"' : '' ?>
                                   href="?tab=recommended&page=<?= ($pageNumNew + $i) ?>"><?= ($pageNumNew + $i) ?></a>
                            <?php endfor; ?>
                            <a class="next page-numbers" href="?tab=recommended&page=<?= ($pageNumNew + 1) ?>">next</a>

                        <?php else: ?>

                            <!-- if page number is less than  or equal 5-->
                            <?php if ($pageNumNew != 1): ?><a class="prev page-numbers"
                                                              href="?tab=recommended&page=<?= ($pageNumNew - 1) ?>">
                                    prev</a><?php endif; ?>
                            <?php for ($i = 1 - $pageNumNew; $i <= 10 - $pageNumNew; $i++): ?>
                                <a class="page-numbers <?= ($i == 0) ? 'current' : '' ?>" <?= ($i == 0) ? 'aria-current="page"' : '' ?>
                                   href="?tab=recommended&page=<?= ($pageNumNew + $i) ?>"><?= ($pageNumNew + $i) ?></a>
                            <?php endfor; ?>
                            <a class="next page-numbers" href="?tab=recommended&page=<?= ($pageNumNew + 1) ?>">next</a>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>


    </div>


    <!--    for search param search and check the active tab-->
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

                    //setting search param to the correct tab
                    setSearchParam('tab', radioButton.value);
                    //getting current page value
                    // var currPageWrapper=document.getElementById(radioButton.value+"-pagination");
                    var currentPage = document.querySelector('#' + radioButton.value + '-pagination .current').textContent;
                    // console.log(currentPage)
                    setSearchParam('page', currentPage);

                    // console.log(`Selected option: ${selectedValue}`);
                    contentBoxes.forEach((box) => {
                        box.style.display = 'none'
                    })
                    var x = document.getElementById(selectedValue).style.display = 'block';
                }
            }
        }


        var recommended_tab_radio = document.getElementById("recommended-tab-radio");
        var all_tab_radio = document.getElementById("all-tab-radio");

        // Function to get search parameters from URL
        function getSearchParams() {
            // Get the URL search parameters
            const urlSearchParams = new URLSearchParams(window.location.search);

            // Create an object to store the parameters
            const params = {};

            // Loop through the search parameters and store them in the object
            for (const [key, value] of urlSearchParams) {
                params[key] = value;
            }

            return params;
        }

        //get search params
        const searchParams = getSearchParams();

        // Check if a  parameter exists and its value
        if (searchParams.hasOwnProperty('tab')) {
            const paramValue = searchParams['tab'];
            console.log(paramValue)
            if (paramValue == 'all') {
                all_tab_radio.click();
            } else if (paramValue == "recommended") {
                console.log("sxdsxsdsdxs")
                recommended_tab_radio.click();
            }
        } else {
            all_tab_radio.click();
        }

        function setSearchParam(paramName, paramValue) {
            // Get the current URL
            let currentUrl = window.location.href;

            // Create a URLSearchParams object from the current URL
            let searchParams = new URLSearchParams(window.location.search);

            // Set or update the parameter
            searchParams.set(paramName, paramValue);

            // Replace the current query string with the updated one
            currentUrl = currentUrl.split('?')[0] + '?' + searchParams.toString();

            // Update the URL in the browser
            window.history.replaceState({}, '', currentUrl);
        }


    </script>


<?php $this->view("includes/footer", $data);
    