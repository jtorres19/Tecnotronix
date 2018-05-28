<?php 
    function registro(){
        require_once('data/conexion.php');
        $errores = [];

        $nombre = limpiar($_POST['nombre']);
        $apellido = limpiar($_POST['apellido']);
        $usuario = limpiar($_POST['usuario']);
        $email = limpiar($_POST['email']);
        $clave = limpiar($_POST['clave']);

        $dec = $con -> prepare("INSERT INTO usuarios (nombre,apellido,usuario,email,contraseña,id_perfil) VALUES (?,?,?,?,?,?)");
        $dec -> bind-param("sssssi",$nombre,$apellido,$usuario,$email,$contraseña,1);
        $dec -> execute();
        $resultado = $dec -> affected_rows;
        $dec -> free_result();
        $dec -> close();
        $con -> close();

        if($resultado == 1){
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
        }else{
            $errores[] = 'Registro no se pudo crear';
        }

        return $errores;
    }

    function limpiar($datos){
        $datos = trim($datos);  
        $datos = stripslashes($datos);  
        $datos = htmlspecialchars($datos);  
        return $datos;
    }

?>