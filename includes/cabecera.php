<!-- REQUIRES -->
<?php require_once 'conexion.php'?>
<?php require_once 'helpers.php'?>
<?php require_once 'kint.phar'?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Blog de videojuegos</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    </head>
    <body>

    <!-- CABECERA -->
    <header id="cabecera">
        <div id="logo">
            <a href="index.php">
                Blog de videojuegos
                
            </a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <!-- #page>div.logo+ul#navigation>li*5>a{Item $} -->
            <ul>
                <li><a href="index.php">Inicio</a></li>

                <?php 
                    // $categorias = conseguirCategorias($db);
                    // d($categorias);
                    // $sql = "SELECT * FROM categorias ORDER BY id ASC";
                    // $categorias = mysqli_query($db, $sql);
                    // while($categoria = mysqli_fetch_assoc($categorias)):
                    $categorias = enviarcategorias($db);
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                            <li>
                                <a href="categoria.php?id=<?=$categoria['id']?>">
                                    <?=$categoria['nombre']?>
                                </a>
                            </li>
                <?php 
                        endwhile;
                    endif; 
                ?>
                <?php if(isset($_SESSION['usuario'])): ?>
                <li><a href="mis_entradas.php">Mis entradas</a></li>
                <?php endif; ?>
                <!-- <li><a href="index.php">Contacto</a></li> -->
            </ul>
        </nav>
        <!-- para limpiar los flotados y los elementos de abajo no se mezclen con los de arriba -->
        <div class="clearfix"></div>
    </header>
    <!-- CONTENEDOR PRINCIPAL -->
    <div id="contenedor">