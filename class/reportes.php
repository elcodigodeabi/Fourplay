<?php 
class Reporte {

    private $base;
    public function __construct() {
        $this->base = new BaseLocal();
    }

    public function listarReportes($rep_id) {
        $sql = "SELECT * FROM reportes WHERE rep_id LIKE ?";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("s", $rep_id);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        return $result;    
    }

    public function listarTodosLosReportes() {
        $sql = "SELECT * FROM reportes";
        $stmt = $this->base->prepararConsulta($sql);
        $this->base->ejecutarConsulta($stmt);
        $result = $this->base->obtenerResultado($stmt);
        return $result;
    }

    public function crearReporte($pos_id, $rep_desc) {
        $sql = "INSERT INTO reportes (rep_desc, rep_fecha, pos_id) VALUES (?, NOW(), ?)";
        $stmt = $this->base->prepararConsulta($sql);
        $stmt->bind_param("si", $rep_desc, $pos_id);
        $resultado = $this->base->ejecutarConsulta($stmt);
        return $resultado; // Retorna true si la consulta se ejecuta correctamente
    }

    public function eliminarReportePorId($reporteId) {
        // Consulta SQL para eliminar el reporte
        $sql = "DELETE FROM reportes WHERE rep_id = ?";
        $stmt = $this->base->prepararConsulta($sql);

        // Vinculamos el parámetro del ID del reporte al query
        $stmt->bind_param("i", $reporteId);

        // Ejecutamos la consulta
        if ($this->base->ejecutarConsulta($stmt)) {
            // Verificamos si se han afectado filas (es decir, si se ha eliminado un reporte)
            if ($stmt->affected_rows > 0) {
                return true; // Eliminación exitosa
            } else {
                return false; // No se encontró el reporte para eliminar
            }
        } else {
            return false; // Error en la consulta
        }
    }

}

?>