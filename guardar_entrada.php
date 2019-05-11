<?php
if (isset($_POST)) {
    require_once 'includes/conexion.php';
    
    $titulo = (isset($_POST['titulo'])) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = (isset($_POST['descripcion'])) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = (isset($_POST['categoria'])) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];

    $errores = array();
    if(empty($titulo)){
        $errores['titulo'] = 'El titulo no es valido';
    }
    if(empty($descripcion)){
        $errores['descripcion'] = 'la descripcion no es valida';
    }
    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = 'La categoria no es valida';
    }

    if(count($errores) == 0){
        if(isset($_GET['editar'])){

            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];

            $sql = "update entradas set titulo = '$titulo', descripcion='$descripcion', categoria_id=$categoria WHERE id = $entrada_id and usuario_id = $usuario_id";
            // echo $sql;
            // die();
        }
        else{
            $sql = "insert into entradas values(null, $usuario, $categoria, '$titulo', '$descripcion', curdate());";
        }
        $guardar = mysqli_query($db, $sql);
        header("Location: index.php");
    }
    else{
        $_SESSION["errores_entrada"] = $errores;
        if(isset($_GET['editar'])){
            header("Location: editar_entrada.php?id=".$_GET['editar']);
        }
        else{
            header("Location: crear_entrada.php");
        }
    }
}

