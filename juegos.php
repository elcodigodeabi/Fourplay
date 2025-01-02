<?php
include 'class/base.php';
include 'class/juego.php';
include 'class/categoria.php';

$juego = new Juego();
$categoria = new Categoria();

if (isset($_GET['jue_id'])) {
    $juegoId = intval($_GET['jue_id']);
    $juegoData = $juego->getInfo($juegoId);
    $juegoData = mysqli_fetch_assoc($juegoData);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Juego</title>
    <link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'templates/nav-admin.php'; ?>
    <?php if (isset($_GET['jue_id'])): ?>
        <h2>Modificar juego</h2>
    <?php else: ?>
        <h2>Crear nuevo juego</h2>
    <?php endif ?>
    <form class="form-data" action="processes/proceso-juegos.php" method="POST" enctype="multipart/form-data">
        <!-- input con id de juegos en el caso de que se este modificando -->
        <input class="entrada" type="hidden" name="jue_id" value="<?php if(isset($_GET['jue_id'])){echo $_GET['jue_id'];}else{echo "crear";};?>">
        <!-- inputs normales del form -->
        <label for="jue_nombre">Nombre del Juego</label>
        <input class="entrada" type="text" id="jue_nombre" name="jue_nombre" value="<?php if(isset($_GET['jue_id'])) { echo $juegoData['jue_nombre']; } ?>" required>

        <label for="jue_descrip">Descripción del Juego</label>
        <textarea id="jue_descrip" name="jue_desc" required><?php if(isset($_GET['jue_id'])) { echo $juegoData['jue_desc']; } ?></textarea>

        <label for="jue_foto">Foto del Juego</label>
        <input class="entrada" type="file" id="jue_foto" name="jue_foto" accept="image/*" required>

        <label for="cat_id">Selecciona una Categoría</label>
        <select name="cat_id" required>
            <option value="">Selecciona una categoría</option>
            <?php
            // Listamos las categorías
            $result = $categoria->listarCategorias(); // Asegúrate de tener este método en la clase Categoria
            if ($result->num_rows > 0) {
                while ($registro = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $registro['cat_id'] . '">' . $registro['cat_nombre'] . '</option>';
                }
            }
            ?>
        </select>

        <?php if (isset($_GET['jue_id'])): ?>
            <input class="button-violet button button-input" type="submit" value="Modificar Juego">
        <?php else: ?>
            <input class="button-violet button button-input" type="submit" value="Crear Juego">
        <?php endif ?>
    </form>
</body>
</html>