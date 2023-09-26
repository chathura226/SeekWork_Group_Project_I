<?php $this->view('moderator/moderator-header',$data) ?>

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




  <?php $this->view('moderator/moderator-footer',$data) ?>
