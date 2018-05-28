<?php
    $titulo = "Bienvenido Personal Trainner";
    require_once('partial/up.php');
    require_once('partial/nav.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-plantilla">
    <h1 class="titulo-pagina"><?php echo $titulo ?? "GIOT Web"?></h1>
</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>