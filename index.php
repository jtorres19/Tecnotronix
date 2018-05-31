<?php
    session_start();
    // require_once('functions/functions.php');
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $errores = registro();
    // }
    $titulo = "GIOT Web | Registro";
    require_once('partial/up.php');
    require_once('partial/nav.php');
    require_once('data/conexion.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-principal">
    <?php 
        if(isset($_SESSION['usuario'])){
            echo '
                <p>Bienvenido '.$_SESSION['usuario'].' </p>
            ';
        }else{
            echo '
                <p>Acá debe ir la info de Giot o cualquier otra cosa</p>
            ';
        }
    ?>
</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>