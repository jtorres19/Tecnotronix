<nav class="navbar navbar-inverse navbar-fixed-top navbar-dark navbar-expand-lg scrolling-navbar">
    <div class="container">
        <!-- Logo y boton de expandir y colapsar los enlaces -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#enlaces">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">GIOT</a>
        </div>
        <!-- Logo y boton de expandir y colapsar los enlaces -->

        <!-- Enlaces de navegacion   -->
        <div class="collapse navbar-collapse navbar-right" id="enlaces">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="#">Nosotros</a>
                </li>
                <li>
                    <a href="#">Galeria</a>
                </li>
                <li>
                    <a href="#">Contacto</a>
                </li>


                <?php                       
                    if(isset($_SESSION['usuario']) && $_SESSION['perfil'] == 3){
                        echo '
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    '.$_SESSION['usuario'].' <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile_sport.php">Mi Perfil</a></li>
                                    <li><a href="#">Mi Cuenta</a></li>    
                                    <li><a href="#">Mis Preferencias</a></li>    
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Cerrar Sesión</a></li>  
                                </ul>
                            </li>
                        ';
                    }elseif (isset($_SESSION['usuario']) && $_SESSION['perfil'] == 2) {
                        echo '
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    '.$_SESSION['usuario'].' <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Mi Perfil</a></li>
                                    <li><a href="#">Alumnos</a></li>    
                                    <li><a href="#">Clases</a></li>    
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Cerrar Sesión</a></li>  
                                </ul>
                            </li>
                        ';
                    }elseif (isset($_SESSION['usuario']) && $_SESSION['perfil'] == 1) {
                        echo '
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    '.$_SESSION['usuario'].' <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Cuentas</a></li>
                                    <li><a href="#">Perfiles</a></li>    
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Cerrar Sesión</a></li>  
                                </ul>
                            </li>
                        ';
                    }else{
                        echo '
                            <li><a href="login.php">Ingreso</a></li>
                            <li><a href="signup.php">Registro</a></li>
                        ';
                    }

                        // $now = time();
                        // if($now > $_SESSION['expire']) {
                        //     session_destroy();
                        //     echo '
                        //         <li><a href="login.php">Ingreso</a></li>
                        //         <li><a href="signup.php">Registro</a></li>
                        //     ';
                        //     exit;
                        // }
                ?>
            </ul>
        </div>
        <!-- Enlaces de navegacion   -->
    </div>
</nav>