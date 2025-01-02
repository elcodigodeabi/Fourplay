<?php
session_start();
include 'class/base.php';
include 'class/usuario.php';
include 'class/juego.php';
include 'class/grupo.php';
$usuario = new Usuario();
$juego = new Juego();
//obtener datos del usuario
$registro = $usuario->obtenerDatos($_SESSION['id']);
$datosUsuario = mysqli_fetch_assoc($registro);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>4Play - <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?></title>
	<link rel="icon" href="public/favicon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="public/estilos/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="public/estilos/perfil.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<!--cambiar foto contenedror-->
	<div class="cambiar-foto-display" id="cambiar-foto-display">
		<form class="cambiar-foto" action="processes/cambiarFotoPerfil.php" method="POST" enctype="multipart/form-data">
			<span class="cambiar-foto__cerrar activador" data-accion="desaparecer" data-contenedor="cambiar-foto-display"><?php include 'public/icono-cerrar-ventana.php';?></span>
		    <label class="cambiar-foto__label">Subir Foto de Perfil</label>
		    <input class="cambiar-foto__inputs elegir-archivo" type="file" name="foto" id="foto">
		    <input class="cambiar-foto__inputs subir-foto" type="submit" value="Subir">
		</form>
	</div>
	<?php include 'templates/formularioAdherirGrupo.php';?>
	<div class="display">
		<?php include 'templates/header.php'; ?>
		<?php include 'templates/nav.php'; ?>
		<main class="menu">
			<!-- Datos perfil -->
			<div class="perfil">
				<div class="perfil__foto">
					<div class="perfil__foto__data__container">
						<img class="perfil__foto__imagen" src="profile/<?php echo $_SESSION['rol_id'] ;?>/foto_perfil/perfil.png?v=<?php echo time(); ?>">
						<span class="perfil__foto__boton--edit activador" data-accion="aparecer" data-contenedor="cambiar-foto-display" title="Editar foto">
							<?php include 'public/icono-editar-foto-perfil.php';?>
						</span>
						<div class="perfil__foto__nombre">
							<span class="perfil__foto__nombre__nombre"><?php echo $datosUsuario['usu_nombre']." ".$datosUsuario['usu_apellido'] ;?></span>
							<h4 class="perfil__foto__nombre__alias"><?php echo $datosUsuario['usu_alias'] ;?></h4>
						</div>
					</div>
				</div>
				<div class="perfil__data">
					<form class="perfil__form" action="processes/actualizarMisDatos.php" method="post">
						<b class="perfil__form__titulo">Informacion personal</b><input class="perfil__form__boton button-violet" type="submit" value="Guardar +" name="informacion-personal">
						<div class="perfil__form__entradas">
							<label class="perfil__form__entradas__labels">NOMBRE</label>
							<input class="perfil__form__entradas__inputs" type="text" name="nombre" value="<?php echo $datosUsuario['usu_nombre'];?>" required>
							<label class="perfil__form__entradas__labels">APELLIDO</label>
							<input class="perfil__form__entradas__inputs" type="text" name="apellido" value="<?php echo $datosUsuario['usu_apellido'] ;?>" required>
						</div>
					</form>
					<form class="perfil__form" action="processes/actualizarMisDatos.php" method="post">	
						<b class="perfil__form__titulo">Correo electronico</b><input class="perfil__form__boton button-violet" type="submit" value="Guardar +" name="informacion-correo">
						<div class="perfil__form__entradas">
							<div><label class="perfil__form__entradas__labels">CORREO</label><input class="perfil__form__entradas__inputs" type="email" name="correo" value="<?php echo $datosUsuario['usu_correo'] ;?>" required></div>	
						</div>
					</form>
					<form class="perfil__form" action="processes/actualizarMisDatos.php" method="post">	
						<b class="perfil__form__titulo">Alias o nombre de usuario</b><input class="perfil__form__boton button-violet" type="submit" value="Guardar +" name="informacion-alias">
						<div class="perfil__form__entradas">	
							<div><label class="perfil__form__entradas__labels">ALIAS</label><input class="perfil__form__entradas__inputs" type="text" name="alias" value="<?php echo $datosUsuario['usu_alias'];?>" required></div>
						</div>
					</form>
					<p class="perfil__text">Importante: El Alias que cambies será también el utilizado para iniciar sesión. Asegúrate de ingresar el nuevo correo correctamente para evitar problemas al acceder a tu cuenta; de lo contrario, el correo actual se mantendrá sin cambios.</p>
				</div>
				<div class="perfil__juegos">
					<!-- Formulario para añadir nuestros preferencias en juegos -->
					<form class="juego-preferencia" action="processes/añadirMisJuegos.php" method="post">
						<h4 class="juego-preferencia__titulo">Mis preferencias</h4>
						<p class="juego-preferencia__text">Agrega tus juegos favoritos para recibir publicaciones relacionadas con ellos. ¡Elige ahora y disfruta de contenido a tu medida!</p>
						<label class="juego-preferencia__label" for="juego">JUEGOS</label>
					    <select class="juego-preferencia__opciones" name="juego-opcion">
					        <option value="">Selecciona un juego</option>
					        <!-- Aquí van las opciones de categorías -->
					        <?php
					        $result = $juego->listarJuegos();
					        if ($result->num_rows>0) {
					        	while ($registro=mysqli_fetch_assoc($result)){ ?>
					        		<option value="<?php echo $registro['jue_id'];?>"><?php echo $registro['jue_nombre'];?></option>
					        	<?php }
					        }
					        ?>
					    </select>
					    <input class="juego-preferencia__input button-violet" type="submit" name="" value="Añadir preferencia">
					</form>
					<div class="lista-juego-preferencias">
						<?php
						$result = $juego->listarJuegosPorUsuario($_SESSION['id']);
						if ($result->num_rows>0) {
							while ($registro=mysqli_fetch_assoc($result)) {
								$dataJuego = $juego->getInfo($registro['jue_id']);
								$dataJuego = mysqli_fetch_assoc($dataJuego);
								?>
								<div class="item-juego">
									<img class="item-juego__imagen" src="juegos/<?php echo $dataJuego['jue_id'];?>/imagen.png">
									<b class="item-juego__nombre" title="<?php echo $dataJuego['jue_nombre'];?>"><?php $nombreJuego = $dataJuego['jue_nombre'];echo mb_strimwidth($nombreJuego, 0, 30, '...'); ;?></b>
									<a class="item-juego__boton" href="processes/eliminarPreferencia.php?usuario=<?php echo $_SESSION['id']; ?>&juego=<?php echo $dataJuego['jue_id'];?>">
										<?php include 'public/icono-eliminar-preferencia-juego.php' ;?>
									</a>
								</div>
							<?php }
						}
						?>
					</div>
				</div>
			</div>
		</main>
		<?php include 'templates/aside.php'; ?>
		<?php include 'templates/mensajesConfirmacion.php';?>
	</div>
	<script type="text/javascript" src="public/ventanas.js"></script>
	<script type="text/javascript">
		setTimeout(function() {
		    const tarjetaErrores = document.querySelector('.tarjeta-errores');
		    if (tarjetaErrores) {
		        tarjetaErrores.style.display = 'none';
		    }
		}, 8000);
	</script>
</body>
</html>