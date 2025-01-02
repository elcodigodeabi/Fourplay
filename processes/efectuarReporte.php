<?php
include '../class/base.php';
include '../class/post.php';
include '../class/reportes.php'; // Asegúrate de incluir la clase Reporte

// Asegúrate de que el ID del post y del reporte se reciban correctamente
if (isset($_GET['pos_id']) && isset($_GET['rep_id'])) {
    $postId = (int) $_GET['pos_id'];
    $reporteId = (int) $_GET['rep_id'];

    // Asumiendo que tienes una instancia de la clase Post y Reporte
    $post = new Post();
    $reporte = new Reporte();

    // Llamamos al método para eliminar el reporte
    $reporteEliminado = $reporte->eliminarReportePorId($reporteId);

    // Si se eliminó el reporte correctamente, procedemos a eliminar el post
    if ($reporteEliminado) {
        $eliminado = $post->eliminarPostPorId($postId);

        // Comprobamos si la eliminación del post fue exitosa
        if ($eliminado) {
            // Si se eliminó correctamente, redirigimos con un mensaje de éxito
            $mensaje = "El reporte y la eliminación del post fueron aceptados.";
        } else {
            // Si hubo un error al eliminar el post
            $mensaje = "Hubo un problema al eliminar el post después de aceptar el reporte.";
        }
    } else {
        // Si hubo un problema al eliminar el reporte
        $mensaje = "Hubo un problema al procesar el reporte.";
    }

    // Redirigimos a reportes.php con el mensaje en la URL
    header("Location: ../reportes.php?mensaje=" . urlencode($mensaje));
    exit(); // Es importante llamar a exit() después de header para evitar que el código siga ejecutándose
} else {
    // Si no se recibe el ID del post o del reporte, redirigimos con un mensaje de error
    header("Location: ../reportes.php?mensaje=" . urlencode("No se recibió un ID válido de post o reporte."));
    exit();
}
?>