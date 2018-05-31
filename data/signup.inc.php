<?php

// if(isset($_POST['btnRegistro'])){
    
//     include 'conexion.php';
    
//     $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
//     $nombre = strtoupper($nombre);
//     $apellido = mysqli_real_escape_string($con, $_POST['apellido']);
//     $apellido = strtoupper($apellido);
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
//     $clave = mysqli_real_escape_string($con, $_POST['clave']);
//     $clave2 = mysqli_real_escape_string($con, $_POST['clave2']); 

//     //Error handlers
//     if($clave !== $clave2){
        
//         header("location: ../signup.php?signup=clavesnocoinciden");
//         exit();

//     }else{
//         $sql = "SELECT * FROM usuarios WHERE id_usuario = '$usuario' OR email = '$email'";
//         $result = mysqli_query($con, $sql);
//         $resultCheck = mysqli_num_rows($result);

//         if($resultCheck > 0){
//             header("Location: ../signup.php?signup=usertaken");
//             exit();
//         }else {
//             //Hashing the password
//             $hashedPwd = password_hash($clave, PASSWORD_DEFAULT);
//             //Insert the user into the database
//             $sql = "INSERT INTO usuarios (id_usuario,email,nombre,apellido,contraseña,id_perfil) VALUES ('$usuario', '$email','$nombre', '$apellido', '$hashedPwd',  '1')";
//             mysqli_query($con, $sql);
//             header("Location: ../signup.php?signup=success");
//             exit();
//         }
//     }

// } else {
//     header("Location: ../signup.php");
//     exit();
// }

// mysqli_close($con);

?>