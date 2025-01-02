<?php
include 'class/publicidad.php';
$publicidad = new Publicidad;
$publicidades = $publicidad->listarPublicidades(); 
?>
<section class="container-aside">
	<h4>Publicidades</h4>
	<aside>
		<?php
        if (mysqli_num_rows($publicidades) > 0) {
            while ($row = mysqli_fetch_assoc($publicidades)) {
                ?>
                <div class="publicidad">
                	<img class="publicidad__imagen" src="publicidades/<?= $row['pub_id'];?>/imagen.png" width="100%">
                    <span class="publicidad__titulo"><?php echo htmlspecialchars($row['pub_titulo']); ?></span>
                    <span class="publicidad__descripcion"><?php echo htmlspecialchars($row['pub_desc']); ?></span>
                </div>
                <?php
            }
        } else {
            ?>
            <span>No hay resultados por ahora.</span>
            <?php
        }
        ?>
	</aside>
</section>