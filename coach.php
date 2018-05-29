<?php
    $titulo = "Bienvenido Personal Trainner";
    require_once('partial/up.php');
    require_once('partial/nav.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-principal">
    <h1 class="titulo-pagina">Bienvenido Personal Trainner</h1>
    <?php 
        
        if(isset($_SESSION['usuario'])){
            session_start();
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