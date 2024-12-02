<?php if (isset($_GET['mensaje'])) { ?>
	<div class="tarjeta-errores">
		<span class="tarjeta-errores__icon">
			<?php include 'public/icono-confirmacion.php';?>
		</span>
		<p class="tarjeta-errores__text">"<?php echo htmlspecialchars($_GET['mensaje']); ?>".</p>
	</div>
<?php } ?>			