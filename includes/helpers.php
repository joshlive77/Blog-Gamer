<?php
    
    require_once 'kint.phar';

    function mostrarError($errores, $campo){
        $alerta = '';
        if(isset($errores[$campo]) && !empty($campo)){
            $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
        }
        return $alerta;
    }

    function borrarErrores(){
        $borrado = false;

        if (isset($_SESSION['errores'])) {
            $borrado = $_SESSION['errores'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['errores_entrada'])) {
            $borrado = $_SESSION['errores_entrada'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['completado'])) {
            $_SESSION['completado'] = null;
            $borrado = true;
        }
        return $borrado;
    }

    function borrarErrores2(){
        $borrado = false;
        if (isset($_SESSION['error-login'])) {
        $borrado = $_SESSION['error-login'] = null;
        unset($_SESSION['error-login']);
        }
        return $borrado;
    }

    function enviarcategorias($db){
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $categorias = mysqli_query($db, $sql);
        if ($categorias && mysqli_num_rows($categorias) >=1) {
            return $categorias;
        }
    }

    function enviarcategoria($db, $id){
        $sql = "SELECT * FROM categorias where id = $id;";
        $categoria = mysqli_query($db, $sql);
        $resultado = array();
        if ($categoria && mysqli_num_rows($categoria) >=1) {
            $resultado = mysqli_fetch_assoc($categoria);
        }

        return $resultado;
    }

    function conseguirEntradas($db, $limit = null, $categoria = null, $busqueda = null){
        $sql = "SELECT e.*, c.nombre as 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ";
        
        if(!empty($categoria)){
            $sql .= "where e.categoria_id = $categoria";
        }

        if($busqueda){
            $sql .= "where e.titulo like '%$busqueda%'";
        }

        $sql .= " order by e.id desc ";

        if($limit){
            $sql .= "limit 4";
        }

        // echo $sql;
        // die();

        $entradas = mysqli_query($db, $sql);
        $resultado = array();
        
        if ($entradas && mysqli_num_rows($entradas) >= 1) {
            return $entradas;
        }

        return $resultado;
    }

    function conseguirEntrada($db, $id){
        $sql = "SELECT e.*, c.nombre as 'categoria', concat(u.nombre, ' ', u.apellidos) as 'usuario' FROM entradas e inner join categorias c on e.categoria_id = c.id inner join usuarios u on e.usuario_id = u.id where e.id = $id;";

        $entrada = mysqli_query($db, $sql);
        $resultado = array();

        if($entrada && mysqli_num_rows($entrada) >= 1){
            $resultado = mysqli_fetch_assoc($entrada);
        }
        return $resultado;
    }