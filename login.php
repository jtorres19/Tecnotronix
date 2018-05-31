<?php
    session_start();
    require_once('functions/functions.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errores = login();
    }
    $titulo = "GIOT Web | Login";
    require_once('partial/up.php');
    require_once('partial/nav.php');
    require_once('data/conexion.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-plantilla">

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <h1 class="titulo-pagina">Ingreso</h1>

            <hr>

            <!--Llamando a funcion para mostrar errores -->
            <?php 
                if(!empty($errores)){echo mostrarError($errores);}  
            ?>
            <!--Llamando a funcion para mostrar errores -->
            
            <!-- Formulario de login -->
            <form method="POST">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input title="Usuario requerido" pattern="[a-zA-ZñÑ0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-ZñÑ0-9-]+(?:\.[a-zA-ZñÑ0-9-]+)*${2,20}" type="text" class="form-control input-lg" name="usuario" placeholder="Nombre de usuario o E-mail" tabindex="1" autofocus required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span>
                            <input title="Contraseña requerida" type="password" class="form-control input-lg" name="clave" placeholder="Contraseña" tabindex="2" required>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="btnLogin" tabindex="3">Ingresar</button>

                    </div>
                    <div class="col-sm-6">
                        <a href="index.php" class="btn btn-danger btn-lg btn-block" tabindex="4">Cancelar</a>
                    </div>
                </div>

                <br>

                <div>
                    <a href="#">¿Olvidó su contraseña?</a>
                </div>
                
            </form>
            <!-- Formulario de login -->
        </div>
    </div>

</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>