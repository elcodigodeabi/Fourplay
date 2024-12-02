<!-- Cargar nuevo grupo -->
	<div class="container-form-addgrupo" id="container-form-addgrupo">
		<form class="crear-grupo-form" action="processes/crearGrupo.php" method="POST" enctype="multipart/form-data">
			<span class="crear-grupo-form__cerrar activador" data-accion="desaparecer" data-contenedor="container-form-addgrupo"><?php include 'public/icono-cerrar-ventana.php';?></span>
			<b class="crear-grupo-form__titulo">Crear nuevo grupo</b>
	        <input class="crear-grupo-form__imagen" type="file" name="imagen_grupo" required>
	        <label class="crear-grupo-form__label">NOMBRE</label>
	        <input class="crear-grupo-form__inputs" type="text" placeholder="Nombre del grupo" name="nombre" required>
	        <label class="crear-grupo-form__label">DESCRIPCION</label>
	        <textarea class="crear-grupo-form__descripcion crear-grupo-form__inputs" type="text" placeholder="Descripcion del grupo" name="desc" required></textarea>
	        <input class="crear-grupo-form__submit button-violet" type="submit" value="Crear Grupo" name="creargrupo">
	    </form>
	</div>