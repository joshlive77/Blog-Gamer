<?php

    // iniciar la sesion y la conexion a la db
    require_once 'includes/conexion.php';

    // recoger los datos del formulario 
    if(isset($_POST)){

        // borrar error antiguo
        if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        // vaciamos el email del post y borramos los espacion en 
        // blanco por delante y por detras con el trim
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // consulta para comprobar las credenciales del usuario
        $sql = "SELECT * FROM USUARIOS WHERE email = '$email'";
        $login = mysqli_query($db, $sql);

        // num_rows numero de columnas
        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
            // var_dump($usuario);
            // die();
             // comprobar la contraseña / cifrar
            // $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            // var_dump($password_segura);
            // die();
            $verify = password_verify($password, $usuario['password']);

            if($verify){
                // utilizar una sesion para guardar los datos del usuario logueado
                $_SESSION['usuario']=$usuario;
                if(isset($_SESSION['error_login'])){
                    session_unset($_SESSION['error_login']);
                }
                
            }
            else{
                // si algo falla enviar una sesion con el fallo
                $_SESSION['error_login']="login incorrecto!!";
            }
        }
        else{
            // si algo falla enviar una sesion con el fallo
            $_SESSION['error_login']="login incorrecto!!";
        }

    }
    
    // redirigir al index
    header('Location: index.php');