<?php 
    ob_start();

    require '../class/function/curl_api.php';
    require '../vendor/autoload.php';
    
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\Settings;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    if(isset($_GET['cod01'])){
        $parm01 = $_GET['cod01'];
    } else {
        $parm01 = 0;
    }

    if(isset($_GET['cod02'])){
        $parm02 = $_GET['cod02'];
    } else {
        $parm02 = 0;
    }

    if(isset($_GET['cod03'])){
        $parm03 = $_GET['cod03'];
    } else {
        $parm03 = 0;
    }

    if(isset($_GET['cod04'])){
        $parm04 = $_GET['cod04'];
    } else {
        $parm04 = 0;
    }

    if(isset($_GET['cod05'])){
        $parm05 = $_GET['cod05'];
    } else {
        $parm05 = 0;
    }

    if(isset($_GET['cod06'])){
        $parm06 = $_GET['cod06'];
    } else {
        $parm06 = 0;
    }

    if(isset($_GET['cod07'])){
        $parm07 = $_GET['cod07'];
    } else {
        $parm07 = 0;
    }

    $dataJSON   = get_curl('200/solicitudes');
    $fileName   = 'planilla_solicitudes_'.date('YmdHis').'.xls';
    $sheetXLS   = new Spreadsheet();

    // Set document properties
    $sheetXLS->getProperties()
        ->setCreator('MSc. Christian Zelaya')
        ->setLastModifiedBy('MSc. Christian Zelaya')
        ->setTitle('CONMEBOL - Sistema Permiso export XLS')
        ->setSubject('CONMEBOL - Sistema Permiso export XLS')
        ->setDescription('CONMEBOL - Sistema Permiso')
        ->setKeywords('CONMEBOL - Sistema Permiso export XLS')
        ->setCategory('CONMEBOL - Sistema Permiso export XLS');

    $sheetXLS->setActiveSheetIndex(0)
        ->setCellValue('A1', 'tipo_permiso_codigo')
        ->setCellValue('B1', 'tipo_permiso_nombre')
        ->setCellValue('C1', 'solicitud_codigo')
        ->setCellValue('D1', 'solicitud_estado_codigo')
        ->setCellValue('E1', 'solicitud_estado_nombre')
        ->setCellValue('F1', 'solicitud_documento')
        ->setCellValue('G1', 'solicitud_persona')
        ->setCellValue('H1', 'solicitud_observacion_colaborador')
        ->setCellValue('I1', 'solicitud_fecha_desde_1')
        ->setCellValue('J1', 'solicitud_fecha_hasta_1')
        ->setCellValue('K1', 'solicitud_fecha_desde_2')
        ->setCellValue('L1', 'solicitud_fecha_hasta_2')
        ->setCellValue('M1', 'solicitud_hora_desde')
        ->setCellValue('N1', 'solicitud_hora_hasta')
        ->setCellValue('O1', 'solicitud_usuario_superior')
        ->setCellValue('P1', 'solicitud_observacion_superior')
        ->setCellValue('Q1', 'solicitud_fecha_hora_superior')
        ->setCellValue('R1', 'solicitud_usuario_colaborador')
        ->setCellValue('S1', 'solicitud_fecha_hora_colaborador')
        ->setCellValue('T1', 'solicitud_ip_superior')
        ->setCellValue('U1', 'solicitud_hora_cantidad')
        ->setCellValue('V1', 'solicitud_fecha_cantidad ')
        ->setCellValue('W1', 'gerencia_codigo')
        ->setCellValue('X1', 'gerencia_nombre')
        ->setCellValue('Y1', 'departamento_codigo')
        ->setCellValue('Z1', 'departamento_nombre')
        ->setCellValue('AA1', 'solicitud_ip_colaborador')
        ->setCellValue('AB1', 'tipo_sexo_codigo')
        ->setCellValue('AC1', 'colaborador_edad')
        ->setCellValue('AD1', 'solicitud_adjunto')
        ->setCellValue('AE1', ' solicitud_usuario_talento')
        ->setCellValue('AF1', 'solicitud_ip_talento')
        ->setCellValue('AG1', 'solicitud_observacion_talento')
        ->setCellValue('AH1', 'solicitud_fecha_hora_talento')
        ->setCellValue('AI1', 'auditoria_usuario')
        ->setCellValue('AJ1', 'auditoria_fecha_hora')
        ->setCellValue('AK1', 'auditoria_ip');
        
    if ($dataJSON['code'] === 200) {
        $indexRow = 2;

        foreach ($dataJSON['data'] as $dataKEY => $valueJSON){
            if ($valueJSON['tipo_permiso_codigo'] == $parm01 && $valueJSON['solicitud_fecha_desde_1'] >= $parm02 && $valueJSON['solicitud_fecha_hasta_1'] <= $parm03){
                if ($parm04 == 0){
                    if($parm05 == 0){
                        if ($parm06 == 0){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['departamento_codigo'] == $parm06){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        }
                    } elseif ($valueJSON['gerencia_codigo'] == $parm05){
                        if ($parm06 == 0){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['departamento_codigo'] == $parm06){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        }
                    }
                } elseif ($valueJSON['solicitud_estado_codigo'] == $parm04){
                    if($parm05 == 0){
                        if ($parm06 == 0){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['departamento_codigo'] == $parm06){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        }
                    } elseif ($valueJSON['gerencia_codigo'] == $parm05){
                        if ($parm06 == 0){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['departamento_codigo'] == $parm06){
                            if ($parm07 == 0){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['solicitud_documento'] == $parm07){
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['tipo_permiso_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_permiso_nombre'])
                                    ->setCellValue('C'.$indexRow, $valueJSON['solicitud_codigo'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['solicitud_estado_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['solicitud_estado_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['solicitud_documento'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['solicitud_persona'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['solicitud_observacion_colaborador'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['solicitud_fecha_desde_1'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['solicitud_fecha_hasta_1'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['solicitud_fecha_desde_2'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['solicitud_fecha_hasta_2'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['solicitud_hora_desde'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['solicitud_hora_hasta'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['solicitud_usuario_superior'])
                                    ->setCellValue('P'.$indexRow, $valueJSON['solicitud_observacion_superior'])
                                    ->setCellValue('Q'.$indexRow, $valueJSON['solicitud_fecha_hora_superior'])
                                    ->setCellValue('R'.$indexRow, $valueJSON['solicitud_usuario_colaborador'])
                                    ->setCellValue('S'.$indexRow, $valueJSON['solicitud_fecha_hora_colaborador'])
                                    ->setCellValue('T'.$indexRow, $valueJSON['solicitud_ip_superior'])
                                    ->setCellValue('U'.$indexRow, $valueJSON['solicitud_hora_cantidad'])
                                    ->setCellValue('V'.$indexRow, $valueJSON['solicitud_fecha_cantidad'])
                                    ->setCellValue('W'.$indexRow, $valueJSON['gerencia_codigo'])
                                    ->setCellValue('X'.$indexRow, $valueJSON['gerencia_nombre'])
                                    ->setCellValue('Y'.$indexRow, $valueJSON['departamento_codigo'])
                                    ->setCellValue('Z'.$indexRow, $valueJSON['departamento_nombre'])
                                    ->setCellValue('AA'.$indexRow, $valueJSON['solicitud_ip_colaborador'])
                                    ->setCellValue('AB'.$indexRow, $valueJSON['tipo_sexo_codigo'])
                                    ->setCellValue('AC'.$indexRow, $valueJSON['colaborador_edad'])
                                    ->setCellValue('AD'.$indexRow, $valueJSON['solicitud_adjunto'])
                                    ->setCellValue('AE'.$indexRow, $valueJSON['solicitud_usuario_talento'])
                                    ->setCellValue('AF'.$indexRow, $valueJSON['solicitud_ip_talento'])
                                    ->setCellValue('AG'.$indexRow, $valueJSON['solicitud_observacion_talento'])
                                    ->setCellValue('AH'.$indexRow, $valueJSON['solicitud_fecha_hora_talento'])
                                    ->setCellValue('AI'.$indexRow, $valueJSON['auditoria_usuario'])
                                    ->setCellValue('AJ'.$indexRow, $valueJSON['auditoria_fecha_hora'])
                                    ->setCellValue('AK'.$indexRow, $valueJSON['auditoria_ip']);
                                
                                $indexRow = $indexRow + 1;
                            }
                        }
                    }
                }
            }
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