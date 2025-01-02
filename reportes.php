<?php
include("class/base.php");
include("class/reportes.php");
include("class/post.php");

$reporte = new Reporte();
$post = new Post();

$reportesData = []; // Inicializamos la variable para manejar el resultado
if (isset($_GET["listarReportes"])) {
    if ($_GET['listarReportes'] == "todos") {
        $reportesData = $reporte->listarTodosLosReportes();
    } else {
        $rep_id = $_GET['rep_id'];
        $reportesData = $reporte->listarReportes($rep_id);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Reportes</title>
    <link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'templates/nav-admin.php'; ?>
    <form action="" method="get" class="form">
        <input class="buscador" type="text" name="rep_id" placeholder="Buscar por ID" id="">
        <button class="button-blue button" type="submit" name="listarReportes" value="todos">Listar Todos</button>
        <button class="button-violet button" type="submit" name="listarReportes" value="buscar">Buscar</button>
    </form>
    <table class="tablas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>ID</th>
                <th>foto</th>
                <th>descripcion</th>
                <th>opcion</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($reportesData && mysqli_num_rows($reportesData) > 0): ?>
                <?php while ($reporte = $reportesData->fetch_assoc()): ?>
                    <tr class="registros">
                        <td><?= $reporte['rep_id']; ?></td>
                        <td><?= $reporte['rep_desc']; ?></td>
                        <td><?= $reporte['rep_fecha']; ?></td>
                        <td><?= $reporte['pos_id']; ?></td>
                        <?php
                            $dataPost = $post->obtenerPostPorId($reporte['pos_id']);
                        ?>
                        <td><img src="<?= $dataPost['pos_dir']; ?>" style="width: 50px"></td>
                        <td><?= $dataPost['pos_desc']; ?></td>
                        <td class="opcion-reporte"><a class="button-blue button" href="processes/efectuarReporte.php?pos_id=<?= $reporte['pos_id']; ?>&rep_id=<?= $reporte['rep_id']; ?>">Eliminar</a></td>
                        <td class="opcion-reporte"><a class="button-blue button" href="processes/anularReporte.php?pos_id=<?= $reporte['pos_id']; ?>&rep_id=<?= $reporte['rep_id']; ?>">Rechazar</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay resultados</td>
                </tr>
            <?php endif; ?>
        </tbody>
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