<?php
session_start();
include 'class/base.php';
include 'class/juego.php';
include 'class/usuario.php';
include 'class/grupo.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>4Play - Menu</title>
	<link rel="icon" href="public/favicon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="public/estilos/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="public/estilos/menu.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<!-- display reportes -->
	<div class="container-report" id="container-report">
		<form id="reportForm" action="processes/proceso-reporte.php" method="post" class="reporte">
			<span class="reporte__cerrar activador" data-accion="desaparecer" data-contenedor="container-report"><?php include 'public/icono-cerrar-ventana.php'; ?></span>
		    <input type="hidden" name="post_id" id="postId">
		    <label class="reporte__label" for="reason">Razón del reporte:</label>
		    <textarea class="reporte__textarea" name="reason" id="reason" rows="4" required></textarea>
		    <input type="submit" class="button-violet reporte__submit" value="Enviar reporte">
		</form>
	</div>
	<!-- Cargar Post -->
	<div class="container-form-addpost" id="container-form-addpost">
		<form class="form-post" action="processes/postear.php" method="post" enctype="multipart/form-data">
			<b class="form-post__titulo">Crear nuevo post</b>
		    <span class="form-post__cerrar activador" data-accion="desaparecer" data-contenedor="container-form-addpost" title="Cerrar ventana"><?php include 'public/icono-cerrar-ventana.php' ;?></span>
		    
		    <!-- Input de archivo -->
		    <input class="form-post__input input-archivo" type="file" name="imagen">
		    
		    <!-- Descripción -->
		    <label class="form-post__label" for="desc">DESCRIPCION</label>
		    <textarea class="form-post__text-mensaje" id="desc" name="desc" rows="4" cols="50" maxlength="250" required></textarea>
			<input type="hidden" name="categoria" value="">
		    
		    <!-- Juegos -->
		    <label class="form-post__label" for="juego">JUEGO</label>
		    <select class="form-post__input input-opciones" name="juego">
		        <option value="">Selecciona un juego</option>
		        <!-- Aquí van las opciones de juegos -->
		  		<?php
				    $juego = new Juego();
				    $result = $juego->listarJuegos();
				    if ($result->num_rows>0) {
				       	while ($registro=mysqli_fetch_assoc($result)){ ?>
				        <option value="<?php echo $registro['jue_id'];?>"><?php echo $registro['jue_nombre'];?></option>
				    	<?php }
				    }
				?>      
		    </select>
		    <p class="form-post__text-juego">Selecciona un juego para asociarlo a tu aviso, este sera visto por otras personas que tengan este juego como preferencia.</p>
		    <!-- Botón de envío -->
		    <input class="form-post__input boton-publicar button-violet" type="submit" value="Publicar" name="publicar">
		</form>
	</div>
	<?php include 'templates/formularioAdherirGrupo.php' ;?>
	<div class="display">
		<?php include 'templates/header.php'; ?>
		<?php include 'templates/nav.php'; ?>
		<main class="menu">
			<!-- contenedor de creacion nuevo post -->
			<div class="crear-post"><img class="crear-post__imagen" src="profile/<?php echo $_SESSION['id'] ;?>/foto_perfil/perfil.png?v=<?php echo time(); ?>"><button class="crear-post__boton activador" data-accion="aparecer" data-contenedor="container-form-addpost">Crear un post nuevo +</button></div>
			<!-- contenedor para filtro de post -->
			<div class="container-filtros">
				<a href="menu.php?busqueda=tuyos"><button class="button-blue">Tuyos</button></a>
				<a href="menu.php?busqueda=paraVos"><button class="button-violet">Mis preferencias</button></a>
				<a href="menu.php?busqueda=todos"><button class="button-red">Todos</button></a>
			</div>
			<!-- post -->
			<?php
			include 'class/post.php';
			$post = new Post();
			if (isset($_GET['busqueda']) && $_GET['busqueda']=="paraVos") {
				$result = $post->obtenerPostsDeInteres($_SESSION['id']);
				if ($result && $result->num_rows>0) {
					while ($registro=mysqli_fetch_assoc($result)) { ?>
						<div class="post">
							<div class="post-perfil">
								<?php
								$usuario = new Usuario();
								$resultadoDatosUsuario=$usuario->obtenerDatos($registro['usu_id']);
								$registroDatosUsuario=mysqli_fetch_assoc($resultadoDatosUsuario);
								?>
								<img class="post-perfil__foto" src="profile/<?php echo $registroDatosUsuario['usu_id'];?>/foto_perfil/perfil.png?v=<?php echo time(); ?>">
								<span class="post-perfil__nombre-usuario">
									<strong><?php echo $registroDatosUsuario['usu_alias'];?></strong><br>
									<span><?php echo $registro['pos_hora']." ". $registro['pos_fecha'] ;?></span>		
								</span>
								<!-- boton de reportes -->
								<button data-post="<?php echo $registro['pos_id']; ?>" class="report-btn activador" data-accion="aparecer" data-contenedor="container-report">
								    <?php include 'public/logo-report.php'; ?>
								</button>
							</div>
							<p class="post__text"><?php echo $registro['pos_desc'];?></p>
							<?php if (!empty($registro['pos_dir'])): ?>
							    <img class="post__imagen" src="<?php echo $registro['pos_dir']; ?>?v=<?php echo time(); ?>">
							<?php endif; ?>
						</div>
					<?php }
				}else{
					?>
					<div class="post-text">
						<?php include 'public/icono-else-menu.php';?>
						<p class="text-else">"No hemos encontrado posts que coincidan con tus preferencias actuales. Asegúrate de que tus preferencias de juegos estén actualizadas para ver contenido que te interese. Puedes ajustar tus preferencias en la sección de configuración."</p>
					</div>
					<?php
				}
			}
			if (isset($_GET['busqueda']) && $_GET['busqueda'] == "tuyos") {
			    $result = $post->obtenerMisPosts($_SESSION['id']);
			    if ($result && $result->num_rows > 0) {
			        while ($registro = mysqli_fetch_assoc($result)) { ?>
			            <div class="post">
			                <div class="post-perfil">
			                    <?php
			                    $usuario = new Usuario();
			                    $resultadoDatosUsuario = $usuario->obtenerDatos($registro['usu_id']);
			                    $registroDatosUsuario = mysqli_fetch_assoc($resultadoDatosUsuario);
			                    ?>
			                    <img class="post-perfil__foto" src="profile/<?php echo $registroDatosUsuario['usu_id']; ?>/foto_perfil/perfil.png?v=<?php echo time(); ?>">
			                    <span class="post-perfil__nombre-usuario">
									<strong><?php echo $registroDatosUsuario['usu_alias'];?></strong><br>
									<span><?php echo $registro['pos_hora']." ". $registro['pos_fecha'] ;?></span>		
								</span>
								<a title="eliminar post" class="post-perfil__eliminar" href="processes/eliminarPost.php?post=<?php echo $registro['pos_id'];?>"><?php include 'public/icono-eliminar.php' ;?></a>
			                </div>
			                <p class="post__text"><?php echo $registro['pos_desc']; ?></p>
			                <?php if (!empty($registro['pos_dir'])): ?>
							    <img class="post__imagen" src="<?php echo $registro['pos_dir']; ?>?v=<?php echo time(); ?>">
							<?php endif; ?>
			            </div>
			        <?php }
			    }else{
					?>
					<div class="post-text">
						<?php include 'public/icono-else-menu.php';?>
						<p class="text-else">"Actualmente no has realizado ninguna publicación en nuestra plataforma. Empieza a compartir tus pensamientos y experiencias creando un nuevo post para que tus publicaciones aparezcan aquí."</p>
					</div>
					<?php
				}
			}
			if (!isset($_GET['busqueda']) || $_GET['busqueda'] == "todos") {
			    // Obtener todos los posts, del más nuevo al más viejo
			    $result = $post->obtenerTodosLosPosts();
			    if ($result && $result->num_rows > 0) {
			        while ($registro = mysqli_fetch_assoc($result)) { ?>
			            <div class="post">
			                <div class="post-perfil">
			                    <?php
			                    $usuario = new Usuario();
			                    $resultadoDatosUsuario = $usuario->obtenerDatos($registro['usu_id']);
			                    $registroDatosUsuario = mysqli_fetch_assoc($resultadoDatosUsuario);
			                    ?>
			                    <img class="post-perfil__foto" src="profile/<?php echo $registroDatosUsuario['usu_id']; ?>/foto_perfil/perfil.png?v=<?php echo time(); ?>">
			                    <span class="post-perfil__nombre-usuario">
			                        <strong><?php echo $registroDatosUsuario['usu_alias'];?></strong><br>
			                        <span><?php echo $registro['pos_hora']." ". $registro['pos_fecha'] ;?></span>        
			                    </span>
			                    <!-- boton reportes -->
			                    <button data-post="<?php echo $registro['pos_id']; ?>" class="report-btn activador" data-accion="aparecer" data-contenedor="container-report">
								    <?php include 'public/logo-report.php'; ?>
								</button>
			                </div>
			                <p class="post__text"><?php echo $registro['pos_desc']; ?></p>
			                <?php if (!empty($registro['pos_dir'])): ?>
			                    <img class="post__imagen" src="<?php echo $registro['pos_dir']; ?>?v=<?php echo time(); ?>">
			                <?php endif; ?>
			            </div>
			        <?php }
			    }else{
					?>
					<div class="post-text">
						<?php include 'public/icono-else-menu.php';?>
						<p class="text-else">"Actualmente no hay posts disponibles en la plataforma. Te invitamos a volver más tarde o comenzar a participar creando tus propios posts para enriquecer la comunidad."</p>
					</div>
					<?php
				}
			}
			?>
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
	<script>
		document.addEventListener('DOMContentLoaded', () => {
		    // Selecciona todos los botones de reporte
		    const reportButtons = document.querySelectorAll('.report-btn');
		    const reportForm = document.getElementById('reportForm');
		    const postIdInput = document.getElementById('postId');

		    reportButtons.forEach(button => {
		        button.addEventListener('click', () => {
		            // Obtener el ID del post desde el atributo data-post
		            const postId = button.getAttribute('data-post');

		            // Asignar el ID al input hidden del formulario
		            postIdInput.value = postId;

		            // Mostrar el formulario (opcional, según diseño)
		            reportForm.style.display = 'block';
		        });
		    });
		});
	</script>
</body>
</html>