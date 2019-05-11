
<!-- INCLUIMOS LA CABECERA -->
<?php require_once 'includes/cabecera.php'?>
    
    <!-- INCLUIMOS LA BARRA LATERAL -->
    <?php require_once 'includes/lateral.php'?>

    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Ultimas entradas</h1>

        <?php
            $entradas = conseguirEntradas($db, true);
            // var_dump($entradas);
            if(!empty($entradas)):
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
            endif;
        ?>
        <div id="ver-todas">
            <a href="entradas.php">ver todas las entradas</a>
        </div>
    </div>
    <!-- fin principal -->
    
<!-- INLUIMOS EL FOOTERB -->
<?php require_once 'includes/pie.php'?>