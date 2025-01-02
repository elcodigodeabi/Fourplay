<?php
include("class/base.php");
include("class/grupo.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4Play - Listado de grupos</title>
    <link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'templates/nav-admin.php'; ?>
    <!--buscador de grupos-->
    <h2 class="titulo-principal">Listado de grupos</h2>
    
    <form action="processes/crearPDF.php" method="post" class="form">
    <input class="buscador" type="text" name="nombre_grupo" placeholder="Busca un grupo en particular">
    <input class="button-violet button" type="submit" value="Buscar" name="Buscar">
    <a class="button-blue button" href="listado-grupos.php?nombre_grupo=todos&Buscar=Buscar">Mostrar todos</a>
    <button type="submit" class="button-blue button">Generar PDF</button>
</form>


    <!--listado de grupos-->
    <?php
    if (isset($_GET['Buscar'])) {
        $nombre_grupo = $_GET['nombre_grupo'];
        $grupo = new Grupo();

        if ($nombre_grupo == "todos") {
            // Obtener todos
            $resultado_grupos = $grupo->listarGrupos();
        }else{
            // Obtener los grupos que coincidan con el nombre
            $resultado_grupos = $grupo->listarGruposPorNombre($nombre_grupo);
        }

        ?>
        <table class="tablas">
            <tr>
                <th>ID</th>
                <th>Nombre del Grupo</th>
                <th>Descripcion</th>
                <th>Cantidad de Miembros</th>
            </tr>
        <?php
        // Iterar sobre los grupos
        if (mysqli_num_rows($resultado_grupos)>0) {
            while ($row_grupo = mysqli_fetch_assoc($resultado_grupos)) {
                ?>
                <tr class="registros">
                    <td><?php echo $row_grupo['gru_id']; ?></td>
                    <td><?php echo $row_grupo['gru_nombre']; ?></td>
                    <td><?php echo $row_grupo['gru_desc'] ?></td>
                    <?php
                    // Obtener la cantidad de miembros del grupo actual
                    $resultado_miembros = $grupo->listarMiembros($row_grupo['gru_id']);
                    $cantidadMiembros = 0;

                    // Contar el número de miembros
                    while ($row_miembro = mysqli_fetch_assoc($resultado_miembros)) {
                        $cantidadMiembros += 1;
                    }
                    ?>

                    <td><?php echo $cantidadMiembros; ?></td>
                </tr>
                <?php
            }
        }else{
            ?>
                <tr>
                    <td colspan="4">No hay resultados</td>
                </tr>
            <?php
        }
        ?>       
        </table>
        <?php
    }
    ?>
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