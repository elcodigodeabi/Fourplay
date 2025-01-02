<?php
include '../class/base.php';
include '../class/reportes.php'; // Asegúrate de incluir la clase Reporte

// Verificamos que el ID del reporte haya sido recibido correctamente
if (isset($_GET['rep_id'])) {
    $reporteId = (int) $_GET['rep_id'];

    // Creamos una instancia de la clase Reporte
    $reporte = new Reporte();

    // Llamamos al método para eliminar solo el reporte
    $reporteEliminado = $reporte->anularReporte($reporteId);

    // Verificamos si el reporte fue eliminado correctamente
    if ($reporteEliminado) {
        // Si se eliminó correctamente, redirigimos con un mensaje de éxito
        $mensaje = "El reporte fue rechazado y eliminado.";
    } else {
        // Si hubo un problema al eliminar el reporte
        $mensaje = "Hubo un problema al rechazar el reporte.";
    }

    // Redirigimos a la página de reportes con el mensaje en la URL
    header("Location: ../reportes.php?mensaje=" . urlencode($mensaje));
    exit(); // Es importante llamar a exit() después de header para evitar que el código siga ejecutándose
} else {
    // Si no se recibe el ID del reporte, redirigimos con un mensaje de error
    header("Location: ../reportes.php?mensaje=" . urlencode("No se recibió un ID válido de reporte."));
    exit();
}
?>
