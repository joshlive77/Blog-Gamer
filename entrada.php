<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!-- INCLUIMOS LA CABECERA -->
<?php require_once 'includes/cabecera.php';?>
    
<!-- INCLUIMOS LA BARRA LATERAL -->
<?php require_once 'includes/lateral.php';?>
<!-- CAJA PRINCIPAL -->

<?php
    // si es que el usuario ingresa en la url una id de alguna categoria que no existe no saldra error si no que solo se redirigira al index
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
        header("Location : index.php");
    }
?>

<div id="principal">
    <h1><?=$entrada_actual['titulo'];?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
        <h2><?=$entrada_actual['categoria'];?></h2>
    </a>
    <h4><?=$entrada_actual['fecha'];?> | <?= $entrada_actual['usuario']?></h4>
    <p><?=$entrada_actual['descripcion'];?></p>

    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
    <br>
    <a href="editar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-naranja">Editar entrada</a>
    <a href="borrar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Borrar entrada</a>

    <?php endif; ?>
</div>
<!-- fin principal -->
    
<!-- INLUIMOS EL FOOTERB -->
<?php require_once 'includes/pie.php'?>