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
    <h1 class="titulo-pagina">Bienvenido Deportista</h1>
    <?php
        // if(!empty($errores)){echo mostrarError($errores);} 
        if(isset($_SESSION['usuario'])){
            echo '
                <p>Bienvenido '.$_SESSION['usuario'].' </p>
            ';
        }else{
            echo '
                <p>Registrate o has login</p>
            ';
        }
    ?>
</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>