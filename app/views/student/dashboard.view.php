<?php $this->view('student/student-header',$data) ?>

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


<div class="msg c-s-6 c-e-8">
<?php if(Auth::getstatus()==='verification pending'):?>
  <div class="alert alert-danger text-center" id="alert">Your account is not yet verified! Please proceed to verification!</div>
  <?php endif;?>


  <?php $this->view('student/student-footer',$data) ?>
</div>