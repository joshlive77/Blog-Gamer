<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">
    <h1>Crear entradas</h1>
    <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>
    <br>
    <form action="guardar_entrada" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''?>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id=""></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''?>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''?>
        <?php 
            $categorias = enviarcategorias($db);
            if(!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)) :
        ?>
                    <option value="<?=$categoria['id']?>">
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