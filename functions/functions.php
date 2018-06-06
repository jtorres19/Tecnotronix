<?php 
    function registro(){
        require_once('data/conexion.php');
        $errores = duplicado($con);

        if (!empty($errores)) {
            return $errores;
        }

        $nombre = strtoupper(limpiar($_POST['nombre']));
        $apellido = strtoupper(limpiar($_POST['apellido']));
        $usuario = limpiar($_POST['usuario']);
        $email = limpiar($_POST['email']);
        $clave = limpiar($_POST['clave']);
        $clave2 = limpiar($_POST['clave2']);
        $perfil  = 1;
       
        $hashedPwd = password_hash($clave, PASSWORD_DEFAULT);
        $dec = $con -> prepare("INSERT INTO usuarios (nombre, apellido, id_usuario, email, contraseña, id_perfil) VALUES (? ,?, ?, ?, ?, ?)");
        $dec -> bind_param("sssssi", $nombre, $apellido, $usuario, $email, $hashedPwd, $perfil);
        $dec -> execute();
        $resultado = $dec -> affected_rows;
        $dec -> free_result();
        $dec -> close();
        $con -> close();
        $errores[] = "Registro realizado con éxito";
        
        return $errores;
        $errores = [];
    }

    function duplicado($con){
        $errores = [];

        $usuario = limpiar($_POST['usuario']);
        $email = limpiar($_POST['email']);

        $dec = $con -> prepare("SELECT * FROM usuarios WHERE id_usuario = ? OR email = ? ");
        $dec -> bind_param("ss",$usuario,$email);
        $dec -> execute();
        $resultado = $dec -> get_result();
        $rows = mysqli_num_rows($resultado);
        $row = $resultado -> fetch_assoc();
        $dec -> free_result();
        $dec -> close();

        if ($rows > 0) {
            if ($_POST['usuario'] == $row['id_usuario']) {
                $errores[] = 'USUARIO se encuentra ocupado';
            }if ($_POST['email'] == $row['email']) {
                $errores[] = 'E-MAIL se encuentra ocupado';
            }
        }

        return $errores;
    }

    function login() {
        require_once('data/conexion.php');
        $errores = [];

        $usuario = limpiar($_POST['usuario']);
        $clave = limpiar($_POST['clave']);

        $dec = $con -> prepare("SELECT * FROM usuarios WHERE id_usuario = ? OR email = ? ");
        $dec -> bind_param("ss",$usuario,$usuario);
        $dec -> execute();
        $resultado = $dec -> get_result();
        $rows = mysqli_num_rows($resultado);
        $row = $resultado -> fetch_assoc();
        $dec -> free_result();
        $dec -> close();
        $con -> close();

        if($rows < 1){
            $errores[] = "Usuario no existe";
        }else{
            if($row){
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
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: index.php');
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 2){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: index.php');   
                        exit;
                    }elseif($_SESSION['usuario']['id_perfil'] == 3){
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['usuario'] = $row['id_usuario'];
                        $_SESSION['perfil'] = $row['id_perfil'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['start'] = time();
                        $_SESSION['expire'] = $_SESSION['start'] + (10);
                        header('Location: index.php');
                        exit;
                    }
                }
            }
        }

        return $errores;
        $errores = [];

    }

    function actualizar(){

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
            <div class="alert alert-info errores">
                <ul>';
                foreach($errores as $error){
                    $resultado .= '<li>' .htmlspecialchars($error) . '</li>';
                }
                $resultado .= '</ul>
            </div>
        <!-- contenedor de error -->';
        return $resultado;
    }  

    function ficha_csrf(){
        $ficha = bin2hex(random_bytes(32));
        
        return $_SESSION['ficha'] = $ficha;
    }

    function validar_ficha($ficha){
        if(isset($_SESSION['ficha']) && hash_equals($_SESSION['ficha'], $ficha)){
            unset($_SESSION['ficha']);
            return true;
        }
        return false;
    }

    function validar($campos){
        $errores = [];
        foreach($campos as $nombre => $mostrar){
            if(!isset($_POST[$nombre]) || $_POST[$nombre] == NULL){
                $errores[] = $mostrar . ' es un campo requerido.';    
            }else {
                $valido = campos();
                foreach ($valido as $campo => $opcion) {
                    if ($nombre == $campo) {
                        if (!preg_match($opcion['patron'], $_POST[$nombre])){
                            $errores[] = $opcion['error'];
                        }
                    }
                }
            }
        }
        return $errores;
    }

    function campo($nombre){
        echo $_POST[$nombre] ?? '';
    }

    function campos(){
        $validacion = [
            'nombre' => [
                'patron' => '/^[a-zA-ZñÑ\s]{2,20}+$/i',
                'error' => 'NOMBRE solo puede contener letras y espacios, de 2 a 20 caracteres'
            ],'apellido' => [
                'patron' => '/^[a-zA-ZñÑ\s]{2,20}+$/i',
                'error' => 'APELLIDO solo puede contener letras y espacios, de 2 a 20 caracteres'
            ],'usuario' => [
                'patron' => '/^[a-zA-ZñÑ][\w]{2,20}+$/i',
                'error' => 'USUARIO puede contener letras, números y guion bajos, de 2 a 20 caracteres'
            ],'email' => [
                'patron' => '/^[a-zñÑ]+[\w-\.]{2,}@([\w-]{2,}\.)+[\w-]{2,4}$/i',
                'error' => 'EMAIL debe tener un formato válido, con un maximo de 30 caracteres'
            ],'edad' => [
                'patron' => '/^\d{1,3}/i',
                'error' => 'EDAD solo pueden ser números mayores de 0 y menores de 100'
            ],'altura' => [
                'patron' => '/^[1-9]+$/i',
                'error' => 'ALTURA solo pueden ser números mayores de 0 y menores de 300'
            ],'peso' => [
                'patron' => '/^[1-9]+$/i',
                'error' => 'PESO solo pueden ser números mayores de 0 y menores de 300'
            ]
            //'clave' => [
            //     'patron' => '/(?=^[\w\!@#\$%\^&\*\?]{6,30}$)(?=(.*[A-Z]){1,})^.*/',
            //     'error' => 'Ingrese contraseña válida. Debe tener un mínimo de 6 caracteres, con al menos una mayúscula y un máximo de 30 caracteres'
            // ]

        ];

        return $validacion;

    }

    function comparadorClaves($clave, $clave2){
        $errores = [];
        if ($clave !== $clave2) {
            $errores[] = 'Las contraseñas no coinciden';
        }

        return $errores;
    }

    function numeros(){
        $validacion = [
        ];

        return $validacion;
    }

?>