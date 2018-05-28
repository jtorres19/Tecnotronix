<?php

session_start();

if (isset($_POST['btnLogin'])){
    
    include 'conexion.php';

    $usuario = mysqli_real_escape_string($con,$_POST['usuario']);
    $clave = mysqli_real_escape_string($con,$_POST['clave']);

    if(empty($usuario) || empty($clave)){
        header("Location: ../login.php?login=empty");
        exit();
    }else{
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$usuario'";
        $result = mysqli_query($con,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
            header("Location: ../login.php?login=error");
            exit();
        }else{
            if($row = mysqli_fetch_assoc($result)){
                //de-hashing the password
                $hashedPwdCheck = password_verify($clave,$row['contraseña']);
                if($hashedPwdCheck == false){
                    header("Location: ../login.php?login=pwderror");
                    exit();
                }elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['usuario'] = $row;
                    //$_SESSION['usuario'] = $row['usuario'];
                    /*$_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellido'] = $row['apellido'];
                    $_SESSION['email'] = $row['email'];*/
                    header("Location: ../index.php");
                    exit();
                }
            }
        }
    }

}else{
    header("Location: ../login.php?login=error");
    exit();
}