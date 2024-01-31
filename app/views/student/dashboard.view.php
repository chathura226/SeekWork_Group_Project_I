<?php $this->view('student/student-header', $data) ?>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/charts.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/playCard.styles.css"/>

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


    <div class="c-s-1 c-e-7 row-5">
        <canvas id="monthlyEarningChart"></canvas>
    </div>
    <div class="c-s-7 c-e-13 row-5">
        <canvas id="earningGoal"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <!--    // contains fetch req function-->
    <script src="<?= ROOT ?>/assets/js/charts.js"></script>
    <script>

        const monthlyEarningChart = document.getElementById('monthlyEarningChart');
        const earningGoal = document.getElementById('earningGoal');


        lastearnings = data => {
            // console.log(data)
            new Chart(monthlyEarningChart, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.label,
                        data: data.data,
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
            new Chart(earningGoal, {
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

        //getting last earning data
        monthlyEarnings = '<?=ROOT?>/charts/monthlyearnings';
        fetchChartData(monthlyEarnings, lastearnings);

        //getting earning goal
        earningGoalChartData = '<?=ROOT?>/charts/earninggoal';
        fetchChartData(earningGoalChartData, myEarnings);

    </script>


<?php $this->view('student/student-footer', $data) ?>