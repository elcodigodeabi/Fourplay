<?php
include 'class/base.php';
include 'class/publicidad.php';

$publicidad = new Publicidad();
$publicidades = null;

if (isset($_GET['publicidadBusqueda'])) {
    // Si hay búsqueda para publicidades
    $publicidadBusqueda = $_GET['publicidadBusqueda'];
    $publicidades = $publicidad->buscarPublicidadesPorTitulo($publicidadBusqueda);
} else {
    // Si no hay búsqueda, listar todas las publicidades
    $publicidades = $publicidad->listarPublicidades();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4Play - Publicidades</title>
    <link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'templates/nav-admin.php'; ?>
    <h2 class="titulo-principal">Lista de publicidades</h2>

    <!-- Formulario de búsqueda de publicidades -->
    <form action="" method="get" class="form">
        <input class="buscador" placeholder="Buscar publicidades por nombre" type="text" name="publicidadBusqueda" value="<?php echo isset($_GET['publicidadBusqueda']) ? $_GET['publicidadBusqueda'] : ''; ?>">
        <input class="button-violet button" type="submit" value="Buscar">
        <!-- Botón de crear publicidad -->
        <a class="button-blue button" href="alta-publicidad.php">
            Crear nueva publicidad +
        </a>
    </form>

    <!-- Tabla de publicidades -->
    <table class="tablas">
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Costo</th>
            <th>Estado</th>
            <th>Fecha de Estado</th>
            <th>Opciones</th>
        </tr>
        <?php
        if (mysqli_num_rows($publicidades) > 0) {
            while ($row = mysqli_fetch_assoc($publicidades)) {
                ?>
                <tr class="registro reg-cat">
                    <td><?php echo htmlspecialchars($row['pub_titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_desc']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_fecha_inicio']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_fecha_fin']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_costo']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_estado']); ?></td>
                    <td><?php echo htmlspecialchars($row['pub_fecha_estado']); ?></td>
                    <td><a class="button-blue button" href="alta-publicidad.php?pub_id=<?php echo $row['pub_id']; ?>">Editar</a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="8"><span>No hay resultados por ahora.</span></td></tr>
            <?php
        }
        ?>
    </table>
    <?php include 'templates/mensajesConfirmacion.php';?>
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