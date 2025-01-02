<?php
$usuario = $_GET['usuario'];
$permisoId = $_GET['permisoId'];
$grupoId = $_GET['grupoId'];

include '../class/base.php';
include '../class/grupo.php';
$grupo = new Grupo();

if ($grupo->verificarModerador($permisoId, $grupoId)) {
	$result = $grupo->eliminarMiembro($usuario, $grupoId);
	if ($result) {
		$mensaje = "El miembro se ha eliminado del grupo.";
		header('location: ../grupo.php?gru_id='.$grupoId.'&mensaje='.urlencode($mensaje));
	}else{
		$mensaje = "Ah ocurrido un error al eliminar el miembro.";
		header('location: ../grupo.php?gru_id='.$grupoId.'&mensaje='.urlencode($mensaje));
	}
}else{
	$mensaje= "Ah ocurrido un error, por favor intente mas tarde.";
	header('location: ../menu.php&mensaje='.urlencode($mensaje));
}

?>