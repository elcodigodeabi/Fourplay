<?php
include 'class/base.php';
include 'class/categoria.php';

$categoria = new Categoria();

if (isset($_GET['cat_id'])) {
    $catId = intval($_GET['cat_id']);
    $catData = $categoria->getInfo($catId);
    $catData = mysqli_fetch_assoc($catData);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Categorias</title>
	<link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'templates/nav-admin.php'; ?>
	<?php if (isset($_GET['cat_id'])): ?>
	    <h2>Modificar categoría</h2>
	<?php else: ?>
	    <h2>Crear nueva categoría</h2>
	<?php endif ?>
	<form action="processes/proceso-categorias.php" method="POST" class="form-data">
		<input class="entrada"  type="hidden" name="cat_id" value="<?php if(isset($_GET['cat_id'])){echo $_GET['cat_id'];}else{echo "crear";};?>">

	    <label for="cat_nombre">Nombre de la Categoría</label>
	    <input class="entrada"  type="text" id="cat_nombre" name="cat_nombre" value="<?php if(isset($_GET['cat_id'])) { echo $catData['cat_nombre']; } ?>" required>
	    
	    <label for="cat_descripcion">Descripción</label>
	    <textarea id="cat_descripcion" name="cat_descripcion" required><?php if(isset($_GET['cat_id'])) { echo $catData['cat_desc']; } ?></textarea>
	    
	    <?php if (isset($_GET['cat_id'])): ?>
		    <input class="button-violet button button-input" type="submit" value="Modificar Categoría">
		<?php else: ?>
		    <input class="button-violet button button-input" type="submit" value="Crear Categoría">
		<?php endif ?>
	</form>
</body>
</html>