<?php
include '../class/base.php'; // Incluye la base de datos
include '../class/reportes.php'; // Incluye la clase Reporte

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;
    $reason = $_POST['reason'] ?? null;

    if ($post_id && $reason) {
        // Crear una instancia de Reporte
        $reporte = new Reporte();

        // Insertar el reporte
        if ($reporte->crearReporte($post_id, $reason)) {
            $mensaje = "¡Gracias! Hemos recibido tu reporte y lo revisaremos pronto.";
        } else {
            $mensaje = "Ups, algo salió mal. No pudimos enviar tu reporte, inténtalo más tarde.";
        }
    } else {
        $mensaje = "Por favor, cuéntanos la razón del reporte antes de enviarlo.";
    }
} else {
    $mensaje = "Esta acción no es válida. Intenta desde el formulario.";
}

// Redirigir a menu.php con el mensaje
header("Location: ../menu.php?mensaje=".urlencode($mensaje));
exit;
?>