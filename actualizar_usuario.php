<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
   
    $errores = array();

    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }
    else{
        $nombre_validado = false;
        $errores['nombre'] = "el nombre no es valido";
    }

    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
    }
    else{
        $apellidos_validado = false;
        $errores['apellidos'] = "los apellidos no son validos";
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }
    else{
        $email_validado = false;
        $errores['email'] = "el email no es valido";
    }

    if (count($errores) == 0) {

        // comprobar si el email ya exite
        $sql = "select id, email from usuarios where email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_usr = mysqli_fetch_assoc($isset_email);

        if($isset_usr['id'] == usuario['id'] || empty($isset_usr)){
            $usuario = $_SESSION['usuario'];
            $sql = "update usuarios set nombre = '$nombre', apellidos = '$apellidos', email = '$email' where id = ".$usuario['id'];
            $guardar = mysqli_query($db, $sql);

            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se han guardado con exito";
            }
            else{
                $_SESSION['errores']['general'] = "fallo al guardar el usuario";
            }
        }
        else{
            $_SESSION['errores']['general'] = "el usario ya existe";
        }
    }
    else{
        $_SESSION['errores'] = $errores;
    }
}
header('Location: mis_datos.php'); 

