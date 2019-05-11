<?php

// ESTO ES UNA VALIDACION 


// primero recogemos lo que llega por el var dump
if(isset($_POST)){

    // conexion a la base de datos
    require_once 'includes/conexion.php';
    
    if(!isset($_SESSION))
        session_start();

    // RECOGEMOS LOS VALORES DEL FORMULARIO DE REGISTRO

    // if (isset($_POST['nombre']))
    //     $nombre = $_POST['nombre'];
    // else
    //     $nombre = false;
    
    // para simplificarnos la tarea usamos un operador ternario
    // $apellidos = $_POST['apellidos'];
    // si existe el apellidos entonces se le asigna a la variable
    // en otro caso la variable es false

    // para ingresar cualquier tipo de datos en los registros como ' -"' se utiliza mysqli_real_escape_string($base de datos, $argumentos)

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    // el trim es para guardar sin espacios
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    // var_dump($_POST);

    // ARRAY DE ERRORES
    $errores = array();

    // VALIDAMOS LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
    // !preg_match("/[0-9]/", $nombre) comprueba si no hay valores numericos en el nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }
    else{
        $nombre_validado = false;
        $errores['nombre'] = "el nombre no es valido";
    }

    // validacion de apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
    }
    else{
        $apellidos_validado = false;
        $errores['apellidos'] = "los apellidos no son validos";
    }

    // validacion de email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }
    else{
        $email_validado = false;
        $errores['email'] = "el email no es valido";
    }

    // validacion de constraseña
    if(!empty($password)){
        $password_validado = true;
    }
    else{
        $password_validado = false;
        $errores['password'] = "la contraseña esta vacia";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;

        //cifrar la contraseña el cost 4 cifra la constraseña 4 veces
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        // var_dump($password);
        // var_dump($password_segura);
        // // verificar el password
        // var_dump(password_verify($password, $password_segura));

        // die();

        // insertar usuario en la base de datos
        $sql = "INSERT INTO USUARIOS VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);

        // // revisamos los errores
        // var_dump(mysqli_error($db));

        // die();

        if ($guardar) {
            $_SESSION['completado'] = "el registro se a completado con exito";
        }
        else{
            $_SESSION['errores']['general'] = "fallo al guardar el usuario";
        }
    }
    else{
        // creamos una sesion 
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php'); 

