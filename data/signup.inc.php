<?php

if(isset($_POST['btnRegistro'])){
    
    include 'conexion.php';
    
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $nombre = strtoupper($nombre);
    $apellido = mysqli_real_escape_string($con, $_POST['apellido']);
    $apellido = strtoupper($apellido);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $clave = mysqli_real_escape_string($con, $_POST['clave']);
    $clave2 = mysqli_real_escape_string($con, $_POST['clave2']); 

    //Error handlers
    //Check for empty fields
    if(empty($nombre) || 
        empty($apellido) || 
        empty($email) || 
        empty($usuario) || 
        empty($clave) ||
        empty($clave2)){

        header("Location: ../signup.php?signup=empty");
        exit();

    //Check if input characters are valid
    }elseif(!preg_match("/^[a-zA-Z]*$/", $nombre) || !preg_match("/^[a-zA-Z]*$/", $apellido)){

        header("Location: ../signup.php?signup=invalid");
        exit();

    //check if email is valid
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){

        header("Location: ../signup.php?signup=emailwrong");
        exit();

    }elseif($clave !== $clave2){
        
        header("location: ../signup.php?signup=clavesnocoinciden");
        exit();

    }else{
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            header("Location: ../signup.php?signup=usertaken");
            exit();
        }else {
            //Hashing the password
            $hashedPwd = password_hash($clave, PASSWORD_DEFAULT);
            //Insert the user into the database
            $sql = "INSERT INTO usuarios (id_usuario,email,nombre,apellido,contraseña,id_perfil) VALUES ('$usuario', '$email','$nombre', '$apellido', '$hashedPwd',  '1')";
            mysqli_query($con, $sql);
            header("Location: ../signup.php?signup=success");
            exit();
        }
    }

} else {
    header("Location: ../signup.php");
    exit();
}