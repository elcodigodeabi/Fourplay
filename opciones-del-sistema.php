<?php
include 'class/base.php';
include 'class/juego.php';
include 'class/categoria.php';

$juego = new Juego();
$categoria = new Categoria();

// Variables para los resultados de búsqueda
$juegos = null;
$categorias = null;

if (isset($_GET['juegoBusqueda'])) {
    // Si hay búsqueda para juegos
    $juegoBusqueda = $_GET['juegoBusqueda'];
    $juegos = $juego->buscarJuegosPorNombre($juegoBusqueda);
} else {
    // Si no hay búsqueda, listar todos los juegos
    $juegos = $juego->listarJuegos();
}

if (isset($_GET['categoriaBusqueda'])) {
    // Si hay búsqueda para categorías
    $categoriaBusqueda = $_GET['categoriaBusqueda'];
    $categorias = $categoria->buscarCategoriasPorNombre($categoriaBusqueda);
} else {
    // Si no hay búsqueda, listar todas las categorías
    $categorias = $categoria->listarCategorias();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4Play - Opciones del sistema</title>
    <link rel="stylesheet" type="text/css" href="public/estilos/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'templates/nav-admin.php'; ?>
    <h2 class="titulo-principal">Opciones de Juegos</h2>
    
    <!-- Formulario de búsqueda de juegos -->
    <form action="" method="get" class="form">
        <input class="buscador" placeholder="Buscar juegos por nombre" type="text" name="juegoBusqueda" value="<?php echo isset($_GET['juegoBusqueda']) ? $_GET['juegoBusqueda'] : ''; ?>">
        <input class="button-violet button" type="submit" value="Buscar">
        <!-- Boton de crear juego -->
        <a class="button-blue button" href="juegos.php">
            Crear juego
        </a>
    </form>

    <!-- Tabla de juegos -->
    <div class="container-juegos">
        <?php
        if (mysqli_num_rows($juegos) > 0) {
            while ($row = mysqli_fetch_assoc($juegos)) {
                ?>
                <div class="tarjeta-juegos">
                    <img class="tarjeta-juegos__imagen" src="juegos/<?php echo htmlspecialchars($row['jue_id']); ?>/imagen.png" alt="<?php echo htmlspecialchars($row['jue_nombre']); ?>" width="50">
                    <span class="tarjeta-juegos__nombre"><?php $nombreJuego = $row['jue_nombre'];echo mb_strimwidth($nombreJuego, 0, 20, '...'); ;?></span>
                    <span class="tarjeta-juegos__descripcion"><?php $descripcionJuego = $row['jue_desc'];echo mb_strimwidth($descripcionJuego, 0, 100, '...'); ;?></span>
                    <a class="button-blue button" href="juegos.php?jue_id=<?php echo $row['jue_id'] ;?>">Editar</a>
                </div>
                <?php
            }
        } else {
            ?>
            <span>No hay resultados por ahora.</span>
            <?php
        }
        ?>
    </div>

    <!-- Tabla de categorías -->
    <h2 class="titulo-principal">Opciones de Categorias</h2>

    <!-- Formulario de búsqueda de categorías -->
    <form action="" method="get" class="form">
        <input class="buscador" placeholder="Buscar categoria por nombre" type="text" name="categoriaBusqueda" value="<?php echo isset($_GET['categoriaBusqueda']) ? $_GET['categoriaBusqueda'] : ''; ?>">
        <input class="button-violet button" type="submit" value="Buscar">
        <!-- Boton de crear categoria -->
        <a class="button-blue button" href="categorias.php">
            Crear categoria
        </a>
    </form>

    <table class="tablas">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
        <?php
        if (mysqli_num_rows($categorias) > 0) {
            while ($row = mysqli_fetch_assoc($categorias)) {
                ?>
                <tr class="registros reg-cat">
                    <td><?php echo htmlspecialchars($row['cat_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['cat_desc']); ?></td>
                    <td><a class="button-blue button" href="categorias.php?cat_id=<?php echo $row['cat_id']; ?>">Editar</a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="2"><span>No hay resultados por ahora.</span></td></tr>
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