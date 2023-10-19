<?php $this->view('company/company-header',$data) ?>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/companyMyTasks.styles.css"/>

<div class="pagetitle column-12">
      <h1>Chats</h1>
      <nav>

        <ul class="breadcrumbs">
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/chats" class="breadcrumbs__link breadcrumbs__link--active">Chats</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="mytasks-wrapper column-12">
<div class="mytask-tasks">
  <h2>Chathura Lakshan</h2>
  <h4>Task: Logo Design for the company</h4>

  <a href="<?=ROOT?>/company/chats/PLACEHOLDER_FOR_ID">
    <button class="details-button">
      Go to chat
      <div class="arrow-wrapper">
          <div class="arrow"></div>
      </div>
    </button>
  </a>
</div>


</div>
<?php $this->view('company/company-footer',$data) ?>
