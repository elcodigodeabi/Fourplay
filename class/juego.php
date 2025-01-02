<?php
class Juego {
    private $nombre;
    private $descripcion;
    private $foto;
    private $base;
    public function __construct() {
        $this->base = new BaseLocal();
    }

    public function crearJuego($jue_nombre, $jue_descrip, $cat_id) {
        $sql = "INSERT INTO juegos (jue_nombre, jue_desc, cat_id) VALUES (?, ?, ?)";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ssi", $jue_nombre, $jue_descrip, $cat_id);
        return $this->base->ejecutarConsulta($stmt);
    }
    
    public function listarJuegos() {
        $sql = "SELECT * FROM juegos";
        $stmt = $this->base->prepararConsulta($sql);
        // $stmt->bind_param("i", $gru_id);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        return $result;
    }

    public function listarJuegosPorUsuario($usu_id) {
        $sql = "SELECT * FROM usuxjue WHERE usu_id = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("i", $usu_id);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        return $result;
    }

    public function verificarJuego($jue_id, $usu_id) {
        $sql = "SELECT * FROM usuxjue WHERE jue_id = ? AND usu_id = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ss", $jue_id, $usu_id);
        $this->base->ejecutarConsulta($stmt);
        return $this->base->obtenerResultado($stmt);
    }

    //añadir juego al perfil del usuario
    public function añadirJuego($jue_id, $usu_id) {
        $sql = "INSERT INTO usuxjue (jue_id, usu_id) VALUES (?, ?)";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ss", $jue_id, $usu_id);
        return $this->base->ejecutarConsulta($stmt);
    }

    public function eliminarJuego($usu_id, $jue_id) {
        $sql = "DELETE FROM usuxjue WHERE usu_id = ? AND jue_id = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("ii", $usu_id, $jue_id);
        return $this->base->ejecutarConsulta($stmt);
    }

    public function getInfo($jue_id) {
        $sql = "SELECT * FROM juegos WHERE jue_id = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("i", $jue_id);
        $this->base->ejecutarConsulta($stmt);
        return $this->base->obtenerResultado($stmt);
    }

    public function buscarJuegosPorNombre($nombreBusqueda) {
        $sql = "SELECT * FROM juegos WHERE jue_nombre LIKE ?";
        $stmt = $this->base->prepararConsulta($sql);

        $nombreBusqueda = "%" . $nombreBusqueda . "%";  // Agrega los % para la búsqueda

        $stmt->bind_param("s", $nombreBusqueda);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        return $result;
    }

    public function __destruct(){
        $this->base->desconectar();
    }
    
    // metodos para creacion o edicion de juegos

    public function obtenerJuegoPorNombre($jue_nombre) {
        $sql = "SELECT jue_id FROM juegos WHERE jue_nombre = ? LIMIT 1";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("s", $jue_nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($fila = $resultado->fetch_assoc()) {
            return $fila['jue_id'];
        }
        
        return null;
    }

    public function actualizarJuego($jue_id, $nombre, $descripcion, $categoria) {
        // SQL para actualizar los detalles del juego
        $sql = "UPDATE juegos SET jue_nombre = ?, jue_desc = ?, cat_id = ? WHERE jue_id = ?";
        
        // Preparar la consulta
        $stmt = $this->base->prepararConsulta($sql);
        
        // Vincular los parámetros
        $stmt->bind_param("ssii", $nombre, $descripcion, $categoria, $jue_id);
        
        // Ejecutar la consulta
        if ($this->base->ejecutarConsulta($stmt)) {
            return true; // Si la actualización fue exitosa
        } else {
            return false; // Si hubo un error en la actualización
        }
    }

    public function verificarJuegoExistente($nombre) {
        $sql = "SELECT * FROM juegos WHERE jue_nombre = ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("s", $nombre);
        $this->base->ejecutarConsulta($stmt);
        $resultado = $this->base->obtenerResultado($stmt);


        return mysqli_num_rows($resultado) > 0; // Retorna verdadero si existe, falso si no
    }
    
}
?>
