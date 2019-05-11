<?php
    // si es que el usuario ingresa en la url una id de alguna categoria que no existe no saldra error si no que solo se redirigira al index
    if (!isset($_POST['busqueda'])) {
        header("Location: index.php");
    }
?>

<!-- INCLUIMOS LA CABECERA -->
<?php require_once 'includes/cabecera.php';?>
    
    <!-- INCLUIMOS LA BARRA LATERAL -->
    <?php require_once 'includes/lateral.php';?>

    <!-- CAJA PRINCIPAL -->
    <div id="principal">

        <h1>Busqueda: <?=$_POST['busqueda']?></h1>

        <?php
            $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);
            // var_dump($entradas);
            if(!empty($entradas) && mysqli_num_rows($entradas)>=1):
                while($entrada = mysqli_fetch_assoc($entradas))://por cada fila se crea un array asociativo llamodo entrada
        ?>
                    <article class="entrada">
                        <a href="entrada.php?id=<?=$entrada['id']?>">
                            <h2><?=$entrada['titulo'] ?></h2>
                            <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                            <p>
                                <!-- con el substr limitamos el nuemro de palabras a 180 -->
                                <?=substr($entrada['descripcion'], 0, 180)."..." ?>
                            </p>
                        </a>
                    </article>
        <?php
                endwhile;
            else:
        ?>
        <div class="alerta">No hay entradas en esta categoria</div>
        <?php 
            endif; 
        ?>
    </div>
    <!-- fin principal -->
    
<!-- INLUIMOS EL FOOTERB -->
<?php require_once 'includes/pie.php'?>