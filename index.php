<?php
    session_start();
    // require_once('functions/functions.php');
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $errores = registro();
    // }
    $titulo = "GIOT WEB | Home";
    require_once('partial/up.php');
    require_once('partial/nav.php');
    require_once('data/conexion.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-principal">
    <h2>Info de giot</h2>
</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>