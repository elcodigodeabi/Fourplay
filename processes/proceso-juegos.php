<?php
$nombre = $_POST['jue_nombre'];
$descripcion = $_POST['jue_desc'];
$categoria = $_POST['cat_id'];

$imagen = $_FILES['jue_foto']['tmp_name'];
$nombreImagen = $_FILES['jue_foto']['name'];
$tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
$tamañoImagen = $_FILES['jue_foto']['size'];    

// $rutaDestino = "ruta/donde/guardar/" . $nombreImagen;
// move_uploaded_file($imagen, $rutaDestino);

// traer archivos necesarios
include '../class/base.php';
include '../class/juego.php';

$juego = new Juego();

$juegoId = $_POST['jue_id'];

// Verificar si ya existe un juego con ese nombre
if ($juego->verificarJuegoExistente($nombre)) {
    // Si el juego existe, enviar mensaje y redirigir al usuario
    $mensaje = "Juego existente, por favor verifique si el juego existe.";
    header("Location: ../opciones-del-sistema.php?mensaje=".urlencode($mensaje));
    exit; // Terminar la ejecución del código
}

if ($juegoId == "crear") {
    // Crear el juego si no existe jue_id
    if ($juego->crearJuego($nombre, $descripcion, $categoria)) {
        $jue_id = $juego->obtenerJuegoPorNombre($nombre);

        // Crear el directorio en ../juegos con el nombre del ID del juego
        $rutaDirectorio = "../juegos/" . $jue_id;
        if (!is_dir($rutaDirectorio)) {
            mkdir($rutaDirectorio, 0777, true);
        }

        // Mover la imagen cargada a la carpeta del juego y renombrarla a imagen.png
        $rutaDestinoImagen = $rutaDirectorio . "/imagen.png";
        if (move_uploaded_file($imagen, $rutaDestinoImagen)) {
            $mensaje = "Juego creado exitosamente con imagen.";
        } else {
            $mensaje = "Error al mover la imagen al directorio del juego.";
        }
    } else {
        $mensaje = "Error al crear el juego en la base de datos.";
    }
} else {
    // Actualizar el juego con el id proporcionado en $juegoId
    $jue_id = intval($juegoId);
    if ($juego->actualizarJuego($jue_id, $nombre, $descripcion, $categoria)) {
        $mensaje = "Juego actualizado correctamente.";

        // Verificar si hay una imagen nueva para actualizar
        if (!empty($imagen)) {
            $rutaDirectorio = "../juegos/" . $jue_id;
            $rutaDestinoImagen = $rutaDirectorio . "/imagen.png";
            
            // Reemplazar la imagen existente por la nueva
            if (move_uploaded_file($imagen, $rutaDestinoImagen)) {
                $mensaje .= " Imagen del juego actualizada exitosamente.";
            } else {
                $mensaje .= " Error al actualizar la imagen del juego.";
            }
        }
    } else {
        $mensaje = "Error al actualizar el juego en la base de datos.";
    }
}

// Redirigir con el mensaje
header("Location: ../opciones-del-sistema.php?mensaje=" . urlencode($mensaje));
exit();
?>