<?php if(isset($this->info)): ?>
<div class="alert alert-info alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php foreach($this->info as $menssage):?>
    <strong><span class="glyphicon glyphicon-info-sign"></span>  <?php echo $menssage; ?></strong>
    <br/>
  <?php endforeach; ?>
</div>
<?php endif; ?>
