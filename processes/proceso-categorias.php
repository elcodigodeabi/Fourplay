<?php
$nombre=$_POST['cat_nombre'];
$descripcion=$_POST['cat_descripcion'];

include '../class/base.php';
include '../class/categoria.php';

$catId = $_POST['cat_id'];
$categoria = new Categoria();

if ($catId == "crear") {
	if ($categoria->crearCategoria($nombre, $descripcion)) {
		$mensaje = "categoria añadida con exito.";
	}else{
		$mensaje = "ah ocurrido un error al añadir la categoria nueva";
	}
	header("location: ../opciones-del-sistema.php?mensaje=".urlencode($mensaje));
	exit();
}else{
	$catId = intval($catId);
	if ($categoria->actualizarCategoria($catId, $nombre, $descripcion)) {
		$mensaje = "Se ah actualizado la categoria seleccionada.";
	}else{
		$mensaje = "No se ah podido actualizar la categoria seleccionada,intente mas tarde.";
	}
	header("location: ../opciones-del-sistema.php?mensaje=".urlencode($mensaje));
	exit();
}
?>