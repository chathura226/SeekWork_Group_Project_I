<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<?php if(message()):?>
    <div class="alert alert-danger text-center"><?=message('',true)?></div>
<?php endif;?>

<?php $this->view("includes/footer",$data);