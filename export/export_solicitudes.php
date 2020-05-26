<?php 
    ob_start();

    require '../class/function/curl_api.php';
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\Settings;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    $sheetXLS = new Spreadsheet();

    // Set document properties
    $sheetXLS->getProperties()
        ->setCreator('MSc. Christian Zelaya')
        ->setLastModifiedBy('MSc. Christian Zelaya')
        ->setTitle('CONMEBOL - Sistema Permiso export XLS')
        ->setSubject('CONMEBOL - Sistema Permiso export XLS')
        ->setDescription('CONMEBOL - Sistema Permiso')
        ->setKeywords('CONMEBOL - Sistema Permiso export XLS')
        ->setCategory('CONMEBOL - Sistema Permiso export XLS');
    
    $var01          = $_GET['parm01'];
    $var02          = $_GET['parm02'];
    $var03          = $_GET['parm03'];
    $exportJSON     = get_curl('200/solicitudes/'.$var01.'/'.$var02.'/'.$var03);
    $fileName       = "planilla_solicitudes_".date('YmdHis').".xls";

    $sheetXLS->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Company Name')
        ->setCellValue('B1', 'CONFEDERACION SUDAMERICANA DE FUTBOL')

        ->setCellValue('A2', 'TIPO PERMISO')
        ->setCellValue('B2', 'ESTADO SOLICITUD')
        ->setCellValue('C2', 'NRO DOCUMENTO')
        ->setCellValue('D2', 'COLABORADOR')
        ->setCellValue('E2', 'FECHA DESDE')
        ->setCellValue('F2', 'FECHA RETORNO')
        ->setCellValue('G2', 'CANTIDAD DIAS')
        ->setCellValue('H2', 'HORA DESDE')
        ->setCellValue('I2', 'HORA RETORNO')
        ->setCellValue('J2', 'CANTIDAD HORA')
        ->setCellValue('K2', 'ADJUNTO')

        ->setCellValue('L2', 'SOLICITANTE USUARIO')
        ->setCellValue('M2', 'SOLICITANTE FECHA')
        ->setCellValue('N2', 'SOLICITANTE IP')
        ->setCellValue('O2', 'SOLICITANTE OBSERVACION')

        ->setCellValue('P2', 'JEFATURA USUARIO')
        ->setCellValue('Q2', 'JEFATURA FECHA')
        ->setCellValue('R2', 'JEFATURA IP')
        ->setCellValue('S2', 'JEFATURA OBSERVACION')

        ->setCellValue('T2', 'GTH USUARIO')
        ->setCellValue('U2', 'GTH FECHA')
        ->setCellValue('V2', 'GTH IP')
        ->setCellValue('W2', 'GTH OBSERVACION')

        ->setCellValue('X2', 'ULT. MODIFICACION USUARIO')
        ->setCellValue('Y2', 'ULT. MODIFICACION FECHA')
        ->setCellValue('Z2', 'ULT. MODIFICACION IP');

    if ($exportJSON['code'] === 200) {
        $indexRow = 10;

        foreach ($exportJSON['data'] as $key => $value) {
            $sheetXLS->setActiveSheetIndex(0)
            ->setCellValue('A'.$indexRow, $value['tipo_permiso_nombre'])
            ->setCellValue('B'.$indexRow, $value['solicitud_estado_nombre'])
            ->setCellValue('C'.$indexRow, $value['solicitud_documento'])
            ->setCellValue('D'.$indexRow, $value['solicitud_persona'])
            ->setCellValue('E'.$indexRow, $value['solicitud_fecha_desde_2'])
            ->setCellValue('F'.$indexRow, $value['solicitud_fecha_hasta_2'])
            ->setCellValue('G'.$indexRow, $value['solicitud_fecha_cantidad'])
            ->setCellValue('H'.$indexRow, $value['solicitud_hora_desde'])
            ->setCellValue('I'.$indexRow, $value['solicitud_hora_hasta'])
            ->setCellValue('J'.$indexRow, $value['solicitud_hora_cantidad'])
            ->setCellValue('K'.$indexRow, $value['solicitud_adjunto'])

            ->setCellValue('L'.$indexRow, $value['solicitud_usuario_colaborador'])
            ->setCellValue('M'.$indexRow, $value['solicitud_fecha_hora_colaborador'])
            ->setCellValue('N'.$indexRow, $value['solicitud_ip_colaborador'])
            ->setCellValue('O'.$indexRow, $value['solicitud_observacion_colaborador'])

            ->setCellValue('P'.$indexRow, $value['solicitud_usuario_superior'])
            ->setCellValue('Q'.$indexRow, $value['solicitud_fecha_hora_superior'])
            ->setCellValue('R'.$indexRow, $value['solicitud_ip_superior'])
            ->setCellValue('S'.$indexRow, $value['solicitud_observacion_superior'])

            ->setCellValue('T'.$indexRow, $value['solicitud_usuario_talento'])
            ->setCellValue('U'.$indexRow, $value['solicitud_fecha_hora_talento'])
            ->setCellValue('V'.$indexRow, $value['solicitud_ip_talento'])
            ->setCellValue('W'.$indexRow, $value['solicitud_observacion_talento'])

            ->setCellValue('X'.$indexRow, $value['auditoria_usuario'])
            ->setCellValue('Y'.$indexRow, $value['auditoria_fecha_hora'])
            ->setCellValue('Z'.$indexRow, $value['auditoria_ip']);

            $indexRow = $indexRow + 1;
        }
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