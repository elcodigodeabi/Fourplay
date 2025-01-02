<?php
session_start();
include("../class/base.php");
include("../class/usuario.php");
include("../class/grupo.php");

$usu_id = $_SESSION['id'];

if (isset($_POST['hacerPeticion'])) {
    // Crear una instancia de Grupo
    $grupo = new Grupo();

    // Obtener el id del grupo usando el nombre
    $resultado = $grupo->obtenerIdPorNombre($_POST['nombreGrupo']);

    // Verificar que se obtuvo un resultado y convertirlo en un arreglo
    if ($row = mysqli_fetch_assoc($resultado)) {
        echo $row['gru_id'];
        echo $usu_id;
        
        // Asumimos que crearPeticion() es un método de la instancia de Grupo
        $grupo->crearPeticion($usu_id, $row['gru_id']);
        $mensaje = "Solicitud enviada con exito, por favor espere a que lo acepten.";
        header('Location: ../menu.php?mensaje='.urlencode($mensaje));
    } else {
        // Manejar el caso en que no se encuentra el grupo
        $mensaje = "Ah sucedido un error al mandar la solicitud, por favor verifique el nombre del grupo.";
        header('Location: ../menu.php?mensaje='.urlencode($mensaje));
    }
}
?>