<?php
  # Arquivo de cabeçario do layout
  include_once "head.php";
?>

  <div class="container">
    <div class="row">
      <?php
        # Conteúdo exportado da view referenciada
        echo $this->content();
      ?>
    </div><!-- end row -->
  </div><!-- end container-->

<?php
  # Arquivo de rodapé do layout
  include_once "footer.php";
?>
