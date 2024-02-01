<?php $this->view('student/student-header', $data) ?>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/charts.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/playCard.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/notificationPopup.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/popup.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/apply.styles.css"/>

    <div class="pagetitle column-12">
        <h1>Dashboard</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link breadcrumbs__link--active">Dashboard</a>
                </li>

            </ul>
        </nav>
    </div><!-- End Page Title -->


    <div class="msg r-s-2 c-s-6 c-e-8">
        <?php if (Auth::getstatus() === 'verification pending'): ?>
            <div class="alert alert-danger text-center" id="alert">Your account is not yet verified! Please proceed to
                verification!
            </div>
        <?php endif; ?>

    </div>
    <div id="goalPopup" class="popup">
        <div class="notificationCard">
            <p class="notificationHeading">Set the earning goal (per month)</p>
            <p class="notificationPara">Enter the desired goal : </p>
            <form method="post" onsubmit="setgoal(event)">
                <div class="form-input">
                    <input type="number" value="" name="goal" id="goal" required/>
                </div>


            </form>
            <div class="buttonContainer">
                <button class="AllowBtn" onclick="setgoal(event)">Set</button>
            </div>
        </div>
    </div>

    <div class="c-s-1 c-e-7 row-5">
        <h2>Earnings per month for last 12 months</h2><br>
        <canvas id="monthlyEarningChart"></canvas>
    </div>
    <div class="c-s-7 c-e-13 row-5">
        <h2>This month's earning goal</h2><br>
        Current Goal: Rs. <span id="currentGoalSpan"></span><br>
        Want to set the goal?
        <button style="margin-left: 5px;" class="pushable" onclick="showpopup(event)">
            <span class="shadow"></span>
            <span class="edge"></span>
            <span style="padding: 6px 11px;" class="front">
        Set Goal
      </span>
        </button>
        <canvas id="earningGoal"></canvas>
    </div>

    <div class="c-s-1 c-e-7 row-5">
        <h2>Task Progress</h2><br>
        <canvas id="progressChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <!--    // contains fetch req function-->
    <script src="<?= ROOT ?>/assets/js/charts.js"></script>
    <script>
        const goalPopup = document.getElementById("goalPopup");
        const monthlyEarningChart = document.getElementById('monthlyEarningChart');
        const earningGoal = document.getElementById('earningGoal');
        const progressChart = document.getElementById('progressChart');

        var mychart;//for earning goal

        lastearnings = data => {
            // console.log(data)
            new Chart(monthlyEarningChart, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.label,
                        data: data.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(0, 255, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(255, 0, 0, 0.2)',
                            'rgba(0, 255, 0, 0.2)',
                            'rgba(0, 0, 255, 0.2)',
                            'rgba(128, 0, 128, 0.2)' // Purple color added as an alternative
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 255, 0)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 255, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(128, 0, 128)' // Purple color added as an alternative
                        ],

                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
        myEarnings = data => {

            // console.log(data)
            document.getElementById("currentGoalSpan").textContent = data.currentGoal;
            mychart = new Chart(earningGoal, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.label,
                        data: data.data,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }

        progress = data => {
            if (data.isFine != 0) {
                // console.log(data)
                mychart = new Chart(progressChart, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: data.label,
                            data: data.data,
                            backgroundColor: [
                                'rgb(255, 205, 86)',
                                'rgb(54, 162, 235)'
                            ],
                            hoverOffset: 4
                        }]
                    },

                });
            } else {

                progressChart.parentElement.innerHTML="<h2>Task Progress</h2><h3>Oops! No data to show!</h3>"
            }

        }

        //getting last earning data
        monthlyEarnings = '<?=ROOT?>/charts/monthlyearnings';
        fetchChartData(monthlyEarnings, lastearnings);

        //getting earning goal
        earningGoalChartData = '<?=ROOT?>/charts/earninggoal';
        fetchChartData(earningGoalChartData, myEarnings);

        //getting task progress
        progressChartData = '<?=ROOT?>/charts/taskprogress';
        fetchChartData(progressChartData, progress);

        //setting goal
        function setgoal(e) {
            e.preventDefault();
            var goalText = document.getElementById("goal").value;
            let xml = new XMLHttpRequest();

            xml.onload = function () {
                if (xml.readyState == 4 || xml.status == 200) {
                    console.log(xml.responseText);
                    mychart.destroy();
                    fetchChartData(earningGoalChartData, myEarnings);
                    goalPopup.style.display = "none";

                }
            }

            let data = {};
            data.goal = goalText;
            data = JSON.stringify(data)
            xml.open("POST", "<?=ROOT?>/charts/setgoal", true);
            xml.send(data);


        }

        function showpopup(e) {
            e.preventDefault();
            goalPopup.style.display = "flex";
        }
    </script>


<?php $this->view('student/student-footer', $data) ?>