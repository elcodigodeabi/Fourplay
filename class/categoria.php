<?php
       class Categoria {
        private $base;

        public function __construct() {
            $this->base = new BaseLocal();
        }

        public function listarCategorias() {
            $sql = "SELECT * FROM categorias";
            $stmt = $this->base->prepararConsulta($sql);

            $this->base->ejecutarConsulta($stmt);
            $result = $this->base->obtenerResultado($stmt);
            return $result;
        }

        public function buscarCategoriasPorNombre($nombreBusqueda) {
            $sql = "SELECT * FROM categorias WHERE cat_nombre LIKE ?";
            $stmt = $this->base->prepararConsulta($sql);

            $nombreBusqueda = "%" . $nombreBusqueda . "%";  // Agrega los % para la búsqueda

            $stmt->bind_param("s", $nombreBusqueda);
            $this->base->ejecutarConsulta($stmt);
            $result = $this->base->obtenerResultado($stmt);
            return $result;
        }

        public function crearCategoria($cat_nombre, $cat_desc) {
            $sql = "INSERT INTO categorias (cat_nombre, cat_desc) VALUES (?, ?)";
            $stmt = $this->base->prepararConsulta($sql);
            $stmt->bind_param("ss", $cat_nombre, $cat_desc);
            return $this->base->ejecutarConsulta($stmt);
        }

        public function actualizarCategoria($id, $cat_nombre, $cat_desc) {
            $sql = "UPDATE categorias SET cat_nombre = ?, cat_desc = ? WHERE cat_id = ?";
            $stmt = $this->base->prepararConsulta($sql);
            $stmt->bind_param("ssi", $cat_nombre, $cat_desc, $id);
            return $this->base->ejecutarConsulta($stmt);
        }

        public function modificarCategoria($id, $nombre, $desc) {
            $sql = "UPDATE categorias SET cat_nombre = ?, cat_desc = ? WHERE cat_id = ?";
            $stmt = $this->base->prepararConsulta($sql);
            $stmt->bind_param("ssi", $nombre, $desc, $id);
            $this->base->ejecutarConsulta($stmt);
        }

        public function getInfo($id) {
            $sql = "SELECT * FROM categorias WHERE cat_id = ?";
            $stmt = $this->base->prepararConsulta($sql);
            $stmt->bind_param("i", $id);
            $this->base->ejecutarConsulta($stmt);
            $result = $this->base->obtenerResultado($stmt);
            return $result;
        }
    }
?>