<?php
// Incluir TCPDF
require_once('../tcpdf/tcpdf.php');
include("../class/base.php");
include("../class/grupo.php");

// Crear nueva instancia de la clase Grupo
$grupo = new Grupo();

// Obtener todos los grupos de chat (sin necesidad de parámetros externos)
$resultado_grupos = $grupo->listarGrupos();  // Obtienes todos los grupos

// Crear nueva instancia de TCPDF
$pdf = new TCPDF();

// Configurar el documento PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor(author: 'Fourplay');
$pdf->SetTitle('Listado de Grupos');
$pdf->SetSubject('Grupos');
$pdf->SetKeywords('TCPDF, PDF, grupos, listado');

// Añadir una página
$pdf->AddPage();

// Estilos CSS desde el archivo admin.css (copiados directamente aquí)
$estilos = "
    <style>
        body {
            font-family: Poppins, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #5e3e6e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #5e3e6e;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Añadir más estilos del archivo admin.css si es necesario */
    </style>
";

// Incluye los estilos al principio del HTML que pasas al PDF
$html = $estilos; // Aquí se añaden los estilos
$html .= '<h1>Listado de Grupos de Fourplay</h1>';
$html .= '<table>';
$html .= '<thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Grupo</th>
                <th>Descripcion</th>
                <th>Cantidad de Miembros</th>
            </tr>
          </thead><tbody>';

// Añadir los datos de los grupos
if (mysqli_num_rows($resultado_grupos) > 0) {
    while ($row_grupo = mysqli_fetch_assoc($resultado_grupos)) {
        // Aquí puedes incluir la consulta para contar los miembros
        $resultado_miembros = $grupo->listarMiembros($row_grupo['gru_id']);
        $cantidadMiembros = mysqli_num_rows($resultado_miembros);

        // Generar la fila de la tabla
        $html .= '<tr>';
        $html .= '<td>' . $row_grupo['gru_id'] . '</td>';
        $html .= '<td>' . $row_grupo['gru_nombre'] . '</td>';
        $html .= '<td>' . $row_grupo['gru_desc'] . '</td>';
        $html .= '<td>' . $cantidadMiembros . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="4">No hay resultados</td></tr>';
}

$html .= '</tbody></table>';

// Escribir contenido HTML al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo PDF con fecha y hora
$fechaHora = date("Y-m-d_H-i-s");  // Obtiene la fecha y hora actual
$nombreArchivo = "listado-grupos_".$fechaHora.".pdf";  // Nombre con la fecha y hora

// Descargar el PDF automáticamente
$pdf->Output($nombreArchivo, 'D');  // 'D' para descargar el archivo
?>
