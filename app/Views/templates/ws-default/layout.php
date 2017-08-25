<?php
  # Arquivo de cabeçario do layout
  include_once "head.php";
?>

    <?php
        # Conteúdo exportado da view referenciada
        echo $this->content();
    ?>

<?php
  # Arquivo de rodapé do layout
  include_once "footer.php";
?>
