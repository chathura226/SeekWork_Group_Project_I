<?php $this->view('admin/admin-header',$data) ?>

<div class="msg c-s-6 c-e-8">
<?php if(message()):?>
  <div class="alert alert-success text-center"><?=message('',true)?></div>
  <?php endif;?>

  <?php $this->view('admin/admin-footer',$data) ?>
</div>