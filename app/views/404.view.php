<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<div class="flex flex-column c-s-1 c-e-13 align-items-center">
<h1>Page not found.</h1>
<img src="<?=ROOT?>/assets/images/404_cat.png" style="max-height:573px; max-width:510px;" alt="404">
<a href="<?=ROOT?>"><h1>Go to Home</h1></a>

</div>


<?php $this->view("includes/footer",$data);