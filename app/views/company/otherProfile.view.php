<?php $this->view('company/company-header', $data) ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/floating-button.styles.css"/>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css">
<link href="<?= ROOT ?>/assets/css/changepassword.styles.css" rel="stylesheet">

<div class="pagetitle column-12">
    <h1>View - Student</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="" class="breadcrumbs__link">View - Student </a>
            </li>
            <li class="breadcrumbs__item">
                <a href=""
                   class="breadcrumbs__link breadcrumbs__link--active"><?= ucfirst($user->firstName) . " " . ucfirst($user->lastName) ?></a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->

<!--stylefor reviews-->
<style>
    <
    style >
    .cards-review {
        margin-top: 2.5rem;
    }

    .cards-review .card-review {
        width: 100%;
        margin-bottom: .7rem;
        background: rgb(243, 240, 240);
        border-radius: 5px;
    }

    .card-review > * {
        padding: 1rem 1.2rem;
    }

    .card-review-top {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .img {
        width: 50px;
        height: 50px;
        background: purple;
        border-radius: 50%;
        outline: none;

    }
    .img img {
        width: 50px;
        height: 50px;
        border-radius: 50%;


    }

    .cls-name .one {
        background: orange;
    }

    .cls-name,
    .cls-name .img {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cls-name .img {
        justify-content: center;
    }


    .card-review-content {
        margin: 0;
        padding-top: 0;
    }

    .card-review-content p {
        /*font-size: .8rem;*/
        color: rgb(95, 95, 101);
    }

    .card-review-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-review-action span {
        font-size: .8rem;
        color: RGB(101, 101, 114);
    }

    .card-review-action .btn {
        padding: .3rem .7rem;
        background: transparent;
        border: 1px solid #000;
        border-radius: 2px;
        color: #8C8C9F;
        cursor: pointer;
        transition: .2s ease-in-out;
    }
</style>


<div class="card c-s-1 row-4">
    <div class="card__img"><img src="<?= ROOT ?>/assets/images/logo.png" alt="Profile Picture"></div>
    <div class="card__avatar"><img
                src="<?= ROOT ?><?= (!empty($user->profilePic)) ? "/" . $user->profilePic : "/assets/images/noImage.png" ?>"
                alt="Profile Picture"></div>
    <div class="card__title"><?= ucfirst($user->firstName) ?> <?= ucfirst($user->lastName) ?> </div>
    <div class="card__subtitle"><?= ucfirst($user->role) ?> </div>

</div>

<div class="profile-details c-s-2 c-e-13 row-6">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512">
            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2 style="margin-left: 5px;">Profile Details</h2>
    </div>
    <?= ucfirst($user->role) ?> ID :
    <hr>
    <div><?= $user->studentID ?></div>
    First Name:
    <hr>
    <div><?= ucfirst($user->firstName) ?></div>
    Last Name:
    <hr>
    <div><?= ucfirst($user->lastName) ?></div>
    University:
    <hr>
    <div><?= ucfirst($user->universityName) ?></div>
    Status:
    <hr>
    <div><?= ucfirst($user->status) ?></div>
    Student Description :
    <hr>
    <div><?= $user->description ?></div>
    Joined Date :
    <hr>
    <div><?= ucfirst($user->createdAt) ?></div>
    <div class="btn-container" style="margin: 0;padding: 0;">
        <div class="btn-effect" style="margin: 0;padding: 0;">
            <a style="font-size:15px;background-color:black;padding: 5px 0px;width:155px" class="effect"
               href="<?= ROOT ?>/<?= Auth::getrole() ?>/chats/<?= $user->userID ?>" title="Contact">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: white !important;" fill="white" height="1em"
                     viewBox="0 0 640 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/>
                </svg>
                Chat Now </a>
        </div>

    </div>
</div>
<div class="profile-details-reviews c-s-1 c-e-13 row-6" style="background-color: white;
  border-radius: 15px;
  color: var(--text-color);
  padding: 20px;
  display: flex;
  /* align-items: center; */
  flex-direction: column;
  box-shadow: 0px 2px 5px 2px rgba(0,0,0,0.1);
  height: fit-content;">
    <div style="display:flex; align-items: center">
        <svg xmlns="http://www.w3.org/2000/svg" style="fill: var(--primary-color-low);" height="3em"
             viewBox="0 0 512 512">
            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
        </svg>
        <h2 style="margin-left: 5px;">Rating & Reviews</h2>
    </div>
    <div style="display: flex;">
        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;flex: 1;">
            <h1 style="font-size: 5em;"><?= number_format($user->final_rating, 1) ?></h1>
            <?php $this->view('includes/stars', ['nStars' => $user->final_rating, 'nReviews' => $user->nReviews, 'size' => '3rem', 'fontsize' => '2rem']) ?>

        </div>
        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;flex:2;">
            <div style="display: grid;grid-template-columns: 1fr 1fr 4fr 1fr;width: 500px;align-items: center">
                <span style="margin-top: 6px;margin-right:5px;font-size: 1.2rem;text-align: right">5 </span>
                <svg xmlns="http://www.w3.org/2000/svg" style="fill:rgb(255, 123, 0) !important;"
                     fill="rgb(255, 123, 0)" height="1rem" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                </svg>
                <div class="rating-progress-loader">
                    <div class="rating-progress" style="width: <?= $percentages[4] ?>%;"></div>
                </div>
                <span style="margin-top: 4px;margin-right:5px;font-size: 1rem;"><?= $starCount[4] ?> </span>
            </div>
            <div style="display: grid;grid-template-columns: 1fr 1fr 4fr 1fr;width: 500px;align-items: center">
                <span style="margin-top: 6px;margin-right:5px;font-size: 1.2rem;text-align: right">4 </span>
                <svg xmlns="http://www.w3.org/2000/svg" style="fill:rgb(255, 123, 0) !important;"
                     fill="rgb(255, 123, 0)" height="1rem" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                </svg>
                <div class="rating-progress-loader">
                    <div class="rating-progress" style="width: <?= $percentages[3] ?>%;"></div>
                </div>
                <span style="margin-top: 4px;margin-right:5px;font-size: 1rem;"><?= $starCount[3] ?> </span>
            </div>
            <div style="display: grid;grid-template-columns: 1fr 1fr 4fr 1fr;width: 500px;align-items: center">
                <span style="margin-top: 6px;margin-right:5px;font-size: 1.2rem;text-align: right">3 </span>
                <svg xmlns="http://www.w3.org/2000/svg" style="fill:rgb(255, 123, 0) !important;"
                     fill="rgb(255, 123, 0)" height="1rem" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                </svg>
                <div class="rating-progress-loader">
                    <div class="rating-progress" style="width: <?= $percentages[2] ?>%;"></div>
                </div>
                <span style="margin-top: 4px;margin-right:5px;font-size: 1rem;"><?= $starCount[2] ?> </span>
            </div>

            <div style="display: grid;grid-template-columns: 1fr 1fr 4fr 1fr;width: 500px;align-items: center">
                <span style="margin-top: 6px;margin-right:5px;font-size: 1.2rem;text-align: right">2 </span>
                <svg xmlns="http://www.w3.org/2000/svg" style="fill:rgb(255, 123, 0) !important;"
                     fill="rgb(255, 123, 0)" height="1rem" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                </svg>
                <div class="rating-progress-loader">
                    <div class="rating-progress" style="width: <?= $percentages[1] ?>%;"></div>
                </div>
                <span style="margin-top: 4px;margin-right:5px;font-size: 1rem;"><?= $starCount[1] ?> </span>
            </div>
            <div style="display: grid;grid-template-columns: 1fr 1fr 4fr 1fr;width: 500px;align-items: center">
                <span style="margin-top: 6px;margin-right:5px;font-size: 1.2rem;text-align: right">1 </span>
                <svg xmlns="http://www.w3.org/2000/svg" style="fill:rgb(255, 123, 0) !important;"
                     fill="rgb(255, 123, 0)" height="1rem" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                </svg>
                <div class="rating-progress-loader">
                    <div class="rating-progress" style="width: <?= $percentages[0] ?>%;"></div>
                </div>
                <span style="margin-top: 4px;margin-right:5px;font-size: 1rem;"><?= $starCount[0] ?> </span>
            </div>
        </div>
    </div>

    <hr style="margin-top: 25px;margin-bottom: 25px;">
    <?php if (!empty($reviews)): ?>
    <div class="searchAndFilter" style="align-self:end;display: flex;flex-wrap: wrap;gap: 15px">

        <label class="dropdown">Sort By

            <div class="dd-button" id="sortByTitle" style="width: 120px;">
                Date
            </div>

            <input type="checkbox" class="dd-input" id="test">

            <ul class="dd-menu">
                <li onclick="sortByFilter('date')">Date</li>
                <li onclick="sortByFilter('No. Stars')">No. Stars</li>
            </ul>

        </label>

    </div>
<?php endif;?>
    <a href="#" class="popouplink"  style="margin-top: 10px;align-self:end;text-decoration: none !important;">
        <div class="floating-button-for-review" style="top:25px;">
            <button type="button" class="buttonadd">
                <span class="button__text">Add New Review</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
            </button>
        </div>
    </a>
    <div style="display:flex;flex-direction: column; width: 100%">
        <h2 style="margin-left: 5px;">Reviews</h2>
        <div class="reviewContainerDiv" style="display: flex;flex-direction: column;">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="cards-review">
                        <div class="card-review">
                            <div class="card-review-top">
                                <div class="cls-name">
                                    <div class="img one" alt=""><img src="<?=ROOT.'/'.$review->profilePic?>"></div>
                                    <p><a class="linkForStudent" style="text-decoration: none" href="<?=ROOT?>/<?=Auth::getrole()?>/viewcompany/<?=$review->companyID?>"><?= $review->companyName ?></a></p>
                                </div>
                                <div class="rate" data-id="<?=$review->nStars?>">
                                    <?php $this->view('includes/stars', ['nStars' => $review->nStars]) ?>

                                </div>
                            </div>

                            <div class="card-review-content">
                                <h4><?= $review->reviewTitle ?></h4>
                                <p><?= $review->reviewDescription ?></p>
                            </div>

                            <div class="card-review-action">
                                <span><?= $review->reviewDate ?></span>

                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h3>No Reviews Yet!</h3>
            <?php endif; ?>
        </div>
    </div>

</div>

<div id="popup1" class="popup">
    <style>
        .form-input select{
            width: 100%;
            margin-top: 5px;
            font-size: 15px;
            padding: 8px;
        }
    </style>
    <div class="popup-content" style="background-color: transparent;border: none;">
        <div class="wrapper">
            <div class="form-wrap column-12 row-6">
                <div class="tab-form row-" style="padding-left: 9px;">
                    <div class="myheader">
                        <div class="active-login"><h2>New Review</h2></div>
                        <span class="close">&times;</span>
                    </div>
                    <div class="tab-body " style="height: 235px">
                        <div class="active1">
                            <form method="post">
                                </br>


                                <?php if(!empty($oldTasks)):?>
                                    <h3>Select the task that you want to make a review on</h3>
                                    <div class="form-input">
                                        <label>Task</label>
                                        <select id="taskID" name="taskID" required>
                                            <?php foreach ($oldTasks as $task):?>
                                            <option value="<?=$task->taskID?>"><?=$task->title?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="form-input">
                                        <button>Review</button>
                                    </div>
                                <?php else:?>
                                    <h2>You have no closed previous tasks with this student!</h2>
                                <?php endif;?>


                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->view('company/company-footer', $data) ?>

<!--js for sorting-->
<script>
    let AscDate=1;//for toggling sorting direction of date
    let AscStars=1;//for toggling sorting direction of nStars
    function sortByFilter(feature){
        let str = feature.toLowerCase();

        document.getElementById('sortByTitle').textContent=str.charAt(0).toUpperCase() + str.slice(1);

        let items = document.getElementsByClassName("cards-review");

        // Convert NodeList to array
        let divsArray = Array.from(items);

        //for date sorting
        if(str==='date') {
            //togle the asc desc for date
            if (AscDate === 0) AscDate = 1;
            else AscDate = 0;
            //not available deadlines
            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the date text from the divs
                const dateTextA = a.querySelector('.card-review-action span').textContent.trim();
                const dateTextB = b.querySelector('.card-review-action span').textContent.trim();
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


        }else if(str==='no. stars'){
            //togle the asc desc for value
            if (AscStars === 0) AscStars = 1;
            else AscStars = 0;

            // Sort the divs based on their date text
            divsArray.sort((a, b) => {
                // Extract the title text from the divs
                const textA = a.querySelector('.rate').getAttribute('data-id').trim().toLowerCase();
                const textB = b.querySelector('.rate').getAttribute('data-id').trim().toLowerCase();

                valueA=parseInt(textA);
                valueB=parseInt(textB);

                if (valueA < valueB) return (AscStars === 0)?-1:1;
                if (valueA > valueB) return (AscStars === 0)?1:-1;
            });
        }

        // Clear the container before appending sorted divs
        const container = document.getElementsByClassName('reviewContainerDiv')[0];
        container.innerHTML = '';

        // Append sorted divs back to the container
        divsArray.forEach(div => {
            container.appendChild(div);
        });
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

