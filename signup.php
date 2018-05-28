<?php
    $titulo = "GIOT Web | Registro";
    require_once('partial/up.php');
    require_once('partial/nav.php');
?>
      
<!-- Contenedor principal -->
<div class="container" id="pagina-registro">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <h1 class="titulo-pagina">Registro</h1>

            <hr>
            
            <!-- Formulario de registro -->
            <form action="data/signup.inc.php" method="POST">
                <h2>Registrate <small>para acceder a los beneficios de GIOT</small></h2>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input title="Nombre requerido" type="text" class="form-control input-lg" name="nombre" placeholder="Nombre" tabindex="1" autofocus required/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <input title="Debe ingresar Apellido" type="text" class="form-control input-lg" name="apellido" placeholder="Apellido" tabindex="2" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input title="Debe ingresar un usuario" type="text" class="form-control input-lg" name="usuario" placeholder="Nombre de usuario" tabindex="3" required/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-at"></i></span>
                        <input title="mail@example.com" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" class="form-control input-lg" name="email" placeholder="E-mail" tabindex="4" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control input-lg" name="clave" placeholder="Contraseña" tabindex="5" required="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control input-lg" name="clave2" placeholder="Confirmar contraseña" tabindex="6" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label class="btn btn-primary btn-lg btn-block">
                            <input type="checkbox" name="terminos" tabindex="7">
                            Acepto
                        </label>
                    </div>
                    <div class="col-sm-9">
                        Al registrarme acepto los terminos y condiciones para que mis datos sean utilizados por GIOT
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="btnRegistro" tabindex="8">Registrar</button>

                    </div>
                    <div class="col-sm-6">
                        <a href="index.php" class="btn btn-danger btn-lg btn-block" tabindex="9">Cancelar</a>
                    </div>
                </div>

            </form>
            <!-- Formulario de registro -->
        </div>
    </div>
    

</div>
<!-- Contenedor principal -->

<?php
    require_once('partial/footer.php');
    require_once('partial/down.php');
?>