<section class="container-nav">
	<nav>
		<a href="perfil.php">
			<button class="boton-perfil">
				<img src="profile/<?php echo $_SESSION['id'] ;?>/foto_perfil/perfil.png?v=<?php echo time(); ?>">
				<div>
					<span class="boton-perfil__nombre"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ;?></span>
					<span class="boton-perfil__alias"><?php echo $_SESSION['alias'] ;?></span>
				</div>
			</button>
		</a>
		<div class="lista-grupos">
			<p>GRUPOS</p>
			<!-- las siguientes etiquetas a contienen la redireccion a los grupos -->
			<?php
			$grupo = new Grupo();
			$result = $grupo->listarMisGrupos($_SESSION['id']);

			if (mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					$result2 = $grupo->getInfo($row['gru_id']);

					while ($row2 = mysqli_fetch_assoc($result2)) { ?>
						<a class="button-icon" href="grupo.php?gru_id=<?= $row2['gru_id']; ?>&nombre=<?= $row2['gru_nombre']; ?>">
							<img src="grupos/<?= $row2['gru_id']; ?>/imagen_grupo.png?v=<?php echo time(); ?>" alt="">
							<span><?php $nombreGrupo = $row2['gru_nombre'];echo mb_strimwidth($nombreGrupo, 0, 20, '...'); ;?></span>
						</a>
					<?php }
				}
			} else { ?>
				<div class="aviso-nav-grupo" style="width: 208px;">
					<div class="aviso-nav-grupo__icono">
						<?php include 'public/icono-sin-grupo.php' ;?>
					</div>
					<h5 class="aviso-nav-grupo__titulo">¿No tienes grupo?</h5>
					<p class="aviso-nav-grupo__text">¡No te preocupes! Puedes buscar grupos que te interesen y unirte a ellos, o incluso crear tu propio grupo para conectar con otros usuarios.</p>
				</div>
			<?php } ?>
		</div>
		<button class="crear-nuevo-grupo button-violet activador" data-accion="aparecer" data-contenedor="container-form-addgrupo">Crear nuevo grupo +</button>	
	</nav>
</section>