<?php
$titulo = $_POST['pub_titulo'];
$descripcion = $_POST['pub_desc'];
$fechaInicio = $_POST['pub_fecha_inicio'];
$fechaFin = $_POST['pub_fecha_fin'];
$costo = $_POST['pub_costo'];
$estado = $_POST['pub_estado'];
$fechaEstado = $_POST['pub_fecha_estado'];

$imagen = $_FILES['pub_imagen']['tmp_name'];
$nombreImagen = $_FILES['pub_imagen']['name'];
$tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
$tamañoImagen = $_FILES['pub_imagen']['size'];

// traer archivos necesarios
include '../class/base.php';
include '../class/publicidad.php';

$publicidad = new Publicidad();

$publicidadId = $_POST['pub_id'];

if ($publicidadId == "crear") {
    // Crear la publicidad si no existe pub_id
    if ($publicidad->crearPublicidad($titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado)) {
        $pub_id = $publicidad->obtenerPublicidadPorTitulo($titulo);

        // Crear el directorio en ../publicidades con el nombre del ID de la publicidad
        $rutaDirectorio = "../publicidades/" . $pub_id;
        if (!is_dir($rutaDirectorio)) {
            mkdir($rutaDirectorio, 0777, true);
        }

        // Mover la imagen cargada a la carpeta de la publicidad y renombrarla a imagen.png
        $rutaDestinoImagen = $rutaDirectorio . "/imagen.png";
        if (move_uploaded_file($imagen, $rutaDestinoImagen)) {
            $mensaje = "Publicidad creada exitosamente con imagen.";
        } else {
            $mensaje = "Error al mover la imagen al directorio de la publicidad.";
        }
    } else {
        $mensaje = "Error al crear la publicidad en la base de datos.";
    }
} else {
    // Actualizar la publicidad con el id proporcionado en $publicidadId
    $pub_id = intval($publicidadId);
    if ($publicidad->actualizarPublicidad($pub_id, $titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado)) {
        $mensaje = "Publicidad actualizada correctamente.";

        // Verificar si hay una imagen nueva para actualizar
        if (!empty($imagen)) {
            $rutaDirectorio = "../publicidades/" . $pub_id;
            $rutaDestinoImagen = $rutaDirectorio . "/imagen.png";
            
            // Reemplazar la imagen existente por la nueva
            if (move_uploaded_file($imagen, $rutaDestinoImagen)) {
                $mensaje .= " Imagen de la publicidad actualizada exitosamente.";
            } else {
                $mensaje .= " Error al actualizar la imagen de la publicidad.";
            }
        }
    } else {
        $mensaje = "Error al actualizar la publicidad en la base de datos.";
    }
}

// Redirigir con el mensaje
header("Location: ../publicidades.php?mensaje=" . urlencode($mensaje));
exit();
?>