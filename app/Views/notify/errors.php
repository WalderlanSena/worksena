<?php if(isset($this->errors)): ?>
<div class="alert alert-danger alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php foreach($this->errors as $menssage):?>
    <strong><span class="glyphicon glyphicon-warning-sign"></span>  <?php echo $menssage; ?></strong>
    <br/>
  <?php endforeach; ?>
</div>
<?php endif; ?>
