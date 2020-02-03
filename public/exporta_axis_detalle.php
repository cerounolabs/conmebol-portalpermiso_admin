<?php 
    ob_start();

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require '../class/function/curl_api.php';
    require '../vendor/autoload.php';

    setlocale(LC_ALL, 'en_us');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\Settings;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    require_once __DIR__ . '../vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';

    $sheetXLS = new Spreadsheet();

    // Set document properties
    $sheetXLS->getProperties()
        ->setCreator('MSc. Christian Zelaya')
        ->setLastModifiedBy('MSc. Christian Zelaya')
        ->setTitle('CONMEBOL - Sistema Permiso expor XLS')
        ->setSubject('CONMEBOL - Sistema Permiso expor XLS')
        ->setDescription('CONMEBOL - Sistema Permiso')
        ->setKeywords('CONMEBOL - Sistema Permiso expor XLS')
        ->setCategory('CONMEBOL - Sistema Permiso expor XLS');

    $fileType       = $_GET['filetype'];
    $solDetalleJSON = get_curl('200/detalle/solicitud/'.$fileType);

    switch ($fileType) {
        case 'P':
            $fileName = "planilla_permiso_".date('YmdHis').".xls";

            $sheetXLS->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Company Name')
                ->setCellValue('B1', 'CONFEDERACION SUDAMERICANA DE FUTBOL')

                ->setCellValue('A2', 'Table Name')
                ->setCellValue('B2', 'A1A_PERM')

                ->setCellValue('A3', 'Table Description')
                ->setCellValue('B3', 'Permisos')

                ->setCellValue('A4', 'Fields Titles')
                ->setCellValue('B4', 'Codigo de empleado')
                ->setCellValue('C4', 'Fecha desde')
                ->setCellValue('D4', 'Fecha hasta')
                ->setCellValue('E4', 'Fecha desde aplicacion')
                ->setCellValue('F4', 'Fecha hasta aplicacion')
                ->setCellValue('G4', 'Cantidad de dias')
                ->setCellValue('H4', 'Tipo de permiso')
                ->setCellValue('I4', 'Cantidad diaria')
                ->setCellValue('J4', 'Unidad')
                ->setCellValue('K4', 'Clase')
                ->setCellValue('L4', 'Comentario')
                ->setCellValue('M4', 'Ingreso desde PeopleGate')
                ->setCellValue('N4', 'Cantidad convertida')

                ->setCellValue('A5', 'Fields Types')
                ->setCellValue('B5', 'Alpha-20')
                ->setCellValue('C5', 'Date-8')
                ->setCellValue('D5', 'Date-8')
                ->setCellValue('E5', 'Date-8')
                ->setCellValue('F5', 'Date-8')
                ->setCellValue('G5', 'Num-11')
                ->setCellValue('H5', 'Alpha-8')
                ->setCellValue('I5', 'Float-20')
                ->setCellValue('J5', 'Alpha-1')
                ->setCellValue('K5', 'Alpha-1')
                ->setCellValue('L5', 'Memo-64000')
                ->setCellValue('M5', 'Alpha-1')
                ->setCellValue('N5', 'Alpha-20')

                ->setCellValue('A6', 'Fields Valid Values')
                ->setCellValue('B6', '')

                ->setCellValue('A7', 'Default Value')
                ->setCellValue('B7', '')

                ->setCellValue('A8', 'Tablas relacionadas')
                ->setCellValue('H8', '@A1A_TIPE')

                ->setCellValue('A9', 'Fields Names')
                ->setCellValue('B9', 'U_codemp')
                ->setCellValue('C9', 'U_fecdes')
                ->setCellValue('D9', 'U_fechas')
                ->setCellValue('E9', 'U_fedesapl')
                ->setCellValue('F9', 'U_fehasapl')
                ->setCellValue('G9', 'U_canddia')
                ->setCellValue('H9', 'U_tipper')
                ->setCellValue('I9', 'U_cantdia')
                ->setCellValue('J9', 'U_idunidad')
                ->setCellValue('K9', 'U_clase')
                ->setCellValue('L9', 'U_coment')
                ->setCellValue('M9', 'U_PG')
                ->setCellValue('N9', 'U_hhmm');

            if ($solDetalleJSON['code'] === 200) {
                $indexRow = 10;

                foreach ($solDetalleJSON['data'] as $key => $value) {
                    $sheetXLS->setActiveSheetIndex(0)
                    ->setCellValue('A'.$indexRow, '')
                    ->setCellValue('B'.$indexRow, $value['solicitud_detalle_empleado'])
                    ->setCellValue('C'.$indexRow, $value['solicitud_detalle_fecha_desde'])
                    ->setCellValue('D'.$indexRow, $value['solicitud_detalle_fecha_hasta'])
                    ->setCellValue('E'.$indexRow, $value['solicitud_detalle_aplicacion_desde'])
                    ->setCellValue('F'.$indexRow, $value['solicitud_detalle_aplicacion_hasta'])
                    ->setCellValue('G'.$indexRow, $value['solicitud_detalle_cantidad_dia'])
                    ->setCellValue('H'.$indexRow, $value['solicitud_detalle_tipo'])
                    ->setCellValue('I'.$indexRow, $value['solicitud_detalle_cantidad_diaria'])
                    ->setCellValue('J'.$indexRow, $value['solicitud_detalle_unidad'])
                    ->setCellValue('K'.$indexRow, $value['solicitud_detalle_clase'])
                    ->setCellValue('L'.$indexRow, $value['solicitud_detalle_comentario'])
                    ->setCellValue('M'.$indexRow, $value['solicitud_detalle_people_gate'])
                    ->setCellValue('N'.$indexRow, $value['solicitud_detalle_cantidad_convertida']);

                    $indexRow = $indexRow + 1;
                }
            }
            
            break;
        
        case 'L':
            $fileName = "planilla_licencia_".date('YmdHis').".xls";

            $sheetXLS->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Company Name')
                ->setCellValue('B1', 'CONFEDERACION SUDAMERICANA DE FUTBOL')

                ->setCellValue('A2', 'Table Name')
                ->setCellValue('B2', 'A1A_LICE')

                ->setCellValue('A3', 'Table Description')
                ->setCellValue('B3', 'Licencias')

                ->setCellValue('A4', 'Fields Titles')
                ->setCellValue('B4', 'Codigo de empleado')
                ->setCellValue('C4', 'Fecha desde')
                ->setCellValue('D4', 'Fecha hasta')
                ->setCellValue('E4', 'Fecha desde aplicacion')
                ->setCellValue('F4', 'Fecha hasta aplicacion')
                ->setCellValue('G4', 'Cantidad de dias')
                ->setCellValue('H4', 'Tipo de licencia')
                ->setCellValue('I4', 'Cantidad diaria')
                ->setCellValue('J4', 'Unidad')
                ->setCellValue('K4', 'Clase')
                ->setCellValue('L4', 'Codigo de licencia')
                ->setCellValue('M4', 'Comentario')
                ->setCellValue('N4', 'Ingreso desde PeopleGate')
                ->setCellValue('O4', 'Cantidad convertida')

                ->setCellValue('A5', 'Fields Types')
                ->setCellValue('B5', 'Alpha-20')
                ->setCellValue('C5', 'Date-8')
                ->setCellValue('D5', 'Date-8')
                ->setCellValue('E5', 'Date-8')
                ->setCellValue('F5', 'Date-8')
                ->setCellValue('G5', 'Num-11')
                ->setCellValue('H5', 'Alpha-8')
                ->setCellValue('I5', 'Float-20')
                ->setCellValue('J5', 'Alpha-1')
                ->setCellValue('K5', 'Alpha-1')
                ->setCellValue('L5', 'Alpha-16')
                ->setCellValue('M5', 'Memo-64000')
                ->setCellValue('N5', 'Alpha-1')
                ->setCellValue('O5', 'Alpha-20')

                ->setCellValue('A6', 'Fields Valid Values')
                ->setCellValue('B6', '')

                ->setCellValue('A7', 'Default Value')
                ->setCellValue('B7', '')

                ->setCellValue('A8', 'Tablas relacionadas')
                ->setCellValue('H8', '@A1A_TILC')

                ->setCellValue('A9', 'Fields Names')
                ->setCellValue('B9', 'U_codemp')
                ->setCellValue('C9', 'U_fecdes')
                ->setCellValue('D9', 'U_fechas')
                ->setCellValue('E9', 'U_fedesapl')
                ->setCellValue('F9', 'U_fehasapl')
                ->setCellValue('G9', 'U_canddia')
                ->setCellValue('H9', 'U_tiplic')
                ->setCellValue('I9', 'U_cantdia')
                ->setCellValue('J9', 'U_idunidad')
                ->setCellValue('K9', 'U_clase')
                ->setCellValue('L9', 'U_codlic')
                ->setCellValue('M9', 'U_coment')
                ->setCellValue('N9', 'U_PG')
                ->setCellValue('O9', 'U_hhmm');

            if ($solDetalleJSON['code'] === 200) {
                $indexRow = 10;

                foreach ($solDetalleJSON['data'] as $key => $value) {
                    $sheetXLS->setActiveSheetIndex(0)
                    ->setCellValue('A'.$indexRow, '')
                    ->setCellValue('B'.$indexRow, $value['solicitud_detalle_empleado'])
                    ->setCellValue('C'.$indexRow, $value['solicitud_detalle_fecha_desde'])
                    ->setCellValue('D'.$indexRow, $value['solicitud_detalle_fecha_hasta'])
                    ->setCellValue('E'.$indexRow, $value['solicitud_detalle_aplicacion_desde'])
                    ->setCellValue('F'.$indexRow, $value['solicitud_detalle_aplicacion_hasta'])
                    ->setCellValue('G'.$indexRow, $value['solicitud_detalle_cantidad_dia'])
                    ->setCellValue('H'.$indexRow, $value['solicitud_detalle_tipo'])
                    ->setCellValue('I'.$indexRow, $value['solicitud_detalle_cantidad_diaria'])
                    ->setCellValue('J'.$indexRow, $value['solicitud_detalle_unidad'])
                    ->setCellValue('K'.$indexRow, $value['solicitud_detalle_clase'])
                    ->setCellValue('L'.$indexRow, $value['solicitud_detalle_evento'])
                    ->setCellValue('M'.$indexRow, $value['solicitud_detalle_comentario'])
                    ->setCellValue('N'.$indexRow, $value['solicitud_detalle_people_gate'])
                    ->setCellValue('O'.$indexRow, $value['solicitud_detalle_cantidad_convertida']);

                    $indexRow = $indexRow + 1;
                }
            }

            break;

        case 'V':
            $fileName = "planilla_vacaciones_".date('YmdHis').".xls";

            $sheetXLS->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Company Name')
                ->setCellValue('B1', 'CONFEDERACION SUDAMERICANA DE FUTBOL')

                ->setCellValue('A2', 'Table Name')
                ->setCellValue('B2', 'A1A_VAC')

                ->setCellValue('A3', 'Table Description')
                ->setCellValue('B3', 'Vacaciones')

                ->setCellValue('A4', 'Fields Titles')
                ->setCellValue('B4', 'Codigo de empleado')
                ->setCellValue('C4', 'Evento')
                ->setCellValue('D4', 'Fecha desde')
                ->setCellValue('E4', 'Fecha hasta')
                ->setCellValue('F4', 'Fecha desde aplicacion')
                ->setCellValue('G4', 'Fecha hasta aplicacion')
                ->setCellValue('H4', 'Cantidad')
                ->setCellValue('I4', 'Tipo de vacaciones')
                ->setCellValue('J4', 'Cantidad diaria')
                ->setCellValue('K4', 'Unidad')
                ->setCellValue('L4', 'Comentario')
                ->setCellValue('M4', 'Ingreso desde PeopleGate')
                ->setCellValue('N4', 'Cantidad convertida')

                ->setCellValue('A5', 'Fields Types')
                ->setCellValue('B5', 'Alpha-20')
                ->setCellValue('C5', 'Alpha-2')
                ->setCellValue('D5', 'Date-8')
                ->setCellValue('E5', 'Date-8')
                ->setCellValue('F5', 'Date-8')
                ->setCellValue('G5', 'Date-8')
                ->setCellValue('H5', 'Num-11')
                ->setCellValue('I5', 'Alpha-8')
                ->setCellValue('J5', 'Float-20')
                ->setCellValue('K5', 'Alpha-1')
                ->setCellValue('L5', 'Memo-64000')
                ->setCellValue('M5', 'Alpha-1')
                ->setCellValue('N5', 'Alpha-20')

                ->setCellValue('A6', 'Fields Valid Values')
                ->setCellValue('C6', 'UV=Uso de vacaciones;PV=Pago de vacaciones;OT=Otros')

                ->setCellValue('A7', 'Default Value')
                ->setCellValue('C7', 'UV')

                ->setCellValue('A8', 'Tablas relacionadas')

                ->setCellValue('A9', 'Fields Names')
                ->setCellValue('B9', 'U_codemp')
                ->setCellValue('C9', 'U_tipMov')
                ->setCellValue('D9', 'U_fecdes')
                ->setCellValue('E9', 'U_fechas')
                ->setCellValue('F9', 'U_fedesapl')
                ->setCellValue('G9', 'U_fehasapl')
                ->setCellValue('H9', 'U_cantidad')
                ->setCellValue('I9', 'U_tipvac')
                ->setCellValue('J9', 'U_cantdia')
                ->setCellValue('K9', 'U_idunidad')
                ->setCellValue('L9', 'U_coment')
                ->setCellValue('M9', 'U_PG')
                ->setCellValue('N9', 'U_hhmm');

            if ($solDetalleJSON['code'] === 200) {
                $indexRow = 10;

                foreach ($solDetalleJSON['data'] as $key => $value) {
                    $sheetXLS->setActiveSheetIndex(0)
                    ->setCellValue('A'.$indexRow, '')
                    ->setCellValue('B'.$indexRow, $value['solicitud_detalle_empleado'])
                    ->setCellValue('C'.$indexRow, $value['solicitud_detalle_evento'])
                    ->setCellValue('D'.$indexRow, $value['solicitud_detalle_fecha_desde'])
                    ->setCellValue('E'.$indexRow, $value['solicitud_detalle_fecha_hasta'])
                    ->setCellValue('F'.$indexRow, $value['solicitud_detalle_aplicacion_desde'])
                    ->setCellValue('G'.$indexRow, $value['solicitud_detalle_aplicacion_hasta'])
                    ->setCellValue('H'.$indexRow, $value['solicitud_detalle_cantidad_dia'])
                    ->setCellValue('I'.$indexRow, $value['solicitud_detalle_tipo'])
                    ->setCellValue('J'.$indexRow, $value['solicitud_detalle_cantidad_diaria'])
                    ->setCellValue('K'.$indexRow, $value['solicitud_detalle_unidad'])
                    ->setCellValue('L'.$indexRow, $value['solicitud_detalle_comentario'])
                    ->setCellValue('M'.$indexRow, $value['solicitud_detalle_people_gate'])
                    ->setCellValue('N'.$indexRow, $value['solicitud_detalle_cantidad_convertida']);

                    $indexRow = $indexRow + 1;
                }
            }

            break;

        case 'I':
            $fileName = "planilla_inasistencia_".date('YmdHis').".xls";

            $sheetXLS->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Company Name')
                ->setCellValue('B1', 'CONFEDERACION SUDAMERICANA DE FUTBOL')

                ->setCellValue('A2', 'Table Name')
                ->setCellValue('B2', 'A1A_INAS')

                ->setCellValue('A3', 'Table Description')
                ->setCellValue('B3', 'Inasistencias')

                ->setCellValue('A4', 'Fields Titles')
                ->setCellValue('B4', 'Evento')
                ->setCellValue('C4', 'Codigo de empleado')
                ->setCellValue('D4', 'Fecha de inasistencia')
                ->setCellValue('E4', 'Fecha de aplicacion')
                ->setCellValue('F4', 'Tipo de inasistencia')
                ->setCellValue('G4', 'Cantidad diaria')
                ->setCellValue('H4', 'Unidad')
                ->setCellValue('I4', 'Origen')
                ->setCellValue('J4', 'Grupo')
                ->setCellValue('K4', 'Comentario')
                ->setCellValue('L4', 'Codigo de licencia')
                ->setCellValue('M4', 'Ingreso desde PeopleGate')
                ->setCellValue('N4', 'Cantidad convertida')

                ->setCellValue('A5', 'Fields Types')
                ->setCellValue('B5', 'Alpha-1')
                ->setCellValue('C5', 'Alpha-20')
                ->setCellValue('D5', 'Date-8')
                ->setCellValue('E5', 'Date-8')
                ->setCellValue('F5', 'Alpha-8')
                ->setCellValue('G5', 'Float-20')
                ->setCellValue('H5', 'Alpha-1')
                ->setCellValue('I5', 'Alpha-1')
                ->setCellValue('J5', 'Alpha-8')
                ->setCellValue('K5', 'Memo-64000')
                ->setCellValue('L5', 'Alpha-16')
                ->setCellValue('M5', 'Alpha-1')
                ->setCellValue('N5', 'Alpha-20')

                ->setCellValue('A6', 'Fields Valid Values')
                ->setCellValue('B6', 'I=Inasistencias;L=Licencias;P=Permisos;V=Vacaciones')

                ->setCellValue('A7', 'Default Value')
                ->setCellValue('B7', 'I')
                ->setCellValue('C7', 'UV')

                ->setCellValue('A8', 'Tablas relacionadas')
                ->setCellValue('F8', '@A1A_TIIN')

                ->setCellValue('A9', 'Fields Names')
                ->setCellValue('B9', 'U_evento')
                ->setCellValue('C9', 'U_codemp')
                ->setCellValue('D9', 'U_fecina')
                ->setCellValue('E9', 'U_fecapl')
                ->setCellValue('F9', 'U_tipina')
                ->setCellValue('G9', 'U_cantdia')
                ->setCellValue('H9', 'U_idunidad')
                ->setCellValue('I9', 'U_idorigen')
                ->setCellValue('J9', 'U_grupo')
                ->setCellValue('K9', 'U_coment')
                ->setCellValue('L9', 'U_codlic')
                ->setCellValue('M9', 'U_PG')
                ->setCellValue('N9', 'U_hhmm');

            if ($solDetalleJSON['code'] === 200) {
                $indexRow = 10;

                foreach ($solDetalleJSON['data'] as $key => $value) {
                    $sheetXLS->setActiveSheetIndex(0)
                    ->setCellValue('A'.$indexRow, '')
                    ->setCellValue('B'.$indexRow, $value['solicitud_detalle_solicitud'])
                    ->setCellValue('C'.$indexRow, $value['solicitud_detalle_empleado'])
                    ->setCellValue('D'.$indexRow, $value['solicitud_detalle_fecha_desde'])
                    ->setCellValue('E'.$indexRow, $value['solicitud_detalle_fecha_hasta'])
                    ->setCellValue('F'.$indexRow, $value['solicitud_detalle_tipo'])
                    ->setCellValue('G'.$indexRow, $value['solicitud_detalle_cantidad_dia'])
                    ->setCellValue('H'.$indexRow, $value['solicitud_detalle_unidad'])
                    ->setCellValue('I'.$indexRow, $value['solicitud_detalle_origen'])
                    ->setCellValue('J'.$indexRow, str_pad(intval($value['solicitud_detalle_grupo']), 8, '0', STR_PAD_LEFT))
                    ->setCellValue('K'.$indexRow, $value['solicitud_detalle_comentario'])
                    ->setCellValue('L'.$indexRow, $value['solicitud_detalle_evento'])
                    ->setCellValue('M'.$indexRow, $value['solicitud_detalle_people_gate'])
                    ->setCellValue('N'.$indexRow, $value['solicitud_detalle_cantidad_convertida']);

                    $indexRow = $indexRow + 1;
                }
            }
            
            break;
    }

    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;");
    header("Content-Disposition: attachment;filename=$fileName");
    header("Cache-Control: max-age=0");
    header("Cache-Control: max-age=1");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: ".gmdate('D, d M Y H:i:s')." GMT");
    header("Cache-Control: cache, must-revalidate");
    header("Pragma: public");

    $writerXLS = IOFactory::createWriter($sheetXLS, 'Xls');
    $writerXLS->save('php://output');
    exit;
    ob_end_flush();
?>