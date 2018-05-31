<?php 
    function registro(){
        require_once('data/conexion.php');
        $errores = [];

        $nombre = limpiar($_POST['nombre']);
        $apellido = limpiar($_POST['apellido']);
        $usuario = limpiar($_POST['usuario']);
        $email = limpiar($_POST['email']);
        $clave = limpiar($_POST['clave']);
        $clave2 = limpiar($_POST['clave2']);

        if($clave !== $clave2){
            $errores[] = "Claves no coinciden";
        }else{
            $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$email'";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);
            // $dec = $con -> prepare("SELECT * FROM usuarios WHERE id_usuario = ? OR email = ? ");
            // $dec -> bind_param("ss",$usuario,$email);
            // $dec -> execute();
            // $resultado = $dec -> affected_rows;
            // $dec -> free_result();
            // $dec -> close();
            // $con -> close();

            if($resultCheck > 0){
                $errores[] = "Usuario ya existe, por favor ingrese con otro o recupere su contraseña";
            }else{
                $hashedPwd = password_hash($clave, PASSWORD_DEFAULT);
                $sql = "INSERT INTO usuarios (id_usuario,email,nombre,apellido,contraseña,id_perfil) VALUES ('$usuario', '$email','$nombre', '$apellido', '$hashedPwd', 1)";
                mysqli_query($con, $sql);
                // $dec = $con -> prepare("INSERT INTO usuarios (nombre, apellido, id_usuario, email, contraseña, id_perfil) VALUES (? ,?, ?, ?, ?, 1)");
                // $dec -> bind_param("sssss", $nombre, $apellido, $usuario, $email, $hashedPwd);
                // $dec -> execute();
                // $resultado = $dec -> affected_rows;
                // $dec -> free_result();
                // $dec -> close();
                // $con -> close();
                $errores[] = "Registro realizado con éxito";
                //header('Location: index.php');

                // if($resultado == 1){
                //     $_SESSION['usuario'] = $usuario;
                //     header('Location: index.php');
                // }else{
                //     $errores[] = 'Registro no se pudo crear, intente de nuevo mas tarde';
                // }
            }
        }
        return $errores;
        $errores = [];
    }

    function login(){
        require_once('data/conexion.php');
        $errores = [];

        $usuario = limpiar($_POST['usuario']);
        $clave = limpiar($_POST['clave']);

        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$usuario'";
        $result = mysqli_query($con,$sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1){
            $errores[] = "Usuario no existe";
        }else{
            if($row = mysqli_fetch_assoc($result)){
                //de-hashing the password
                $hashedPwdCheck = password_verify($clave,$row['contraseña']);
                if($hashedPwdCheck == false){
                    $errores[] = "Contraseña inválida, intente de nuevo";
                }elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['usuario'] = $row;
                    if($_SESSION['usuario']['id_perfil'] == 1){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: admin.php');
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 2){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: coach.php');   
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 3){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: sport.php');
                        exit;
                    }
                    //$_SESSION['usuario'] = $row['usuario'];
                    /*$_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellido'] = $row['apellido'];
                    $_SESSION['email'] = $row['email'];*/
                }
            }
        }

        return $errores;
        $errores = [];

    }

    function limpiar($datos){
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        return $datos;
    }

    function mostrarError($errores){
        $resultado = '
        <!-- contenedor de error -->
            <div class="alert alert-info">
                <ul>';
                foreach($errores as $error){
                    $resultado .= '<li>' .htmlspecialchars($error) . '</li>';
                }
                $resultado .= '</ul>
            </div>
        <!-- contenedor de error -->';
        return $resultado;
    }  

?>