<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    $fileType = $_GET['filetype'];

    switch ($fileType) {
        case 'P':
            $fileName = 'permiso.xls';
            break;
        
        case 'L':
            $fileName = 'licencia.xls';
            break;

        case 'V':
            $fileName = 'vacaciones.xls';
            break;

        case 'I':
            $fileName = 'inasistencia.xls';
            break;
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $solDetalleJSON = get_curl('200/detalle/solicitud/'.$fileType);

    switch ($fileType) {
        case 'P':
            echo '<table border="1">';
            echo '<tr><th>Company Name</th><th>CONFEDERACION SUDAMERICANA DE FUTBOL</th></tr>';
            echo '<tr><th>Table Name</th><th>A1A_PERM</th></tr>';
            echo '<tr><th>Table Description</th><th>Permisos</th></tr>';
            echo '<tr><th>Fields Titles</th><th>Codigo de empleado</th><th>Fecha desde</th><th>Fecha hasta</th><th>Fecha desde aplicacion</th><th>Fecha hasta aplicacion</th><th>Cantidad de dias</th><th>Tipo de permiso</th><th>Cantidad diaria</th><th>Unidad</th><th>Clase</th><th>Comentario</th><th>Ingreso desde PeopleGate</th><th>Cantidad convertida</th></tr>';
            echo '<tr><th>Fields Types</th><th>Alpha-20</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Num-11</th><th>Alpha-8</th><th>Float-20</th><th>Alpha-1</th><th>Alpha-1</th><th>Memo-64000</th><th>Alpha-1</th><th>Alpha-20</th></tr>';
            echo '<tr><th>Fields Valid Values</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Default Value</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Tablas relacionadas</th><th></th><th></th><th></th><th></th><th></th><th></th><th>@A1A_TIPE</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Fields Names</th><th>U_codemp</th><th>U_fecdes</th><th>U_fechas</th><th>U_fedesapl</th><th>U_fehasapl</th><th>U_canddia</th><th>U_tipper</th><th>U_cantdia</th><th>U_idunidad</th><th>U_clase</th><th>U_coment</th><th>U_PG</th><th>U_hhmm</th></tr>';

            if ($solDetalleJSON['code'] === 200) {
                foreach ($solDetalleJSON['data'] as $key => $value) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td>".$value['solicitud_detalle_empleado']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_dia']."</td>";
                    echo "<td>".$value['solicitud_detalle_tipo']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_diaria']."</td>";
                    echo "<td>".$value['solicitud_detalle_unidad']."</td>";
                    echo "<td>".$value['solicitud_detalle_clase']."</td>";
                    echo "<td>".$value['solicitud_detalle_comentario']."</td>";
                    echo "<td>".$value['solicitud_detalle_people_gate']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_convertida']."</td>";
                    echo "</tr>";
                }
            }
        
            echo '</table>';
            break;
        
        case 'L':
            echo '<table border="1">';
            echo '<tr><th>Company Name</th><th>CONFEDERACION SUDAMERICANA DE FUTBOL</th></tr>';
            echo '<tr><th>Table Name</th><th>A1A_LICE</th></tr>';
            echo '<tr><th>Table Description</th><th>Licencias</th></tr>';
            echo '<tr><th>Fields Titles</th><th>Codigo de empleado</th><th>Fecha desde</th><th>Fecha hasta</th><th>Fecha desde aplicacion</th><th>Fecha hasta aplicacion</th><th>Cantidad de dias</th><th>Tipo de licencia</th><th>Cantidad diaria</th><th>Unidad</th><th>Clase</th><th>Codigo de licencia</th><th>Comentario</th><th>Ingreso desde PeopleGate</th><th>Cantidad convertida</th></tr>';
            echo '<tr><th>Fields Types</th><th>Alpha-20</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Num-11</th><th>Alpha-8</th><th>Float-20</th><th>Alpha-1</th><th>Alpha-1</th><th>Alpha-16</th><th>Memo-64000</th><th>Alpha-1</th><th>Alpha-20</th></tr>';
            echo '<tr><th>Fields Valid Values</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Default Value</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Tablas relacionadas</th><th></th><th></th><th></th><th></th><th></th><th></th><th>@A1A_TILC</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Fields Names</th><th>U_codemp</th><th>U_fecdes</th><th>U_fechas</th><th>U_fedesapl</th><th>U_fehasapl</th><th>U_canddia</th><th>U_tiplic</th><th>U_cantdia</th><th>U_idunidad</th><th>U_clase</th><th>U_codlic</th><th>U_coment</th><th>U_PG</th><th>U_hhmm</th></tr>';
            
            if ($solDetalleJSON['code'] === 200) {
                foreach ($solDetalleJSON['data'] as $key => $value) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td>".$value['solicitud_detalle_empleado']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_dia']."</td>";
                    echo "<td>".$value['solicitud_detalle_tipo']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_diaria']."</td>";
                    echo "<td>".$value['solicitud_detalle_unidad']."</td>";
                    echo "<td>".$value['solicitud_detalle_clase']."</td>";
                    echo "<td>".$value['solicitud_detalle_evento']."</td>";
                    echo "<td>".$value['solicitud_detalle_comentario']."</td>";
                    echo "<td>".$value['solicitud_detalle_people_gate']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_convertida']."</td>";
                    echo "</tr>";
                }
            }
        
            echo '</table>';
            break;

        case 'V':
            echo '<table border="1">';
            echo '<tr><th>Company Name</th><th>CONFEDERACION SUDAMERICANA DE FUTBOL</th></tr>';
            echo '<tr><th>Table Name</th><th>A1A_VAC</th></tr>';
            echo '<tr><th>Table Description</th><th>Vacaciones</th></tr>';
            echo '<tr><th>Fields Titles</th><th>Codigo de empleado</th><th>Evento</th><th>Fecha desde</th><th>Fecha hasta</th><th>Fecha desde aplicacion</th><th>Fecha hasta aplicacion</th><th>Cantidad</th><th>Tipo de vacaciones</th><th>Cantidad diaria</th><th>Unidad</th><th>Comentario</th><th>Ingreso desde PeopleGate</th><th>Cantidad convertida</th></tr>';
            echo '<tr><th>Fields Types</th><th>Alpha-20</th><th>Alpha-2</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Date-8</th><th>Num-11</th><th>Alpha-8</th><th>Float-20</th><th>Alpha-1</th><th>Memo-64000</th><th>Alpha-1</th><th>Alpha-20</th></tr>';
            echo '<tr><th>Fields Valid Values</th><th></th><th>UV=Uso de vacaciones;PV=Pago de vacaciones;OT=Otros</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Default Value</th><th></th><th>UV</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Tablas relacionadas</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Fields Names</th><th>U_codemp</th><th>U_tipMov</th><th>U_fecdes</th><th>U_fechas</th><th>U_fedesapl</th><th>U_fehasapl</th><th>U_cantidad</th><th>U_tipvac</th><th>U_cantdia</th><th>U_idunidad</th><th>U_coment</th><th>U_PG</th><th>U_hhmm</th></tr>';
            
            if ($solDetalleJSON['code'] === 200) {
                foreach ($solDetalleJSON['data'] as $key => $value) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td>".$value['solicitud_detalle_empleado']."</td>";
                    echo "<td>".$value['solicitud_detalle_evento']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_aplicacion_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_dia']."</td>";
                    echo "<td>".$value['solicitud_detalle_tipo']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_diaria']."</td>";
                    echo "<td>".$value['solicitud_detalle_unidad']."</td>";                    
                    echo "<td>".$value['solicitud_detalle_comentario']."</td>";
                    echo "<td>".$value['solicitud_detalle_people_gate']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_convertida']."</td>";
                    echo "</tr>";
                }
            }
        
            echo '</table>';
            break;

        case 'I':
            echo '<table border="1">';
            echo '<tr><th>Company Name</th><th>CONFEDERACION SUDAMERICANA DE FUTBOL</th></tr>';
            echo '<tr><th>Table Name</th><th>A1A_INAS</th></tr>';
            echo '<tr><th>Table Description</th><th>Inasistencias</th></tr>';
            echo '<tr><th>Fields Titles</th><th>Evento</th><th>Codigo de empleado</th><th>Fecha de inasistencia</th><th>Fecha de aplicacion</th><th>Tipo de inasistencia</th><th>Cantidad diaria</th><th>Unidad</th><th>Origen</th><th>Grupo</th><th>Comentario</th><th>Codigo de licencia</th><th>Ingreso desde PeopleGate</th><th>Cantidad convertida</th></tr>';
            echo '<tr><th>Fields Types</th><th>Alpha-1</th><th>Alpha-20</th><th>Date-8</th><th>Date-8</th><th>Alpha-8</th><th>Float-20</th><th>Alpha-1</th><th>Alpha-1</th><th>Alpha-8</th><th>Memo-64000</th><th>Alpha-16</th><th>Alpha-1</th><th>Alpha-20</th></tr>';
            echo '<tr><th>Fields Valid Values</th><th>I=Inasistencias;L=Licencias;P=Permisos;V=Vacaciones</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Default Value</th><th>I</th><th>UV</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Tablas relacionadas</th><th></th><th></th><th></th><th></th><th>@A1A_TIIN</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
            echo '<tr><th>Fields Names</th><th>U_evento</th><th>U_codemp</th><th>U_fecina</th><th>U_fecapl</th><th>U_tipina</th><th>U_cantdia</th><th>U_idunidad</th><th>U_idorigen</th><th>U_grupo</th><th>U_coment</th><th>U_codlic</th><th>U_PG</th><th>U_hhmm</th></tr>';
            
            if ($solDetalleJSON['code'] === 200) {
                foreach ($solDetalleJSON['data'] as $key => $value) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td>".$value['solicitud_detalle_solicitud']."</td>";
                    echo "<td>'".$value['solicitud_detalle_empleado']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_desde']."</td>";
                    echo "<td>".$value['solicitud_detalle_fecha_hasta']."</td>";
                    echo "<td>".$value['solicitud_detalle_tipo']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_dia']."</td>";
                    echo "<td>".$value['solicitud_detalle_unidad']."</td>"; 
                    echo "<td>".$value['solicitud_detalle_origen']."</td>";
                    echo "<td>".str_pad(intval($value['solicitud_detalle_grupo']), 8, '0', STR_PAD_LEFT)."</td>";
                    echo "<td>".$value['solicitud_detalle_comentario']."</td>";
                    echo "<td>".$value['solicitud_detalle_evento']."</td>";
                    echo "<td>".$value['solicitud_detalle_people_gate']."</td>";
                    echo "<td>".$value['solicitud_detalle_cantidad_convertida']."</td>";
                    echo "</tr>";
                }
            }
        
            echo '</table>';
            break;
    }
?>