<?php
    ob_start();

    require '../class/function/curl_api.php';
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\Settings;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    if (isset($_GET['cod01'])) {
        $parm01 = $_GET['cod01'];
    } else {
        $parm01 = 0;
    }

    if (isset($_GET['cod02'])) {
        $parm02 = $_GET['cod02'];
    } else {
        $parm02 = 0;
    }
    
    if (isset($_GET['cod03'])) {
        $parm03 = $_GET['cod03'];
    } else {
        $parm03 = 0;
    }

    if (isset($_GET['cod04'])) {
        $parm04 = $_GET['cod04'];
    } else {
        $parm04 = 0;
    }

    if (isset($_GET['cod05'])) {
        $parm05 = $_GET['cod05'];
    } else {
        $parm05 = 0;
    }

    if (isset($_GET['cod06'])) {
        $parm06 = $_GET['cod06'];
    } else {
        $parm06 = 0;
    }

    if (isset($_GET['cod07'])) {
        $parm07 = $_GET['cod07'];
    } else {
        $parm07 = 0;
    }

    if (isset($_GET['cod08'])) {
        $parm08 = $_GET['cod08'];
    } else {
        $parm08 = 0;
    }

    $dataJSON   = get_curl('200/comprobante');
    $fileName   = "planilla_comprobantes_".date('YmdHis').".xls";
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
        ->setCellValue('A1', 'comprobante_codigo')
        ->setCellValue('B1', 'tipo_estado_codigo')
        ->setCellValue('C1', 'tipo_estado_nombre')
        ->setCellValue('D1', 'tipo_comprobante_codigo')
        ->setCellValue('E1', 'tipo_comprobante_nombre')
        ->setCellValue('F1', 'comprobante_periodo') 
        ->setCellValue('G1', 'tipo_mes_codigo') 
        ->setCellValue('H1', 'tipo_mes_nombre') 
        ->setCellValue('I1', 'tipo_gerencia_codigo') 
        ->setCellValue('J1', 'tipo_gerencia_nombre')
        ->setCellValue('K1', 'tipo_departamento_codigo')
        ->setCellValue('L1', 'tipo_departamento_nombre')
        ->setCellValue('M1', 'comprobante_documento')
        ->setCellValue('N1', 'comprobante_colaborador')
        ->setCellValue('O1', 'comprobante_observacion')
        ->setCellValue('P1', 'comprobante_adjunto ');

    if ($dataJSON['code'] === 200) {
        $indexRow = 2;

        foreach ($dataJSON['data'] as $dataKEY => $valueJSON) {
            if ($valueJSON['tipo_comprobante_codigo'] == $parm01 && $valueJSON['comprobante_periodo'] == $parm02 && $valueJSON['tipo_mes_codigo'] >= $parm03 && $valueJSON['tipo_mes_codigo'] <= $parm04){
                if ($parm05 == 0){
                    if ($parm06 == 0) {
                        if ($parm07 == 0) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['comprobante_documento'] == $parm07) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        }
                    } elseif ($valueJSON['tipo_departamento_codigo'] == $parm06) {
                        if ($parm07 == 0) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['comprobante_documento'] == $parm07) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        }
                    }
                } elseif ($valueJSON['tipo_gerencia_codigo'] == $parm05) {
                    if ($parm06 == 0) {
                        if ($parm07 == 0) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['comprobante_documento'] == $parm07) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        }
                    } elseif ($valueJSON['tipo_departamento_codigo'] == $parm06) {
                        if ($parm07 == 0) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            }
                        } elseif ($valueJSON['comprobante_documento'] == $parm07) {
                            if ($parm08 == 0) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

                                $indexRow = $indexRow + 1;
                            } elseif ($valueJSON['tipo_estado_codigo'] == $parm08) {
                                $sheetXLS->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$indexRow, $valueJSON['comprobante_codigo'])
                                    ->setCellValue('B'.$indexRow, $valueJSON['tipo_estado_codigo']) 
                                    ->setCellValue('C'.$indexRow, $valueJSON['tipo_estado_nombre'])
                                    ->setCellValue('D'.$indexRow, $valueJSON['tipo_comprobante_codigo'])
                                    ->setCellValue('E'.$indexRow, $valueJSON['tipo_comprobante_nombre'])
                                    ->setCellValue('F'.$indexRow, $valueJSON['comprobante_periodo'])
                                    ->setCellValue('G'.$indexRow, $valueJSON['tipo_mes_codigo'])
                                    ->setCellValue('H'.$indexRow, $valueJSON['tipo_mes_nombre'])
                                    ->setCellValue('I'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                    ->setCellValue('J'.$indexRow, $valueJSON['tipo_gerencia_nombre'])
                                    ->setCellValue('K'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                    ->setCellValue('L'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                    ->setCellValue('M'.$indexRow, $valueJSON['comprobante_documento'])
                                    ->setCellValue('N'.$indexRow, $valueJSON['comprobante_colaborador'])
                                    ->setCellValue('O'.$indexRow, $valueJSON['comprobante_observacion'])
                                    ->setCellValue('P'.$indexRow,'http://permisos.conmebol.com/uploads/comprobante/'. $valueJSON['comprobante_adjunto']);

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