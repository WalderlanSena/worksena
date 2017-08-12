<?php if(isset($this->success)): ?>
<div class="alert alert-success alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php foreach($this->success as $menssage):?>
    <strong><span class="glyphicon glyphicon-ok"></span> <?php echo $menssage; ?></strong>
  <?php endforeach; ?>
</div>
<?php endif; ?>
