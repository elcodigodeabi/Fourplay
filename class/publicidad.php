<?php

class Publicidad{

	public function __construct() {
        $this->base = new BaseLocal();
    }

    public function listarPublicidades() {
	    $sql = "SELECT * FROM publicidades";
	    $stmt = $this->base->prepararConsulta($sql);
	    $this->base->ejecutarConsulta($stmt);
	    $result = $this->base->obtenerResultado($stmt);
	    return $result;
	}

	public function getInfo($pub_id) {
	    $sql = "SELECT * FROM publicidades WHERE pub_id = ?";
	    $stmt = $this->base->prepararConsulta($sql);
	    $stmt->bind_param("i", $pub_id);
	    $this->base->ejecutarConsulta($stmt);
	    $result = $this->base->obtenerResultado($stmt);
	    return $result;
	}

	public function buscarPublicidadesPorTitulo($titulo) {
	    $sql = "SELECT * FROM publicidades WHERE pub_titulo LIKE ?";
	    $stmt = $this->base->prepararConsulta($sql);
	    $likeTitulo = "%$titulo%";
	    $stmt->bind_param("s", $likeTitulo);
	    $this->base->ejecutarConsulta($stmt);
	    return $this->base->obtenerResultado($stmt);
	}

	// Método para verificar si ya existe una publicidad con el mismo título
    public function verificarPublicidadExistente($titulo) {
        $sql = "SELECT COUNT(*) FROM publicidades WHERE pub_titulo = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("s", $titulo);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        $row = $result->fetch_row();
        return $row[0] > 0;
    }

    // Método para crear una nueva publicidad
    public function crearPublicidad($titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado) {
        $sql = "INSERT INTO publicidades (pub_titulo, pub_desc, pub_fecha_inicio, pub_fecha_fin, pub_costo, pub_estado, pub_fecha_estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ssssdss", $titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado);
        return $this->base->ejecutarConsulta($stmt);
    }

    // Método para obtener el ID de una publicidad por su título
    public function obtenerPublicidadPorTitulo($titulo) {
        $sql = "SELECT pub_id FROM publicidades WHERE pub_titulo = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("s", $titulo);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        $row = $result->fetch_assoc();
        return $row['pub_id'] ?? null;
    }

    // Método para actualizar una publicidad existente
    public function actualizarPublicidad($pub_id, $titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado) {
        $sql = "UPDATE publicidades SET pub_titulo = ?, pub_desc = ?, pub_fecha_inicio = ?, pub_fecha_fin = ?, pub_costo = ?, pub_estado = ?, pub_fecha_estado = ? WHERE pub_id = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ssssdssi", $titulo, $descripcion, $fechaInicio, $fechaFin, $costo, $estado, $fechaEstado, $pub_id);
        return $this->base->ejecutarConsulta($stmt);
    }

}

?>