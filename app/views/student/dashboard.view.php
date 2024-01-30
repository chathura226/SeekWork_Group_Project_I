<?php $this->view('student/student-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/charts.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/playCard.styles.css"/>

<div class="pagetitle column-12">
      <h1>Dashboard</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link breadcrumbs__link--active">Dashboard</a>
          </li>
          
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="msg r-s-2 c-s-6 c-e-8">
<?php if(Auth::getstatus()==='verification pending'):?>
  <div class="alert alert-danger text-center" id="alert">Your account is not yet verified! Please proceed to verification!</div>
  <?php endif;?>

</div>


    <div class="c-s-1 c-e-13 row-5" >
        <canvas id="myChart" ></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('myChart');

        //getting data from backend
        fetch('<?=ROOT?>/charts/monthlyearnings')
            .then(response => {
                // Check if the request was successful (status code 2xx)
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                // console.log(response.text())

                // Parse the response as JSON
                return response.json();
            })
            .then(data => {
                console.log(data)
                new Chart(ctx, {
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

            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('Fetch error:', error);
            });




    </script>


    <!-- Custom JS -->
    <script src="<?=ROOT?>/assets/js/charts.js"></script>




<?php $this->view('student/student-footer',$data) ?>