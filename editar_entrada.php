<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
    // si es que el usuario ingresa en la url una id de alguna categoria que no existe no saldra error si no que solo se redirigira al index
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
        header("Location : index.php");
    }
?>

<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">
    <h1>Editar entradas</h1>
    <p>Edita tu entrada <?= $entrada_actual['titulo']?></p>
    <br>
    <form action="guardar_entrada.php?editar=<?=$entrada_actual['id']?>" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?= $entrada_actual['titulo']?>">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''?>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id=""><?= $entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''?>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''?>
        <?php 
            $categorias = enviarcategorias($db);
            if(!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)) :
        ?>
                    <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected = "selected"' : ''?>>
                        <?=$categoria['nombre']?>
                    </option>
        <?php
                endwhile;
            endif;
        ?>
        </select>
            
        <input type="submit" value="guardar">
    </form>
    <?php borrarErrores()?>
</div>

<?php require_once 'includes/pie.php'?>