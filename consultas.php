<?php
require('conexion.php');

$columns = ['id', 'fecha', 'hora', 'temperatura', 'ph', 'estabilidad'];
$table = "registros";

$id = 'id';

$campo = $campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/*LIMIT o limite */
$limit =  isset($_POST['registros']) ? $conn->real_escape_string($_POST['registros']) : 5;
$pagina =  isset($_POST['pagina']) ? $conn->real_escape_string($_POST['pagina']) : 0;


if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM 
$table 
$where $sLimit";
$resultado = $conn->query($sql);

$num_rows = $resultado->num_rows;

/*CONSULTA PARA EL TOTAL DE REGISTROS FILTRADOS*/
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conn->query($sqlFiltro);
$rowfiltro = $resFiltro->fetch_array();
$totalFiltro = $rowfiltro[0];

/*CONSULTA PARA EL TOTAL DE REGISTROS FILTRADOS TOTALES*/
$sqlTotal = "SELECT COUNT($id) FROM $table ";
$resTotal = $conn->query($sqlTotal);
$rowTotal = $resTotal->fetch_array();
$totalRegistros = $rowTotal[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['id'] . '</td>';
        $output['data'] .= '<td>' . $row['fecha'] . '</td>';
        $output['data'] .= '<td>' . $row['hora'] . '</td>';
        $output['data'] .= '<td>' . $row['temperatura'] . '</td>';
        $output['data'] .= '<td>' . $row['ph'] . '</td>';
        $output['data'] .= '<td>' . $row['estabilidad'] . '</td>';
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="6">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {

    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if (($pagina - 4) > 1) {
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link active" href"#">' . $i . '</a></li';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href"#" onclick="getData(' . $i . ')">' . $i . '</a></li';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
