<?php $this->view('company/company-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/tab-containers.styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/tables.styles.css">


<div class="pagetitle column-12">
      <h1>Pending Assignment Invitations</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>

          <li class="breadcrumbs__item">
            <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Pending Invites</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->
<label for="assignments" id="assignments" hidden><?=(!empty($assignments))?json_encode($assignments):json_encode('')?></label>

    <div class="tab-container c-s-1 c-e-13 " style="grid-row-end: span 1; height: fit-content">
        <div class="tab-radio-inputs">
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="all" checked="">
                <span class="name">All</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="pending">
                <span class="name">Pending</span>
            </label>
            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="accepted">
                <span class="name">Accepted</span>
            </label>

            <label class="tab-radio-btn">
                <input type="radio" name="radioForTab" value="declined">
                <span class="name">Declined</span>
            </label>

        </div>
        <div class="content-box">
            <div class="content-box-content" id="all">
                <h2>All invitations</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>InviteID</th>
                        <th>Task Title</th>
                        <th>Invited Date</th>
                        <th>Status</th>
                        <th>Reply Date</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr style="height: 70px">
                            <th>2</th>
                            <td><?=limitCharacters($$assignments->title,13)?></td>
                            <td>
                                csdc
                            </td>
                            <td>jnhuuhmu</td>
                            <td> nhvnhvnv</td>

                            <td>mhgmg</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="content-box-content" id="accepted">
                <h2>About</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad culpa, earum est illo ipsam
                    ipsum, quidem quis saepe, tempore tenetur veritatis. Debitis illo neque nisi numquam possimus sapiente
                    totam.
                </p>
            </div>
            <div class="content-box-content" id="declined">
                <h2>Blogs</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad culpa, earum est illo ipsam
                    ipsum, quidem quis saepe, tempore tenetur veritatis. Debitis illo neque nisi numquam possimus sapiente
                    totam.
                </p>
            </div>
            <div class="content-box-content" id="pending">
                <h2>Contact us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad culpa, earum est illo ipsam
                    ipsum, quidem quis saepe, tempore tenetur veritatis. Debitis illo neque nisi numquam possimus sapiente
                    totam.
                </p>
            </div>
        </div>
    </div>

<script>
    // Get all radio buttons by their name
    const radioButtons = document.getElementsByName("radioForTab");

    const contentBoxes=document.querySelectorAll(".content-box-content")

    //default one
    contentBoxes[0].style.display='block'

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
                contentBoxes.forEach((box)=>{box.style.display='none'})
                var x=document.getElementById(selectedValue).style.display ='block';
            }
        }
    }

</script>
<?php $this->view('company/company-footer',$data) ?>