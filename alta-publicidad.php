<?php

include 'class/base.php';
include 'class/publicidad.php';

$publicidad = new Publicidad();

if (isset($_GET['pub_id'])) {
    $publicidadId = intval($_GET['pub_id']);
    $publicidadData = $publicidad->getInfo($publicidadId);
    $publicidadData = mysqli_fetch_assoc($publicidadData);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>4play - Publicidades</title>
	<link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'templates/nav-admin.php'; ?>
	<?php if (isset($_GET['pub_id'])): ?>
        <h2>Modificar publicidad</h2>
    <?php else: ?>
        <h2>Crear nueva publicidad</h2>
    <?php endif ?>
	<form action="processes/proceso-publicidad.php" method="post" enctype="multipart/form-data" class="form-data">
		<!-- retener el id para crear o modificar -->
		<input class="entrada"  type="hidden" name="pub_id" value="<?php if(isset($_GET['pub_id'])){echo $_GET['pub_id'];}else{echo "crear";};?>">

		<label for="pub_imagen">Imagen</label>
		<input class="entrada"  type="file" id="pub_imagen" name="pub_imagen" accept="image/*">

	    <label for="pub_titulo">Título</label>
	    <input class="entrada"  type="text" id="pub_titulo" name="pub_titulo" maxlength="30" value="<?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_titulo'];};?>" required>

	    <label for="pub_desc">Descripción</label>
	    <textarea id="pub_desc" name="pub_desc" maxlength="250" required><?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_desc'];};?></textarea>

	    <label for="pub_fecha_inicio">Fecha de Inicio</label>
	    <input class="entrada" type="date" id="pub_fecha_inicio" name="pub_fecha_inicio" value="<?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_fecha_inicio'];};?>" required>

	    <label for="pub_fecha_fin">Fecha de Fin</label>
	    <input class="entrada" type="date" id="pub_fecha_fin" name="pub_fecha_fin" value="<?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_fecha_fin'];};?>" required>

	    <label for="pub_costo">Costo</label>
	    <input class="entrada" type="number" id="pub_costo" name="pub_costo" step="0.01" value="<?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_costo'];};?>" required>

	    <label for="pub_estado">Estado</label>
		<div>
		    <input type="radio" id="pub_estado_activado" name="pub_estado" value="1" required>
		    <label for="pub_estado_activado">Activado</label>
		    
		    <input type="radio" id="pub_estado_desactivado" name="pub_estado" value="0">
		    <label for="pub_estado_desactivado">Desactivado</label>
		</div>

	    <label for="pub_fecha_estado">Fecha de Estado</label>
	    <input class="entrada" type="date" id="pub_fecha_estado" name="pub_fecha_estado" value="<?php if(isset($_GET['pub_id'])){echo $publicidadData['pub_fecha_estado'];};?>" >

	    <?php if (isset($_GET['pub_id'])): ?>
            <input class="button-violet button button-input" type="submit" value="Modificar publicidad">
        <?php else: ?>
            <input class="button-violet button button-input" type="submit" value="Crear publicidad">
        <?php endif ?>
	</form>
</body>
</html>