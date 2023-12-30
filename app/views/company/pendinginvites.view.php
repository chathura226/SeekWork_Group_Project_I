<?php $this->view('company/company-header',$data) ?>
<link href="<?=ROOT?>/assets/css/changepassword.styles.css" rel="stylesheet">
<link href="<?=ROOT?>/assets/css/passwordStrengthForChangePass.styles.css" rel="stylesheet">


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
<div id="assignmentCont">

</div>

<script>
    assignments=document.getElementById("assignments")
    assignmentsObj=JSON.parse(assignments.textContent)
    console.log(assignmentsObj)
    console.log("dsdw")
    assignmentCont=document.getElementById("assignmentCont")
    assignmentCont.textContent=assignmentsObj[0]['status']
</script>
<?php $this->view('company/company-footer',$data) ?>