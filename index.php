<?php
    $titulo = "GIOT Web";
    require_once('partial/up.php');
    require_once('partial/nav.php');
    ?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-principal">
    <h1 class="titulo-pagina">Pagina Principal</h1>
    <?php 
        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['id_perfil'] == 1){
                header('Location: admin.php');
            }elseif($_SESSION['usuario']['id_perfil'] == 2){
                header('Location: coach.php');
            }elseif($_SESSION['usuario']['id_perfil'] == 3){
                header('Location: sport.php');
            }
            // include('data/login.inc.php');
            //     echo '
            //     <p>Bienvenido '.$_SESSION['usuario'].' </p>
            // ';
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